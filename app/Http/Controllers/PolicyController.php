<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airline;
use App\Models\Policy;
use App\Models\PolicyType;
use Illuminate\Validation\Rule;

class PolicyController extends Controller
{
    public function adminIndex()
    {
        $policies = Policy::with('airline')->orderBy('airline_id')->get();
        return view('admin.policies.index', compact('policies'));
    }

    public function adminCreate()
    {
        $airlines = Airline::all();
        $types = PolicyType::orderBy('name')->get();
        return view('admin.policies.create', compact('airlines', 'types'));
    }

    public function adminStore(Request $request)
    {
        $validated = $this->validatePolicy($request);

        if (Policy::where('airline_id', $validated['airline_id'])->where('type', $validated['type'])->exists()) {
            return back()->withErrors([
                'type' => "A {$validated['type']} policy already exists for this airline. Please edit it instead.",
            ])->withInput();
        }

        Policy::create($validated);
        return redirect()->route('admin.policies.index')->with('success', 'Policy created successfully.');
    }

    public function adminEdit(Policy $policy)
    {
        $airlines = Airline::all();
        $types = PolicyType::orderBy('name')->get();
        return view('admin.policies.edit', compact('policy', 'airlines', 'types'));
    }

    public function adminUpdate(Request $request, Policy $policy)
    {
        $validated = $this->validatePolicy($request);
        $duplicateExists = Policy::where('airline_id', $validated['airline_id'])
            ->where('type', $validated['type'])
            ->whereKeyNot($policy->getKey())
            ->exists();

        if ($duplicateExists) {
            return back()->withErrors([
                'type' => "A {$validated['type']} policy already exists for this airline.",
            ])->withInput();
        }

        $policy->update($validated);
        return redirect()->route('admin.policies.index')->with('success', 'Policy updated successfully.');
    }

    public function adminDestroy(Policy $policy)
    {
        $policy->delete();
        return redirect()->route('admin.policies.index')->with('success', 'Policy deleted successfully.');
    }

    private function validatePolicy(Request $request): array
    {
        $validated = $request->validate([
            'airline_id' => ['required', 'exists:airlines,id'],
            'type' => ['required', 'string', Rule::exists('policy_types', 'slug')],
            'content' => ['required'],
            'faqs' => ['nullable', 'array'],
            'faqs.*.question' => ['required', 'string', 'max:500'],
            'faqs.*.answer' => ['required', 'string', 'max:5000'],
        ]);

        $validated['faqs'] = $validated['faqs'] ?? [];

        return $validated;
    }

}
