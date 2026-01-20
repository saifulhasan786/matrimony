@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Profile Completion Alert -->
        @if(!$user->profile_completed)
            <div class="col-md-12 mb-3">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    Your profile is incomplete. <a href="{{ route('user.profile.edit') }}" class="alert-link">Complete your profile</a> to get better matches.
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-eye fa-2x text-primary mb-2"></i>
                    <h3>{{ $stats['profile_views'] }}</h3>
                    <p class="text-muted mb-0">Profile Views</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-heart fa-2x text-danger mb-2"></i>
                    <h3>{{ $stats['interests_sent'] }}</h3>
                    <p class="text-muted mb-0">Interests Sent</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-inbox fa-2x text-success mb-2"></i>
                    <h3>{{ $stats['interests_received'] }}</h3>
                    <p class="text-muted mb-0">New Interests</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-envelope fa-2x text-info mb-2"></i>
                    <h3>{{ $stats['messages'] }}</h3>
                    <p class="text-muted mb-0">Unread Messages</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Interests -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-heart text-danger"></i> Recent Interests</h5>
                </div>
                <div class="card-body">
                    @forelse($recentInterests as $interest)
                        <div class="d-flex align-items-center mb-3 p-2 border-bottom">
                            @if($interest->sender_id === $user->id)
                                <div>
                                    <strong>You</strong> sent interest to <strong>{{ $interest->receiver->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $interest->created_at->diffForHumans() }}</small>
                                    <br>
                                    <span class="badge bg-{{ $interest->status === 'pending' ? 'warning' : ($interest->status === 'accepted' ? 'success' : 'danger') }}">
                                        {{ ucfirst($interest->status) }}
                                    </span>
                                </div>
                            @else
                                <div>
                                    <strong>{{ $interest->sender->name }}</strong> sent you interest
                                    <br>
                                    <small class="text-muted">{{ $interest->created_at->diffForHumans() }}</small>
                                    <br>
                                    @if($interest->status === 'pending')
                                        <form action="{{ route('user.interests.respond', $interest->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                        </form>
                                        <form action="{{ route('user.interests.respond', $interest->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                        </form>
                                    @else
                                        <span class="badge bg-{{ $interest->status === 'accepted' ? 'success' : 'danger' }}">
                                            {{ ucfirst($interest->status) }}
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-center text-muted">No interests yet</p>
                    @endforelse
                    <a href="{{ route('user.interests.index') }}" class="btn btn-primary btn-sm w-100">View All Interests</a>
                </div>
            </div>
        </div>

        <!-- Suggested Matches -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-users text-primary"></i> Suggested Matches</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($matches as $match)
                            <div class="col-md-6 mb-3">
                                <div class="card profile-card">
                                    <div class="card-body text-center p-2">
                                        @if($match->profile && $match->profile->profile_picture)
                                            <img src="{{ asset('storage/' . $match->profile->profile_picture) }}"
                                                 alt="{{ $match->name }}" class="rounded-circle mb-2"
                                                 style="width: 80px; height: 80px; object-fit: cover;">
                                        @else
                                            <i class="fas fa-user-circle fa-4x text-muted mb-2"></i>
                                        @endif
                                        <h6 class="mb-1">{{ $match->name }}</h6>
                                        @if($match->profile)
                                            <small class="text-muted">
                                                {{ $match->profile->city ?? 'N/A' }},
                                                {{ \Carbon\Carbon::parse($match->date_of_birth)->age ?? 'N/A' }} yrs
                                            </small>
                                        @endif
                                        <div class="mt-2">
                                            <a href="{{ route('user.profile.view', $match->id) }}" class="btn btn-sm btn-outline-primary">
                                                View Profile
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">No matches found</p>
                        @endforelse
                    </div>
                    <a href="{{ route('user.search') }}" class="btn btn-primary btn-sm w-100">Browse All Profiles</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
