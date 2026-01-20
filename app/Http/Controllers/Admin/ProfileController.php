<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = Profile::with('user');

        if ($request->has('status')) {
            $query->where('profile_status', $request->status);
        }

        $profiles = $query->latest()->paginate(20);
        return view('admin.profiles.index', compact('profiles'));
    }

    public function show($id)
    {
        $profile = Profile::with('user')->findOrFail($id);
        return view('admin.profiles.show', compact('profile'));
    }

    public function approve($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->update([
            'profile_status' => 'approved',
            'profile_verified' => true
        ]);

        return redirect()->back()->with('success', 'Profile approved successfully.');
    }

    public function reject($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->update(['profile_status' => 'rejected']);

        return redirect()->back()->with('success', 'Profile rejected.');
    }
}
