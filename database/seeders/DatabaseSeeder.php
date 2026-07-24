<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airline;
use App\Models\Policy;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Seed Airlines
        $airlinesData = [
            'lufthansa' => ['name' => 'Lufthansa Airlines', 'image' => 'images/flight_photo_2_1783531104696.png'],
            'klm' => ['name' => 'KLM Flight', 'image' => 'images/flight_photo_3_1783531118314.png'],
            'allegiant' => ['name' => 'Allegiant Airlines', 'image' => 'images/new_flight_photo_1783530893598.png'],
            'qatar-airways' => ['name' => 'Qatar Airways', 'image' => 'images/new_flight_photo_1783530893598.png'],
            'lot-polish' => ['name' => 'Lot Polish', 'image' => 'images/flight_photo_2_1783531104696.png'],
            'iberia' => ['name' => 'Iberia', 'image' => 'images/flight_photo_3_1783531118314.png'],
            'air-new-zealand' => ['name' => 'Air New Zealand', 'image' => 'images/new_flight_photo_1783530893598.png'],
            'cathay-pacific' => ['name' => 'Cathay Pacific', 'image' => 'images/flight_photo_2_1783531104696.png'],
            'latam' => ['name' => 'Latam Airlines', 'image' => 'images/flight_photo_3_1783531118314.png'],
            'avianca' => ['name' => 'Avianca Airlines', 'image' => 'images/new_flight_photo_1783530893598.png'],
            'royal-jordanian' => ['name' => 'Royal Jordanian', 'image' => 'images/flight_photo_2_1783531104696.png'],
            'etihad' => ['name' => 'Etihad Airways', 'image' => 'images/flight_photo_3_1783531118314.png'],
        ];

        foreach ($airlinesData as $slug => $data) {
            $airline = Airline::updateOrCreate(
                ['slug' => $slug],
                ['name' => $data['name'], 'image' => $data['image']]
            );

            // Seed dummy policies for each type
            $policyTypes = ['cancellation', 'flight-change', 'name-change', 'reservation-policy', 'baggage-policy', 'refund-policy'];
            foreach ($policyTypes as $type) {
                Policy::updateOrCreate(
                    ['airline_id' => $airline->id, 'type' => $type],
                    ['content' => 'Dummy content for ' . $data['name'] . ' ' . str_replace('-', ' ', $type) . '. This content was auto-seeded.']
                );
            }
        }

        // 2. Seed Posts
        $postsData = \App\Http\Controllers\BlogController::getPosts();
        
        foreach ($postsData as $slug => $post) {
            // Reformat image asset URL back to relative path for DB
            $imagePath = str_replace(asset(''), '', $post['image']);
            
            Post::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                    'image' => $imagePath,
                    'author' => $post['author'],
                    'category' => $post['category'],
                    'published_at' => date('Y-m-d', strtotime($post['date'])),
                ]
            );
        }
    }
}
