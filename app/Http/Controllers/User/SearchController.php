<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('profile')
            ->where('id', '!=', Auth::id())
            ->where('status', 'active')
            ->whereHas('profile', function($q) {
                $q->where('profile_status', 'approved');
            });

        // Gender filter
        if ($request->has('gender')) {
            $query->where('gender', $request->gender);
        }

        // Age filter
        if ($request->has('age_from')) {
            $date = now()->subYears($request->age_from);
            $query->where('date_of_birth', '<=', $date);
        }
        if ($request->has('age_to')) {
            $date = now()->subYears($request->age_to);
            $query->where('date_of_birth', '>=', $date);
        }

        // Profile filters
        if ($request->has('marital_status')) {
            $query->whereHas('profile', function($q) use ($request) {
                $q->where('marital_status', $request->marital_status);
            });
        }

        if ($request->has('religion')) {
            $query->whereHas('profile', function($q) use ($request) {
                $q->where('religion', $request->religion);
            });
        }

        if ($request->has('education')) {
            $query->whereHas('profile', function($q) use ($request) {
                $q->where('education', 'like', '%' . $request->education . '%');
            });
        }

        if ($request->has('occupation')) {
            $query->whereHas('profile', function($q) use ($request) {
                $q->where('occupation', 'like', '%' . $request->occupation . '%');
            });
        }

        if ($request->has('city')) {
            $query->whereHas('profile', function($q) use ($request) {
                $q->where('city', 'like', '%' . $request->city . '%');
            });
        }

        $users = $query->paginate(12);

        return view('user.search.index', compact('users'));
    }
}
