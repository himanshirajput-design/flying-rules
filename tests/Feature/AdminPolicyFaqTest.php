<?php

namespace Tests\Feature;

use App\Models\Airline;
use App\Models\Policy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPolicyFaqTest extends TestCase
{
    use RefreshDatabase;

    public function test_removing_all_faqs_clears_them_from_the_policy(): void
    {
        $airline = Airline::create([
            'name' => 'FAQ Test Air',
            'slug' => 'faq-test-air',
        ]);

        $policy = Policy::create([
            'airline_id' => $airline->id,
            'type' => 'cancellation',
            'content' => '<p>Policy content</p>',
            'faqs' => [
                ['question' => 'Old question?', 'answer' => 'Old answer.'],
            ],
        ]);

        $response = $this->actingAs(User::factory()->create())->put(
            route('admin.policies.update', $policy),
            [
                'airline_id' => $airline->id,
                'type' => 'cancellation',
                'content' => '<p>Policy content</p>',
            ]
        );

        $response->assertRedirect(route('admin.policies.index'));
        $this->assertSame([], $policy->refresh()->faqs);
    }
}
