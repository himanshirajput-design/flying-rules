<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FlightChangeController extends Controller
{
    public static function getAirlines()
    {
        return [
            'lufthansa' => ['name' => 'Lufthansa Flight Change Policy', 'image' => asset('images/flight_photo_2_1783531104696.png')],
            'klm' => ['name' => 'KLM Flight Change Policy', 'image' => asset('images/flight_photo_3_1783531118314.png')],
            'allegiant' => ['name' => 'Allegiant Flight Change Policy', 'image' => asset('images/new_flight_photo_1783530893598.png')],
            'qatar-airways' => ['name' => 'Qatar Airways Flight Change Policy', 'image' => asset('images/new_flight_photo_1783530893598.png')],
            'lot-polish' => ['name' => 'Lot Polish Flight Change Policy', 'image' => asset('images/flight_photo_2_1783531104696.png')],
            'iberia' => ['name' => 'Iberia Flight Change Policy', 'image' => asset('images/flight_photo_3_1783531118314.png')],
            'air-new-zealand' => ['name' => 'Air New Zealand Flight Change Policy', 'image' => asset('images/new_flight_photo_1783530893598.png')],
            'cathay-pacific' => ['name' => 'Cathay Pacific Flight Change Policy', 'image' => asset('images/flight_photo_2_1783531104696.png')],
            'latam' => ['name' => 'Latam Flight Change Policy', 'image' => asset('images/flight_photo_3_1783531118314.png')],
            'avianca' => ['name' => 'Avianca Flight Change Policy', 'image' => asset('images/new_flight_photo_1783530893598.png')],
            'royal-jordanian' => ['name' => 'Royal Jordanian Flight Change Policy', 'image' => asset('images/flight_photo_2_1783531104696.png')],
            'etihad' => ['name' => 'Etihad Flight Change Policy', 'image' => asset('images/flight_photo_3_1783531118314.png')],
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
                'link' => route('flight-change.show', $slug)
            ];
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 6; 
        $currentItems = array_slice($airlines, $perPage * ($currentPage - 1), $perPage);
        $paginatedAirlines = new LengthAwarePaginator($currentItems, count($airlines), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        return view('flight-change.index', ['airlines' => $paginatedAirlines]);
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
                $data['link'] = route('flight-change.show', $slug);
                $relatedAirlines[] = $data;
                $count++;
            }
        }

        return view('flight-change.show', compact('airlineData', 'relatedAirlines'));
    }
}
