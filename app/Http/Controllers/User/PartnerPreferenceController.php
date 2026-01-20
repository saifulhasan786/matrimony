<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PartnerPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerPreferenceController extends Controller
{
    public function edit()
    {
        $preference = Auth::user()->partnerPreference ?? new PartnerPreference();
        return view('user.partner-preference.edit', compact('preference'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'age_from' => 'nullable|integer|min:18|max:100',
            'age_to' => 'nullable|integer|min:18|max:100',
            'height_from' => 'nullable|integer|min:100|max:250',
            'height_to' => 'nullable|integer|min:100|max:250',
            'marital_status' => 'nullable|string',
            'religion' => 'nullable|string',
            'caste' => 'nullable|string',
            'mother_tongue' => 'nullable|string',
            'education' => 'nullable|string',
            'occupation' => 'nullable|string',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'annual_income_from' => 'nullable|string',
            'annual_income_to' => 'nullable|string',
            'description' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $preference = $user->partnerPreference ?? new PartnerPreference();
        $preference->user_id = $user->id;
        $preference->fill($validated);
        $preference->save();

        return redirect()->route('user.dashboard')
            ->with('success', 'Partner preferences updated successfully.');
    }
}
