<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use App\Models\Airline;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        $policies = Policy::with('airline')->orderBy('airline_id')->get();
        return view('admin.policies.index', compact('policies'));
    }

    public function create()
    {
        $airlines = Airline::all();
        $types = ['cancellation', 'flight-change', 'name-change', 'reservation-policy', 'baggage-policy', 'refund-policy'];
        return view('admin.policies.create', compact('airlines', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'airline_id' => 'required|exists:airlines,id',
            'type' => 'required|string',
            'content' => 'required',
        ]);

        // Ensure a policy of this type doesn't already exist for this airline
        if (Policy::where('airline_id', $request->airline_id)->where('type', $request->type)->exists()) {
            return back()->withErrors(['type' => 'A ' . $request->type . ' policy already exists for this airline. Please edit it instead.'])->withInput();
        }

        Policy::create($request->all());

        return redirect()->route('admin.policies.index')->with('success', 'Policy created successfully.');
    }

    public function edit(Policy $policy)
    {
        $airlines = Airline::all();
        $types = ['cancellation', 'flight-change', 'name-change', 'reservation-policy', 'baggage-policy', 'refund-policy'];
        return view('admin.policies.edit', compact('policy', 'airlines', 'types'));
    }

    public function update(Request $request, Policy $policy)
    {
        $request->validate([
            'airline_id' => 'required|exists:airlines,id',
            'type' => 'required|string',
            'content' => 'required',
        ]);

        // Check if we are changing type/airline to one that already exists
        if ($policy->airline_id != $request->airline_id || $policy->type != $request->type) {
            if (Policy::where('airline_id', $request->airline_id)->where('type', $request->type)->exists()) {
                return back()->withErrors(['type' => 'A ' . $request->type . ' policy already exists for this airline.'])->withInput();
            }
        }

        $policy->update($request->all());

        return redirect()->route('admin.policies.index')->with('success', 'Policy updated successfully.');
    }

    public function destroy(Policy $policy)
    {
        $policy->delete();
        return redirect()->route('admin.policies.index')->with('success', 'Policy deleted successfully.');
    }
}
