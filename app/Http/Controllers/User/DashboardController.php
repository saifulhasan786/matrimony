<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile;

        $stats = [
            'profile_views' => 0, // Can be implemented with a views table
            'interests_sent' => Interest::where('sender_id', $user->id)->count(),
            'interests_received' => Interest::where('receiver_id', $user->id)->where('status', 'pending')->count(),
            'messages' => Message::where('receiver_id', $user->id)->where('is_read', false)->count(),
        ];

        $recentInterests = Interest::with(['sender.profile', 'receiver.profile'])
            ->where('receiver_id', $user->id)
            ->orWhere('sender_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $matches = User::with('profile')
            ->where('id', '!=', $user->id)
            ->where('gender', '!=', $user->gender)
            ->where('status', 'active')
            ->whereHas('profile', function($q) {
                $q->where('profile_status', 'approved');
            })
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('user.dashboard', compact('user', 'profile', 'stats', 'recentInterests', 'matches'));
    }
}
