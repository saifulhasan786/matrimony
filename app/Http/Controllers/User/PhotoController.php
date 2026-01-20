<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Auth::user()->photos()->orderBy('order')->get();
        return view('user.photos.index', compact('photos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'photo' => 'required|image|max:2048',
            'privacy' => 'required|in:public,private,members_only',
        ]);

        $path = $request->file('photo')->store('photos', 'public');

        Photo::create([
            'user_id' => Auth::id(),
            'photo_path' => $path,
            'privacy' => $validated['privacy'],
        ]);

        return back()->with('success', 'Photo uploaded successfully.');
    }

    public function setAsProfile($photoId)
    {
        // Remove current profile picture flag
        Photo::where('user_id', Auth::id())
            ->update(['is_profile_picture' => false]);

        // Set new profile picture
        $photo = Photo::where('user_id', Auth::id())
            ->findOrFail($photoId);
        $photo->is_profile_picture = true;
        $photo->save();

        return back()->with('success', 'Profile picture updated.');
    }

    public function destroy($photoId)
    {
        $photo = Photo::where('user_id', Auth::id())
            ->findOrFail($photoId);

        Storage::delete($photo->photo_path);
        $photo->delete();

        return back()->with('success', 'Photo deleted successfully.');
    }
}
