@extends('layouts.app')

@section('title', 'Interests')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4"><i class="fas fa-heart text-danger"></i> Interest Management</h2>

            <ul class="nav nav-tabs mb-4" id="interestTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="received-tab" data-bs-toggle="tab" data-bs-target="#received" type="button" role="tab">
                        <i class="fas fa-inbox"></i> Received Interests
                        <span class="badge bg-danger">{{ $receivedInterests->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sent-tab" data-bs-toggle="tab" data-bs-target="#sent" type="button" role="tab">
                        <i class="fas fa-paper-plane"></i> Sent Interests
                        <span class="badge bg-primary">{{ $sentInterests->count() }}</span>
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="interestTabContent">
                <!-- Received Interests -->
                <div class="tab-pane fade show active" id="received" role="tabpanel">
                    @forelse($receivedInterests as $interest)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-2 text-center">
                                        @if($interest->sender->profile && $interest->sender->profile->profile_picture)
                                            <img src="{{ asset('storage/' . $interest->sender->profile->profile_picture) }}"
                                                 alt="{{ $interest->sender->name }}" class="rounded-circle"
                                                 style="width: 80px; height: 80px; object-fit: cover;">
                                        @else
                                            <i class="fas fa-user-circle fa-4x text-muted"></i>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="mb-1">{{ $interest->sender->name }}</h5>
                                        @if($interest->sender->profile)
                                            <p class="text-muted small mb-1">
                                                <i class="fas fa-briefcase"></i> {{ $interest->sender->profile->occupation ?? 'N/A' }} |
                                                <i class="fas fa-map-marker-alt"></i> {{ $interest->sender->profile->city ?? 'N/A' }}
                                            </p>
                                        @endif
                                        @if($interest->message)
                                            <p class="mb-1"><strong>Message:</strong> {{ $interest->message }}</p>
                                        @endif
                                        <small class="text-muted">Sent {{ $interest->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        @if($interest->status === 'pending')
                                            <div class="d-grid gap-2">
                                                <form action="{{ route('user.interests.respond', $interest->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button type="submit" class="btn btn-success w-100 mb-2">
                                                        <i class="fas fa-check"></i> Accept Interest
                                                    </button>
                                                </form>
                                                <form action="{{ route('user.interests.respond', $interest->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="btn btn-danger w-100">
                                                        <i class="fas fa-times"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="badge bg-{{ $interest->status === 'accepted' ? 'success' : 'danger' }} fs-6">
                                                {{ ucfirst($interest->status) }}
                                            </span>
                                        @endif
                                        <a href="{{ route('user.profile.view', $interest->sender_id) }}" class="btn btn-sm btn-outline-primary w-100 mt-2">
                                            <i class="fas fa-eye"></i> View Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle"></i> No interests received yet
                        </div>
                    @endforelse

                    <div class="mt-3">
                        {{ $receivedInterests->links() }}
                    </div>
                </div>

                <!-- Sent Interests -->
                <div class="tab-pane fade" id="sent" role="tabpanel">
                    @forelse($sentInterests as $interest)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-2 text-center">
                                        @if($interest->receiver->profile && $interest->receiver->profile->profile_picture)
                                            <img src="{{ asset('storage/' . $interest->receiver->profile->profile_picture) }}"
                                                 alt="{{ $interest->receiver->name }}" class="rounded-circle"
                                                 style="width: 80px; height: 80px; object-fit: cover;">
                                        @else
                                            <i class="fas fa-user-circle fa-4x text-muted"></i>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="mb-1">{{ $interest->receiver->name }}</h5>
                                        @if($interest->receiver->profile)
                                            <p class="text-muted small mb-1">
                                                <i class="fas fa-briefcase"></i> {{ $interest->receiver->profile->occupation ?? 'N/A' }} |
                                                <i class="fas fa-map-marker-alt"></i> {{ $interest->receiver->profile->city ?? 'N/A' }}
                                            </p>
                                        @endif
                                        <small class="text-muted">Sent {{ $interest->created_at->diffForHumans() }}</small>
                                        @if($interest->responded_at)
                                            <br><small class="text-muted">Responded {{ $interest->responded_at->diffForHumans() }}</small>
                                        @endif
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <span class="badge bg-{{ $interest->status === 'pending' ? 'warning' : ($interest->status === 'accepted' ? 'success' : 'danger') }} fs-6">
                                            {{ ucfirst($interest->status) }}
                                        </span>
                                        @if($interest->status === 'pending')
                                            <form action="{{ route('user.interests.cancel', $interest->id) }}" method="POST" class="mt-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger w-100">
                                                    <i class="fas fa-ban"></i> Cancel Interest
                                                </button>
                                            </form>
                                        @endif
                                        @if($interest->status === 'accepted')
                                            <a href="{{ route('user.messages.show', $interest->receiver_id) }}" class="btn btn-sm btn-primary w-100 mt-2">
                                                <i class="fas fa-envelope"></i> Send Message
                                            </a>
                                        @endif
                                        <a href="{{ route('user.profile.view', $interest->receiver_id) }}" class="btn btn-sm btn-outline-primary w-100 mt-2">
                                            <i class="fas fa-eye"></i> View Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle"></i> You haven't sent any interests yet.
                            <a href="{{ route('user.search') }}" class="alert-link">Browse profiles</a> to find your match.
                        </div>
                    @endforelse

                    <div class="mt-3">
                        {{ $sentInterests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
