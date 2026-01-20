@extends('layouts.app')

@section('title', 'Search Profiles')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-filter"></i> Search Filters</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.search') }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select form-select-sm">
                                <option value="">Any</option>
                                <option value="male" {{ request('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ request('gender') === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Age Range</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="number" name="age_from" class="form-control form-control-sm"
                                           placeholder="From" value="{{ request('age_from') }}">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="age_to" class="form-control form-control-sm"
                                           placeholder="To" value="{{ request('age_to') }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Marital Status</label>
                            <select name="marital_status" class="form-select form-select-sm">
                                <option value="">Any</option>
                                <option value="never_married">Never Married</option>
                                <option value="divorced">Divorced</option>
                                <option value="widowed">Widowed</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Religion</label>
                            <input type="text" name="religion" class="form-control form-control-sm"
                                   placeholder="Religion" value="{{ request('religion') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Education</label>
                            <input type="text" name="education" class="form-control form-control-sm"
                                   placeholder="Education" value="{{ request('education') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Occupation</label>
                            <input type="text" name="occupation" class="form-control form-control-sm"
                                   placeholder="Occupation" value="{{ request('occupation') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control form-control-sm"
                                   placeholder="City" value="{{ request('city') }}">
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-search"></i> Apply Filters
                        </button>
                        <a href="{{ route('user.search') }}" class="btn btn-secondary btn-sm w-100 mt-2">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Results -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Search Results ({{ $users->total() }} profiles found)</h4>
            </div>

            <div class="row">
                @forelse($users as $user)
                    <div class="col-md-4 mb-4">
                        <div class="card profile-card h-100">
                            <div class="card-body text-center">
                                @if($user->profile && $user->profile->profile_picture)
                                    <img src="{{ asset('storage/' . $user->profile->profile_picture) }}"
                                         alt="{{ $user->name }}" class="rounded-circle mb-3"
                                         style="width: 120px; height: 120px; object-fit: cover;">
                                @else
                                    <i class="fas fa-user-circle fa-5x text-muted mb-3"></i>
                                @endif

                                <h5 class="card-title mb-1">{{ $user->name }}</h5>
                                @if($user->profile)
                                    <p class="text-muted small mb-2">
                                        {{ \Carbon\Carbon::parse($user->date_of_birth)->age }} years |
                                        {{ $user->profile->height ? $user->profile->height . ' cm' : 'N/A' }}
                                    </p>
                                    <p class="text-muted small">
                                        <i class="fas fa-map-marker-alt"></i> {{ $user->profile->city ?? 'N/A' }}, {{ $user->profile->state ?? 'N/A' }}
                                    </p>
                                    <p class="text-muted small">
                                        <i class="fas fa-briefcase"></i> {{ $user->profile->occupation ?? 'N/A' }}
                                    </p>
                                    <p class="text-muted small">
                                        <i class="fas fa-graduation-cap"></i> {{ $user->profile->education ?? 'N/A' }}
                                    </p>
                                @endif

                                <div class="mt-3">
                                    <a href="{{ route('user.profile.view', $user->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> View Profile
                                    </a>
                                    <form action="{{ route('user.interests.send', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-heart"></i> Send Interest
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle"></i> No profiles found matching your criteria. Try adjusting your filters.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
