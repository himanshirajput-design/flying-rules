<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airline;
use App\Models\Policy;

class ReservationPolicyController extends Controller
{
    public static function getAirlines()
    {
        return Airline::all()->keyBy('slug')->toArray();
    }

    public function index(Request $request)
    {
        $airlines = Airline::paginate(6);
        
        $airlines->getCollection()->transform(function ($airline) {
            $airline->link = route('reservation-policy.show', $airline->slug);
            $airline->image = asset($airline->image);
            return $airline;
        });

        return view('reservation-policy.index', ['airlines' => $airlines]);
    }

    public function show($airline)
    {
        $airlineModel = Airline::where('slug', $airline)->firstOrFail();
        
        $airlineData = $airlineModel->toArray();
        $airlineData['image'] = asset($airlineData['image']);
        $airlineData['policy'] = $airlineModel->policies()->where('type', 'reservation-policy')->first();
        
        $relatedAirlinesRaw = Airline::where('slug', '!=', $airline)->inRandomOrder()->take(3)->get();
        $relatedAirlines = [];
        foreach($relatedAirlinesRaw as $rel) {
            $relatedAirlines[] = [
                'name' => $rel->name,
                'image' => asset($rel->image),
                'link' => route('reservation-policy.show', $rel->slug)
            ];
        }

        return view('reservation-policy.show', compact('airlineData', 'relatedAirlines'));
    }
}