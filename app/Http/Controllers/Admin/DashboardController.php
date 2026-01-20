<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use App\Models\Interest;
use App\Models\Subscription;
use App\Models\SuccessStory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::where('status', 'active')->count(),
            'total_profiles' => Profile::count(),
            'pending_profiles' => Profile::where('profile_status', 'pending')->count(),
            'approved_profiles' => Profile::where('profile_status', 'approved')->count(),
            'total_interests' => Interest::count(),
            'pending_interests' => Interest::where('status', 'pending')->count(),
            'active_subscriptions' => Subscription::where('status', 'active')->count(),
            'success_stories' => SuccessStory::where('is_approved', true)->count(),
        ];

        $recentUsers = User::with('profile')->latest()->take(10)->get();
        $pendingProfiles = Profile::with('user')
            ->where('profile_status', 'pending')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'pendingProfiles'));
    }
}

