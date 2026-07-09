<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ReservationPolicyController extends Controller
{
    public static function getAirlines()
    {
        return [
            'lufthansa' => ['name' => 'Lufthansa Reservation Policy Policy', 'image' => asset('images/flight_photo_2_1783531104696.png')],
            'klm' => ['name' => 'KLM Reservation Policy Policy', 'image' => asset('images/flight_photo_3_1783531118314.png')],
            'allegiant' => ['name' => 'Allegiant Reservation Policy Policy', 'image' => asset('images/new_flight_photo_1783530893598.png')],
            'qatar-airways' => ['name' => 'Qatar Airways Reservation Policy Policy', 'image' => asset('images/new_flight_photo_1783530893598.png')],
            'lot-polish' => ['name' => 'Lot Polish Reservation Policy Policy', 'image' => asset('images/flight_photo_2_1783531104696.png')],
            'iberia' => ['name' => 'Iberia Reservation Policy Policy', 'image' => asset('images/flight_photo_3_1783531118314.png')],
            'air-new-zealand' => ['name' => 'Air New Zealand Reservation Policy Policy', 'image' => asset('images/new_flight_photo_1783530893598.png')],
            'cathay-pacific' => ['name' => 'Cathay Pacific Reservation Policy Policy', 'image' => asset('images/flight_photo_2_1783531104696.png')],
            'latam' => ['name' => 'Latam Reservation Policy Policy', 'image' => asset('images/flight_photo_3_1783531118314.png')],
            'avianca' => ['name' => 'Avianca Reservation Policy Policy', 'image' => asset('images/new_flight_photo_1783530893598.png')],
            'royal-jordanian' => ['name' => 'Royal Jordanian Reservation Policy Policy', 'image' => asset('images/flight_photo_2_1783531104696.png')],
            'etihad' => ['name' => 'Etihad Reservation Policy Policy', 'image' => asset('images/flight_photo_3_1783531118314.png')],
        ];
    }

    public function index(Request $request)
    {
        $airlinesRaw = self::getAirlines();
        $airlines = [];
        foreach($airlinesRaw as $slug => $data) {
            $airlines[] = [
                'name' => $data['name'],
                'image' => $data['image'],
                'link' => route('reservation-policy.show', $slug)
            ];
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 6; 
        $currentItems = array_slice($airlines, $perPage * ($currentPage - 1), $perPage);
        $paginatedAirlines = new LengthAwarePaginator($currentItems, count($airlines), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        return view('reservation-policy.index', ['airlines' => $paginatedAirlines]);
    }

    public function show($airline)
    {
        $airlines = self::getAirlines();
        if (!array_key_exists($airline, $airlines)) {
            abort(404);
        }

        $airlineData = $airlines[$airline];
        
        $relatedAirlines = [];
        $count = 0;
        foreach($airlines as $slug => $data) {
            if ($slug !== $airline && $count < 3) {
                $data['link'] = route('reservation-policy.show', $slug);
                $relatedAirlines[] = $data;
                $count++;
            }
        }

        return view('reservation-policy.show', compact('airlineData', 'relatedAirlines'));
    }
}
