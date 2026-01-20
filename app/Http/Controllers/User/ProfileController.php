<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show($id = null)
    {
        if ($id) {
            $profile = Profile::with('user')->findOrFail($id);
        } else {
            $profile = Auth::user()->profile;
        }
        return view('user.profile.show', compact('profile'));
    }

    public function edit()
    {
        $profile = Auth::user()->profile ?? new Profile();
        return view('user.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'profile_for' => 'nullable|string',
            'height' => 'nullable|integer|min:100|max:250',
            'weight' => 'nullable|integer|min:30|max:200',
            'marital_status' => 'nullable|in:never_married,divorced,widowed,awaiting_divorce',
            'mother_tongue' => 'nullable|string',
            'religion' => 'nullable|string',
            'caste' => 'nullable|string',
            'education' => 'nullable|string',
            'occupation' => 'nullable|string',
            'annual_income' => 'nullable|string',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'about_me' => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();
        $profile = $user->profile ?? new Profile();
        $profile->user_id = $user->id;

        if ($request->hasFile('profile_picture')) {
            if ($profile->profile_picture) {
                Storage::delete($profile->profile_picture);
            }
            $validated['profile_picture'] = $request->file('profile_picture')
                ->store('profiles', 'public');
        }

        $profile->fill($validated);
        $profile->save();

        if (!$user->profile_completed) {
            $user->profile_completed = true;
            $user->save();
        }

        return redirect()->route('user.profile.show')
            ->with('success', 'Profile updated successfully.');
    }
}
