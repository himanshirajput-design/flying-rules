<?php

namespace Tests\Feature;

use App\Models\Airline;
use App\Models\Policy;
use App\Models\PolicyType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteAirlinePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_airline_page_lists_only_policies_created_for_that_airline(): void
    {
        $airline = Airline::create([
            'name' => 'Policy Air',
            'slug' => 'policy-air',
        ]);

        Policy::create([
            'airline_id' => $airline->id,
            'type' => 'cancellation',
            'content' => '<p>Cancellation details</p>',
        ]);
        Policy::create([
            'airline_id' => $airline->id,
            'type' => 'baggage-policy',
            'content' => '<p>Baggage details</p>',
        ]);

        $response = $this->get(route('airlines.show', $airline->slug));

        $response->assertOk();
        $response->assertSee('Policy Air');
        $response->assertSee('Cancellation Policy');
        $response->assertSee('Baggage Policy');
        $response->assertDontSee(route('flight-change.show', $airline->slug), false);
        $response->assertSee(route('cancellation.show', $airline->slug), false);
        $response->assertSee(route('baggage-policy.show', $airline->slug), false);
    }

    public function test_custom_policy_type_is_listed_and_has_a_working_detail_page(): void
    {
        $airline = Airline::create([
            'name' => 'Custom Air',
            'slug' => 'custom-air',
        ]);
        PolicyType::create([
            'name' => 'Pet Travel Policy',
            'slug' => 'pet-travel',
        ]);
        Policy::create([
            'airline_id' => $airline->id,
            'type' => 'pet-travel',
            'content' => '<p>Pet travel details</p>',
        ]);

        $overview = $this->get(route('airlines.show', $airline->slug));
        $detailUrl = route('policy-types.show', ['type' => 'pet-travel', 'airline' => $airline->slug]);

        $overview->assertOk()->assertSee('Pet Travel Policy')->assertSee($detailUrl, false);
        $this->get($detailUrl)->assertOk()->assertSee('Pet Travel Policy')->assertSee('Pet travel details');
    }

    public function test_detail_page_returns_not_found_when_policy_has_not_been_created(): void
    {
        $airline = Airline::create([
            'name' => 'No Policy Air',
            'slug' => 'no-policy-air',
            'image' => 'images/example.png',
        ]);

        $this->get(route('cancellation.show', $airline->slug))->assertNotFound();
        $this->get(route('cancellation.index'))->assertDontSee('No Policy Air');
        $this->get(route('home'))->assertDontSee('No Policy Air');
    }

    public function test_unclosed_policy_html_does_not_break_the_detail_page_columns(): void
    {
        $airline = Airline::create([
            'name' => 'Example Airlines',
            'slug' => 'example-airlines',
            'image' => 'images/example.png',
        ]);

        Policy::create([
            'airline_id' => $airline->id,
            'type' => 'cancellation',
            'content' => '<div class="outer"><div class="inner">Policy text<!-- FAQ Section --><h3>Frequently Asked Questions</h3><p>Duplicated stored FAQ</p>',
        ]);

        $response = $this->get(route('cancellation.show', $airline->slug));

        $response->assertOk();
        $response->assertDontSee('Frequently Asked Questions');
        $response->assertDontSee('Duplicated stored FAQ');
        $response->assertDontSee('Table of Contents');
        $response->assertDontSee('Related Cancellation Policy');
        $response->assertDontSee('Policies of Example Airlines');
        $response->assertSeeInOrder([
            '<div class="outer"><div class="inner">Policy text</div></div>',
            '<!-- Author Profile -->',
        ], false);
    }

    public function test_empty_optional_sections_and_missing_airline_image_are_hidden(): void
    {
        $airline = Airline::create([
            'name' => 'Minimal Air',
            'slug' => 'minimal-air',
            'image' => null,
        ]);

        Policy::create([
            'airline_id' => $airline->id,
            'type' => 'cancellation',
            'content' => '<p>Only policy content</p>',
        ]);

        $response = $this->get(route('cancellation.show', $airline->slug));

        $response->assertOk();
        $response->assertSee('Only policy content');
        $response->assertDontSee('<img src="" alt="Minimal Air"', false);
        $response->assertDontSee('Frequently Asked Questions');
        $response->assertDontSee('Table of Contents');
        $response->assertDontSee('Related Cancellation Policy');
        $response->assertDontSee('Policies of Minimal Air');
    }

    public function test_detail_page_renders_only_faqs_managed_from_the_admin_panel(): void
    {
        $airline = Airline::create([
            'name' => 'Managed FAQ Airlines',
            'slug' => 'managed-faq-airlines',
            'image' => 'images/example.png',
        ]);

        Policy::create([
            'airline_id' => $airline->id,
            'type' => 'baggage-policy',
            'content' => '<p>Policy content</p>',
            'faqs' => [
                ['question' => 'What is my baggage allowance?', 'answer' => 'Your allowance is shown on your ticket.'],
                ['question' => 'Can I add another bag?', 'answer' => 'Yes, subject to the applicable fee.'],
            ],
        ]);

        $response = $this->get(route('baggage-policy.show', $airline->slug));

        $response->assertOk();
        $response->assertSee('Frequently Asked Questions');
        $response->assertSee('What is my baggage allowance?');
        $response->assertSee('Your allowance is shown on your ticket.');
        $response->assertSee('Can I add another bag?');
        $response->assertSee('Yes, subject to the applicable fee.');
        $response->assertSee('faqCollapse2', false);
    }

    public function test_table_of_contents_lists_only_headings_available_in_policy_content(): void
    {
        $airline = Airline::create([
            'name' => 'Contents Air',
            'slug' => 'contents-air',
            'image' => 'images/example.png',
        ]);

        Policy::create([
            'airline_id' => $airline->id,
            'type' => 'cancellation',
            'content' => '<h2>Cancellation Charges</h2><p>Details</p><h3>Empty Section</h3><p><br></p><h3>Refund Timeline</h3><p>Seven business days.</p>',
        ]);

        $response = $this->get(route('cancellation.show', $airline->slug));

        $response->assertOk();
        $response->assertSee('<h2 id="cancellation-charges">Cancellation Charges</h2>', false);
        $response->assertSee('href="#cancellation-charges"', false);
        $response->assertSee('href="#refund-timeline"', false);
        $response->assertDontSee('Empty Section');
        $response->assertDontSee('href="#empty-section"', false);
        $response->assertDontSee('Fare Types &amp; Rules', false);
        $response->assertDontSee('Basic Economy Tickets');
        $response->assertDontSee('Refundable Tickets');
    }

    public function test_policy_accordion_lists_current_airline_first_and_five_other_airlines(): void
    {
        $currentAirline = Airline::create([
            'name' => 'Current Air',
            'slug' => 'current-air',
            'image' => 'images/current.png',
        ]);

        Policy::create([
            'airline_id' => $currentAirline->id,
            'type' => 'cancellation',
            'content' => '<p>Cancellation content</p>',
        ]);
        Policy::create([
            'airline_id' => $currentAirline->id,
            'type' => 'baggage-policy',
            'content' => '<p>Baggage content</p>',
        ]);

        foreach (range(1, 5) as $number) {
            $airline = Airline::create([
                'name' => "Other Air {$number}",
                'slug' => "other-air-{$number}",
                'image' => "images/other-{$number}.png",
            ]);

            Policy::create([
                'airline_id' => $airline->id,
                'type' => 'cancellation',
                'content' => '<p>Other cancellation content</p>',
            ]);
        }

        $response = $this->get(route('cancellation.show', $currentAirline->slug));

        $response->assertOk();
        $response->assertSee('Policies of Current Air');
        $response->assertSee('Baggage Policy');
        $response->assertSee(route('baggage-policy.show', $currentAirline->slug), false);
        $this->assertSame(6, substr_count($response->getContent(), 'Policies of '));
        $this->assertStringNotContainsString(
            route('cancellation.show', $currentAirline->slug).'" class="airline-policy-link"',
            $response->getContent()
        );
    }
}
