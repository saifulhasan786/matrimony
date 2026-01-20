<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Get unique conversations
        $conversations = DB::table('messages')
            ->select(DB::raw('CASE
                WHEN sender_id = ' . $userId . ' THEN receiver_id
                ELSE sender_id
            END as user_id'))
            ->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->groupBy('user_id')
            ->get()
            ->pluck('user_id');

        $users = User::with('profile')
            ->whereIn('id', $conversations)
            ->get();

        return view('user.messages.index', compact('users'));
    }

    public function show($userId)
    {
        $messages = Message::where(function($q) use ($userId) {
                $q->where('sender_id', Auth::id())
                  ->where('receiver_id', $userId);
            })
            ->orWhere(function($q) use ($userId) {
                $q->where('sender_id', $userId)
                  ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark messages as read
        Message::where('sender_id', $userId)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        $user = User::with('profile')->findOrFail($userId);

        return view('user.messages.show', compact('messages', 'user'));
    }

    public function send(Request $request, $userId)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $userId,
            'message' => $validated['message'],
        ]);

        return back()->with('success', 'Message sent successfully.');
    }
}
