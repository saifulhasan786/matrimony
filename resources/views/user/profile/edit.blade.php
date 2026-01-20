@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Your Profile</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Profile For -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Profile Created For</label>
                                <select name="profile_for" class="form-select">
                                    <option value="">Select</option>
                                    <option value="self" {{ old('profile_for', $profile->profile_for ?? '') === 'self' ? 'selected' : '' }}>Self</option>
                                    <option value="son" {{ old('profile_for', $profile->profile_for ?? '') === 'son' ? 'selected' : '' }}>Son</option>
                                    <option value="daughter" {{ old('profile_for', $profile->profile_for ?? '') === 'daughter' ? 'selected' : '' }}>Daughter</option>
                                    <option value="brother" {{ old('profile_for', $profile->profile_for ?? '') === 'brother' ? 'selected' : '' }}>Brother</option>
                                    <option value="sister" {{ old('profile_for', $profile->profile_for ?? '') === 'sister' ? 'selected' : '' }}>Sister</option>
                                    <option value="friend" {{ old('profile_for', $profile->profile_for ?? '') === 'friend' ? 'selected' : '' }}>Friend</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Profile Picture</label>
                                <input type="file" name="profile_picture" class="form-control" accept="image/*">
                            </div>
                        </div>

                        <!-- Physical Attributes -->
                        <h5 class="border-bottom pb-2 mb-3">Physical Attributes</h5>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Height (cm)</label>
                                <input type="number" name="height" class="form-control" value="{{ old('height', $profile->height ?? '') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Weight (kg)</label>
                                <input type="number" name="weight" class="form-control" value="{{ old('weight', $profile->weight ?? '') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Body Type</label>
                                <select name="body_type" class="form-select">
                                    <option value="">Select</option>
                                    <option value="slim">Slim</option>
                                    <option value="average">Average</option>
                                    <option value="athletic">Athletic</option>
                                    <option value="heavy">Heavy</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Complexion</label>
                                <select name="complexion" class="form-select">
                                    <option value="">Select</option>
                                    <option value="fair">Fair</option>
                                    <option value="wheatish">Wheatish</option>
                                    <option value="dark">Dark</option>
                                </select>
                            </div>
                        </div>

                        <!-- Marital Status -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Marital Status</label>
                                <select name="marital_status" class="form-select">
                                    <option value="never_married">Never Married</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="widowed">Widowed</option>
                                    <option value="awaiting_divorce">Awaiting Divorce</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Physical Status</label>
                                <input type="text" name="physical_status" class="form-control" value="{{ old('physical_status', $profile->physical_status ?? 'Normal') }}">
                            </div>
                        </div>

                        <!-- Religious Information -->
                        <h5 class="border-bottom pb-2 mb-3">Religious Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Religion</label>
                                <input type="text" name="religion" class="form-control" value="{{ old('religion', $profile->religion ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Caste</label>
                                <input type="text" name="caste" class="form-control" value="{{ old('caste', $profile->caste ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Mother Tongue</label>
                                <input type="text" name="mother_tongue" class="form-control" value="{{ old('mother_tongue', $profile->mother_tongue ?? '') }}">
                            </div>
                        </div>

                        <!-- Education & Career -->
                        <h5 class="border-bottom pb-2 mb-3">Education & Career</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Education</label>
                                <input type="text" name="education" class="form-control" value="{{ old('education', $profile->education ?? '') }}" placeholder="e.g., MBA, B.Tech">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Occupation</label>
                                <input type="text" name="occupation" class="form-control" value="{{ old('occupation', $profile->occupation ?? '') }}" placeholder="e.g., Software Engineer">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Annual Income</label>
                                <input type="text" name="annual_income" class="form-control" value="{{ old('annual_income', $profile->annual_income ?? '') }}" placeholder="e.g., 5-10 Lakhs">
                            </div>
                        </div>

                        <!-- Location -->
                        <h5 class="border-bottom pb-2 mb-3">Location</h5>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Country</label>
                                <input type="text" name="country" class="form-control" value="{{ old('country', $profile->country ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">State</label>
                                <input type="text" name="state" class="form-control" value="{{ old('state', $profile->state ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" value="{{ old('city', $profile->city ?? '') }}">
                            </div>
                        </div>

                        <!-- About -->
                        <h5 class="border-bottom pb-2 mb-3">About You</h5>
                        <div class="mb-3">
                            <label class="form-label">About Me</label>
                            <textarea name="about_me" class="form-control" rows="4" placeholder="Tell us about yourself...">{{ old('about_me', $profile->about_me ?? '') }}</textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-save"></i> Save Profile
                            </button>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary btn-lg px-5">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
