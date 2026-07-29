<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Post;
use App\Models\PolicyType;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WebsiteController extends Controller
{
    public static function getAirlines(?string $policyType = null): array
    {
        $query = Airline::query();

        if ($policyType) {
            $query->whereHas('policies', fn ($policies) => $policies->where('type', $policyType));
        }

        return $query->get()->keyBy('slug')->toArray();
    }

    public static function policyUrl(string $type, string $airline): string
    {
        $route = match ($type) {
            'cancellation' => 'cancellation.show',
            'flight-change' => 'flight-change.show',
            'name-change' => 'name-change.show',
            'reservation-policy' => 'reservation-policy.show',
            'baggage-policy' => 'baggage-policy.show',
            'refund-policy' => 'refund-policy.show',
            default => null,
        };

        return $route
            ? route($route, $airline)
            : route('policy-types.show', ['type' => $type, 'airline' => $airline]);
    }

    public function home(): View
    {
        $airlines = collect(self::getAirlines('cancellation'))->map(function (array $airline, string $slug) {
            return [
                'name' => $airline['name'],
                'image' => $airline['image'],
                'link' => route('cancellation.show', $slug),
            ];
        })->values();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 6;
        $paginatedAirlines = new LengthAwarePaginator(
            $airlines->forPage($currentPage, $perPage)->values(),
            $airlines->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        $services = [
            ['icon' => 'fas fa-headset', 'title' => '24/7 Global Support', 'desc' => 'We are here to help you anywhere, anytime with premium care.'],
            ['icon' => 'fas fa-couch', 'title' => 'Lounge Access', 'desc' => 'Exclusive entry to premium airport lounges worldwide.'],
            ['icon' => 'fas fa-shield-alt', 'title' => 'Travel Protection', 'desc' => 'Comprehensive insurance and secure bookings for peace of mind.'],
        ];

        $testimonials = [
            ['name' => 'Sarah Jenkins', 'role' => 'Frequent Flyer', 'quote' => 'FlightRules made understanding complex airline policies incredibly easy. The luxury service is top-notch.', 'image' => asset('images/testimonial_avatar_1783532215709.png')],
            ['name' => 'David Lee', 'role' => 'Business Traveler', 'quote' => 'I save so much time and hassle using this platform. Truly a premium experience.', 'image' => asset('images/testimonial_avatar_1783532215709.png')],
            ['name' => 'Emma Watson', 'role' => 'Travel Blogger', 'quote' => 'The best resource for travel rules. Period. Highly recommended!', 'image' => asset('images/testimonial_avatar_1783532215709.png')],
        ];

        return view('website.home', [
            'airlines' => $paginatedAirlines,
            'services' => $services,
            'testimonials' => $testimonials,
        ]);
    }

    public function airlineShow(string $airline): View
    {
        $airlineModel = Airline::with('policies')->where('slug', $airline)->firstOrFail();
        $policies = $airlineModel->policies->map(function ($policy) use ($airlineModel) {
            $meta = $this->policyMeta($policy->type);

            return [
                'title' => $meta['title'],
                'link' => self::policyUrl($policy->type, $airlineModel->slug),
            ];
        })->values();

        return view('website.airlines.index', compact('airlineModel', 'policies'));
    }

    public function customPolicyShow(string $type, string $airline): View
    {
        PolicyType::where('slug', $type)->firstOrFail();

        return $this->policyShow($airline, $type);
    }

    public function cancellationIndex(): View
    {
        return $this->policyIndex('cancellation', 'cancellation.show', 'website.cancellation.index');
    }

    public function cancellationShow(string $airline): View
    {
        return $this->policyShow($airline, 'cancellation');
    }

    public function flightChangeIndex(): View
    {
        return $this->policyIndex('flight-change', 'flight-change.show', 'website.flight-change.index');
    }

    public function flightChangeShow(string $airline): View
    {
        return $this->policyShow($airline, 'flight-change');
    }

    public function nameChangeIndex(): View
    {
        return $this->policyIndex('name-change', 'name-change.show', 'website.name-change.index');
    }

    public function nameChangeShow(string $airline): View
    {
        return $this->policyShow($airline, 'name-change');
    }

    public function reservationPolicyIndex(): View
    {
        return $this->policyIndex('reservation-policy', 'reservation-policy.show', 'website.reservation-policy.index');
    }

    public function reservationPolicyShow(string $airline): View
    {
        return $this->policyShow($airline, 'reservation-policy');
    }

    public function baggagePolicyIndex(): View
    {
        return $this->policyIndex('baggage-policy', 'baggage-policy.show', 'website.baggage-policy.index');
    }

    public function baggagePolicyShow(string $airline): View
    {
        return $this->policyShow($airline, 'baggage-policy');
    }

    public function refundPolicyIndex(): View
    {
        return $this->policyIndex('refund-policy', 'refund-policy.show', 'website.refund-policy.index');
    }

    public function refundPolicyShow(string $airline): View
    {
        return $this->policyShow($airline, 'refund-policy');
    }

    public function blogIndex(): View
    {
        $posts = Post::orderByDesc('published_at')->paginate(6);
        $posts->getCollection()->transform(function (Post $post) {
            $post->link = route('blog.show', $post->slug);
            $post->image = asset($post->image);
            $post->date = $post->published_at?->format('F d, Y') ?? '';
            return $post;
        });

        return view('website.blog.index', compact('posts'));
    }

    public function blogShow(string $slug): View
    {
        $postModel = Post::where('slug', $slug)->firstOrFail();
        $post = $postModel->toArray();
        $post['link'] = route('blog.show', $post['slug']);
        $post['image'] = asset($post['image']);
        $post['date'] = $postModel->published_at?->format('F d, Y') ?? '';

        $relatedPosts = Post::where('slug', '!=', $slug)->inRandomOrder()->take(3)->get()->map(fn (Post $related) => [
            'title' => $related->title,
            'category' => $related->category,
            'image' => asset($related->image),
            'date' => $related->published_at?->format('F d, Y') ?? '',
            'link' => route('blog.show', $related->slug),
        ])->all();

        return view('website.blog.show', compact('post', 'relatedPosts'));
    }

    private function policyIndex(string $type, string $showRoute, string $view): View
    {
        $airlines = Airline::whereHas('policies', fn ($query) => $query->where('type', $type))->paginate(6);
        $airlines->getCollection()->transform(function (Airline $airline) use ($showRoute) {
            $airline->link = route($showRoute, $airline->slug);
            $airline->image = asset($airline->image);
            return $airline;
        });

        return view($view, compact('airlines'));
    }

    private function policyShow(string $slug, string $type): View
    {
        $policyMeta = $this->policyMeta($type);
        $airlineModel = Airline::where('slug', $slug)->firstOrFail();
        $policy = $airlineModel->policies()->where('type', $type)->firstOrFail();
        $airlineData = $airlineModel->toArray();
        $airlineData['image'] = $airlineModel->image ? asset($airlineModel->image) : null;
        $airlineData['policy'] = $policy;
        $preparedPolicy = $this->preparePolicyHtml($policy->content);
        $airlineData['policy_content'] = $preparedPolicy['html'];
        $policyFaqs = $policy->faqs ?: [];
        $tableOfContents = $preparedPolicy['toc'];

        if ($policyFaqs) {
            $tableOfContents[] = [
                'title' => 'Frequently Asked Questions',
                'anchor' => 'policyFaqTitle',
            ];
        }

        $relatedAirlines = Airline::where('slug', '!=', $slug)
            ->whereHas('policies', fn ($query) => $query->where('type', $type))
            ->inRandomOrder()->take(3)->get()->map(fn (Airline $related) => [
            'name' => $related->name,
            'image' => asset($related->image),
            'link' => self::policyUrl($type, $related->slug),
        ])->all();

        $policyAirlines = collect([$airlineModel->load('policies')])
            ->concat(
                Airline::with('policies')
                    ->where('slug', '!=', $slug)
                    ->whereHas('policies')
                    ->inRandomOrder()
                    ->take(5)
                    ->get()
            )
            ->map(function (Airline $accordionAirline, int $index) use ($type) {
                $policies = $accordionAirline->policies;

                if ($index === 0) {
                    $policies = $policies->where('type', '!=', $type);
                }

                return [
                    'name' => $accordionAirline->name,
                    'policies' => $policies
                        ->map(function ($policy) use ($accordionAirline) {
                            $meta = $this->policyMeta($policy->type);

                            return [
                                'title' => $meta['title'],
                                'link' => self::policyUrl($policy->type, $accordionAirline->slug),
                            ];
                        })
                        ->values()
                        ->all(),
                ];
            })
            ->filter(fn (array $airline) => ! empty($airline['policies']))
            ->values()
            ->all();

        return view('website.airlines.show', compact('airlineData', 'relatedAirlines', 'policyAirlines', 'policyFaqs', 'policyMeta', 'tableOfContents'));
    }

    private function preparePolicyHtml(?string $html): array
    {
        if (blank($html)) {
            return ['html' => '', 'toc' => []];
        }

        $html = preg_split(
            '/<!--\s*FAQ Section\s*-->|<h[1-6][^>]*>\s*Frequently Asked Questions\s*<\/h[1-6]>/i',
            $html,
            2
        )[0];

        $document = new \DOMDocument('1.0', 'UTF-8');
        $previousState = libxml_use_internal_errors(true);
        $document->loadHTML(
            '<?xml encoding="UTF-8"><div id="policy-content-root">'.$html.'</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        libxml_clear_errors();
        libxml_use_internal_errors($previousState);

        $root = $document->getElementById('policy-content-root');

        if (! $root) {
            return ['html' => $html, 'toc' => []];
        }

        $tableOfContents = [];
        $usedAnchors = [];
        $headings = (new \DOMXPath($document))->query(
            './/*[self::h1 or self::h2 or self::h3 or self::h4 or self::h5 or self::h6]',
            $root
        );

        foreach (iterator_to_array($headings) as $heading) {
            $title = trim($heading->textContent);

            if ($title === '' || ! $this->headingHasContent($heading)) {
                $node = $heading;

                while ($node) {
                    $nextNode = $node->nextSibling;
                    $node->parentNode?->removeChild($node);

                    if ($nextNode instanceof \DOMElement && preg_match('/^h[1-6]$/i', $nextNode->tagName)) {
                        break;
                    }

                    $node = $nextNode;
                }

                continue;
            }

            $baseAnchor = Str::slug($heading->getAttribute('id') ?: $title) ?: 'policy-section';
            $anchor = $baseAnchor;
            $suffix = 2;

            while (isset($usedAnchors[$anchor])) {
                $anchor = $baseAnchor.'-'.$suffix++;
            }

            $usedAnchors[$anchor] = true;
            $heading->setAttribute('id', $anchor);
            $tableOfContents[] = ['title' => $title, 'anchor' => $anchor];
        }

        $normalized = '';
        foreach ($root->childNodes as $node) {
            $normalized .= $document->saveHTML($node);
        }

        return ['html' => $normalized, 'toc' => $tableOfContents];
    }

    private function headingHasContent(\DOMElement $heading): bool
    {
        for ($node = $heading->nextSibling; $node; $node = $node->nextSibling) {
            if ($node instanceof \DOMElement && preg_match('/^h[1-6]$/i', $node->tagName)) {
                return false;
            }

            if (trim($node->textContent) !== '') {
                return true;
            }

            if ($node instanceof \DOMElement) {
                $media = (new \DOMXPath($heading->ownerDocument))->query(
                    'self::img or self::table or self::ul or self::ol or self::video or self::audio or self::iframe'
                    .' | .//*[self::img or self::table or self::ul or self::ol or self::video or self::audio or self::iframe]',
                    $node
                );

                if ($media->length > 0) {
                    return true;
                }
            }
        }

        return false;
    }

    private function policyMeta(string $type): array
    {
        return match ($type) {
            'cancellation' => [
                'title' => 'Cancellation Policy',
                'index_route' => 'cancellation.index',
                'show_route' => 'cancellation.show',
            ],
            'flight-change' => [
                'title' => 'Flight Change Policy',
                'index_route' => 'flight-change.index',
                'show_route' => 'flight-change.show',
            ],
            'name-change' => [
                'title' => 'Name Change Policy',
                'index_route' => 'name-change.index',
                'show_route' => 'name-change.show',
            ],
            'reservation-policy' => [
                'title' => 'Reservation Policy',
                'index_route' => 'reservation-policy.index',
                'show_route' => 'reservation-policy.show',
            ],
            'baggage-policy' => [
                'title' => 'Baggage Policy',
                'index_route' => 'baggage-policy.index',
                'show_route' => 'baggage-policy.show',
            ],
            'refund-policy' => [
                'title' => 'Refund Policy',
                'index_route' => 'refund-policy.index',
                'show_route' => 'refund-policy.show',
            ],
            default => [
                'title' => PolicyType::where('slug', $type)->value('name') ?? Str::headline($type),
                'index_route' => null,
                'show_route' => 'policy-types.show',
            ],
        };
    }
}
