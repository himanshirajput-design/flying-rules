<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AirlineController extends Controller
{
    public function index()
    {
        $airlines = Airline::all();
        return view('admin.airlines.index', compact('airlines'));
    }

    public function create()
    {
        return view('admin.airlines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['image', 'logo']);
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

        if ($request->hasFile('image')) {
            $imageName = time() . '_img_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageName);
            $data['image'] = 'images/' . $imageName;
        }

        if ($request->hasFile('logo')) {
            $logoName = time() . '_logo_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(public_path('images'), $logoName);
            $data['logo'] = 'images/' . $logoName;
        }

        Airline::create($data);

        return redirect()->route('admin.airlines.index')->with('success', 'Airline created successfully.');
    }

    public function edit(Airline $airline)
    {
        return view('admin.airlines.edit', compact('airline'));
    }

    public function update(Request $request, Airline $airline)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['image', 'logo']);
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

        if ($request->hasFile('image')) {
            $imageName = time() . '_img_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageName);
            $data['image'] = 'images/' . $imageName;
        }

        if ($request->hasFile('logo')) {
            $logoName = time() . '_logo_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(public_path('images'), $logoName);
            $data['logo'] = 'images/' . $logoName;
        }

        $airline->update($data);

        return redirect()->route('admin.airlines.index')->with('success', 'Airline updated successfully.');
    }

    public function destroy(Airline $airline)
    {
        $airline->delete();
        return redirect()->route('admin.airlines.index')->with('success', 'Airline deleted successfully.');
    }
}
