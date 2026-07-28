<?php

namespace Tests\Feature;

use App\Models\Airline;
use App\Models\Policy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteAirlinePageTest extends TestCase
{
    use RefreshDatabase;

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
        $this->assertSame(1, substr_count($response->getContent(), 'Frequently Asked Questions'));
        $response->assertDontSee('Duplicated stored FAQ');
        $response->assertSee('faqCollapse5', false);
        $response->assertSeeInOrder([
            '<div class="outer"><div class="inner">Policy text</div></div>',
            '<!-- FAQ Section -->',
            '<!-- Sidebar (Table of Contents) -->',
            '<div class="col-md-4"',
        ], false);
    }

    public function test_policy_uses_the_faqs_managed_from_the_admin_panel(): void
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
        $response->assertSee('What is my baggage allowance?');
        $response->assertSee('Can I add another bag?');
        $response->assertDontSee('Where can I find the latest Baggage Policy?');
        $response->assertDontSee('faqCollapse3', false);
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
