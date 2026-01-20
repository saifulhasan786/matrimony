<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterestController extends Controller
{
    public function index()
    {
        $sentInterests = Interest::with(['receiver.profile'])
            ->where('sender_id', Auth::id())
            ->latest()
            ->paginate(10);

        $receivedInterests = Interest::with(['sender.profile'])
            ->where('receiver_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.interests.index', compact('sentInterests', 'receivedInterests'));
    }

    public function send(Request $request, $userId)
    {
        $validated = $request->validate([
            'message' => 'nullable|string|max:500',
        ]);

        // Check if interest already exists
        $exists = Interest::where('sender_id', Auth::id())
            ->where('receiver_id', $userId)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You have already sent an interest to this user.');
        }

        Interest::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $userId,
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Interest sent successfully.');
    }

    public function respond(Request $request, $interestId)
    {
        $interest = Interest::where('receiver_id', Auth::id())
            ->findOrFail($interestId);

        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $interest->update([
            'status' => $validated['status'],
            'responded_at' => now(),
        ]);

        $message = $validated['status'] === 'accepted'
            ? 'Interest accepted successfully.'
            : 'Interest rejected.';

        return back()->with('success', $message);
    }

    public function cancel($interestId)
    {
        $interest = Interest::where('sender_id', Auth::id())
            ->findOrFail($interestId);

        $interest->update(['status' => 'cancelled']);

        return back()->with('success', 'Interest cancelled.');
    }
}
