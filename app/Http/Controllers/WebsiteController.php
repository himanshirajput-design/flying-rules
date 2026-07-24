<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class WebsiteController extends Controller
{
    public static function getAirlines(): array
    {
        return Airline::all()->keyBy('slug')->toArray();
    }

    public function home(): View
    {
        $airlines = collect(self::getAirlines())->map(function (array $airline, string $slug) {
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

    public function cancellationIndex(): View
    {
        return $this->policyIndex('cancellation.show', 'website.cancellation.index');
    }

    public function cancellationShow(string $airline): View
    {
        return $this->policyShow($airline, 'cancellation');
    }

    public function flightChangeIndex(): View
    {
        return $this->policyIndex('flight-change.show', 'website.flight-change.index');
    }

    public function flightChangeShow(string $airline): View
    {
        return $this->policyShow($airline, 'flight-change');
    }

    public function nameChangeIndex(): View
    {
        return $this->policyIndex('name-change.show', 'website.name-change.index');
    }

    public function nameChangeShow(string $airline): View
    {
        return $this->policyShow($airline, 'name-change');
    }

    public function reservationPolicyIndex(): View
    {
        return $this->policyIndex('reservation-policy.show', 'website.reservation-policy.index');
    }

    public function reservationPolicyShow(string $airline): View
    {
        return $this->policyShow($airline, 'reservation-policy');
    }

    public function baggagePolicyIndex(): View
    {
        return $this->policyIndex('baggage-policy.show', 'website.baggage-policy.index');
    }

    public function baggagePolicyShow(string $airline): View
    {
        return $this->policyShow($airline, 'baggage-policy');
    }

    public function refundPolicyIndex(): View
    {
        return $this->policyIndex('refund-policy.show', 'website.refund-policy.index');
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

    private function policyIndex(string $showRoute, string $view): View
    {
        $airlines = Airline::paginate(6);
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
        $airlineData = $airlineModel->toArray();
        $airlineData['image'] = asset($airlineData['image']);
        $airlineData['policy'] = $airlineModel->policies()->where('type', $type)->first();
        $airlineData['policy_content'] = $this->normalizePolicyHtml($airlineData['policy']?->content);
        $policyMeta['faqs'] = $airlineData['policy']?->faqs ?: $policyMeta['faqs'];

        $relatedAirlines = Airline::where('slug', '!=', $slug)->inRandomOrder()->take(3)->get()->map(fn (Airline $related) => [
            'name' => $related->name,
            'image' => asset($related->image),
            'link' => route($policyMeta['show_route'], $related->slug),
        ])->all();

        return view('website.airlines.show', compact('airlineData', 'relatedAirlines', 'policyMeta'));
    }

    private function normalizePolicyHtml(?string $html): string
    {
        if (blank($html)) {
            return '';
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
            return $html;
        }

        $normalized = '';
        foreach ($root->childNodes as $node) {
            $normalized .= $document->saveHTML($node);
        }

        return $normalized;
    }

    private function policyMeta(string $type): array
    {
        $meta = match ($type) {
            'cancellation' => [
                'title' => 'Cancellation Policy',
                'index_route' => 'cancellation.index',
                'show_route' => 'cancellation.show',
                'toc' => '24-Hour Cancellation Policy',
                'action' => 'How To Cancel Online',
                'timing' => 'Refund Process & Timing',
            ],
            'flight-change' => [
                'title' => 'Flight Change Policy',
                'index_route' => 'flight-change.index',
                'show_route' => 'flight-change.show',
                'toc' => 'Flight Change Policy',
                'action' => 'How To Change Online',
                'timing' => 'Schedule Changes',
            ],
            'name-change' => [
                'title' => 'Name Change Policy',
                'index_route' => 'name-change.index',
                'show_route' => 'name-change.show',
                'toc' => 'Name Correction Rules',
                'action' => 'How To Request A Name Change',
                'timing' => 'Processing Time',
            ],
            'reservation-policy' => [
                'title' => 'Reservation Policy',
                'index_route' => 'reservation-policy.index',
                'show_route' => 'reservation-policy.show',
                'toc' => 'Reservation Rules',
                'action' => 'How To Manage A Reservation',
                'timing' => 'Booking Timelines',
            ],
            'baggage-policy' => [
                'title' => 'Baggage Policy',
                'index_route' => 'baggage-policy.index',
                'show_route' => 'baggage-policy.show',
                'toc' => 'Baggage Allowance',
                'action' => 'How To Add Baggage',
                'timing' => 'Delayed And Lost Baggage',
            ],
            'refund-policy' => [
                'title' => 'Refund Policy',
                'index_route' => 'refund-policy.index',
                'show_route' => 'refund-policy.show',
                'toc' => 'Refund Eligibility',
                'action' => 'How To Request A Refund',
                'timing' => 'Refund Process & Timing',
            ],
        };

        $meta['faqs'] = [
            [
                'question' => "Where can I find the latest {$meta['title']}?",
                'answer' => 'Review the policy details on this page and confirm the latest rules with the airline before making changes to your booking.',
            ],
            [
                'question' => 'Do the rules vary by ticket or fare type?',
                'answer' => 'Yes. Basic, standard, flexible, refundable, award, and promotional fares can have different allowances, fees, and restrictions.',
            ],
            [
                'question' => 'Can I manage this request online?',
                'answer' => 'Many requests can be handled through the airline’s Manage Booking section. Complex cases may require assistance from customer support.',
            ],
            [
                'question' => 'What information should I have ready?',
                'answer' => 'Keep your booking reference, passenger name, ticket number, travel dates, and any supporting documents available.',
            ],
            [
                'question' => 'How long does processing usually take?',
                'answer' => 'Processing time depends on the request and payment method. Contact the airline if the published processing period has passed.',
            ],
        ];

        return $meta;
    }
}
