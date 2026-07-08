<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $airlinesRaw = PolicyController::getAirlines();
        $airlines = [];
        foreach($airlinesRaw as $slug => $data) {
            $airlines[] = [
                'name' => $data['name'],
                'image' => $data['image'],
                'link' => route('cancellation.show', $slug)
            ];
        }

        // Implement pagination, set to 6 per page
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 6; 
        $currentItems = array_slice($airlines, $perPage * ($currentPage - 1), $perPage);
        $paginatedAirlines = new LengthAwarePaginator($currentItems, count($airlines), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        $services = [
            ['icon' => 'fas fa-headset', 'title' => '24/7 Global Support', 'desc' => 'We are here to help you anywhere, anytime with premium care.'],
            ['icon' => 'fas fa-couch', 'title' => 'Lounge Access', 'desc' => 'Exclusive entry to premium airport lounges worldwide.'],
            ['icon' => 'fas fa-shield-alt', 'title' => 'Travel Protection', 'desc' => 'Comprehensive insurance and secure bookings for peace of mind.']
        ];

        $testimonials = [
            ['name' => 'Sarah Jenkins', 'role' => 'Frequent Flyer', 'quote' => 'FlightRules made understanding complex airline policies incredibly easy. The luxury service is top-notch.', 'image' => asset('images/testimonial_avatar_1783532215709.png')],
            ['name' => 'David Lee', 'role' => 'Business Traveler', 'quote' => 'I save so much time and hassle using this platform. Truly a premium experience.', 'image' => asset('images/testimonial_avatar_1783532215709.png')],
            ['name' => 'Emma Watson', 'role' => 'Travel Blogger', 'quote' => 'The best resource for travel rules. Period. Highly recommended!', 'image' => asset('images/testimonial_avatar_1783532215709.png')]
        ];

        return view('home', [
            'airlines' => $paginatedAirlines,
            'services' => $services,
            'testimonials' => $testimonials
        ]);
    }
}
