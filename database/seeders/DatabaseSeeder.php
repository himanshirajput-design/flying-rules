<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airline;
use App\Models\Policy;

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

    }
}
