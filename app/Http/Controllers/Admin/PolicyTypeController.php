<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use App\Models\PolicyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PolicyTypeController extends Controller
{
    public function index()
    {
        $policyTypes = PolicyType::orderBy('name')->get();

        return view('admin.policy-types.index', compact('policyTypes'));
    }

    public function create()
    {
        return view('admin.policy-types.create');
    }

    public function store(Request $request)
    {
        PolicyType::create($this->validated($request));

        return redirect()->route('admin.policy-types.index')->with('success', 'Policy type created successfully.');
    }

    public function edit(PolicyType $policyType)
    {
        return view('admin.policy-types.edit', compact('policyType'));
    }

    public function update(Request $request, PolicyType $policyType)
    {
        $data = $this->validated($request, $policyType);

        DB::transaction(function () use ($policyType, $data) {
            Policy::where('type', $policyType->slug)->update(['type' => $data['slug']]);
            $policyType->update($data);
        });

        return redirect()->route('admin.policy-types.index')->with('success', 'Policy type updated successfully.');
    }

    public function destroy(PolicyType $policyType)
    {
        if (Policy::where('type', $policyType->slug)->exists()) {
            return back()->with('error', 'This policy type is in use. Delete its policies before deleting the type.');
        }

        $policyType->delete();

        return redirect()->route('admin.policy-types.index')->with('success', 'Policy type deleted successfully.');
    }

    private function validated(Request $request, ?PolicyType $policyType = null): array
    {
        $request->merge(['slug' => Str::slug($request->input('slug') ?: $request->input('name'))]);

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('policy_types')->ignore($policyType)],
        ]);
    }
}
