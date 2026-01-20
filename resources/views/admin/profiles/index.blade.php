@extends('layouts.admin')

@section('title', 'Profiles Management')
@section('page-title', 'Profiles Management')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0">All Profiles</h5>
            </div>
            <div class="col-auto">
                <form action="{{ route('admin.profiles.index') }}" method="GET" class="d-flex">
                    <select name="status" class="form-select form-select-sm me-2">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>City</th>
                        <th>Religion</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($profiles as $profile)
                        <tr>
                            <td>{{ $profile->id }}</td>
                            <td>{{ $profile->user->name }}</td>
                            <td>{{ ucfirst($profile->user->gender) }}</td>
                            <td>{{ \Carbon\Carbon::parse($profile->user->date_of_birth)->age }} years</td>
                            <td>{{ $profile->city ?? 'N/A' }}</td>
                            <td>{{ $profile->religion ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-{{ $profile->profile_status === 'pending' ? 'warning' : ($profile->profile_status === 'approved' ? 'success' : 'danger') }}">
                                    {{ ucfirst($profile->profile_status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.profiles.show', $profile->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                @if($profile->profile_status === 'pending')
                                    <form action="{{ route('admin.profiles.approve', $profile->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.profiles.reject', $profile->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No profiles found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $profiles->links() }}
        </div>
    </div>
</div>
@endsection
