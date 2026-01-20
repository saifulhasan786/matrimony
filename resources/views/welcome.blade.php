@extends('layouts.app')

@section('title', 'Welcome to Matrimony Site')

@section('content')
<!-- Hero Section -->
<div class="bg-primary text-white py-5" style="background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold mb-4">Find Your Perfect Life Partner</h1>
                <p class="lead mb-4">Trusted by thousands of people to find their soulmate. Join us today and start your journey to a happy married life.</p>
                <a href="{{ route('user.register') }}" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-user-plus"></i> Register Free
                </a>
                <a href="{{ route('user.login') }}" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </div>
            <div class="col-md-6 text-center">
                <i class="fas fa-heart fa-10x"></i>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold">Why Choose Us?</h2>
        <p class="lead text-muted">We provide the best platform to find your perfect match</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 text-center border-0 shadow">
                <div class="card-body p-4">
                    <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                    <h4>100% Verified Profiles</h4>
                    <p class="text-muted">All profiles are manually verified by our team to ensure authenticity and safety.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 text-center border-0 shadow">
                <div class="card-body p-4">
                    <i class="fas fa-user-lock fa-3x text-success mb-3"></i>
                    <h4>Privacy Protected</h4>
                    <p class="text-muted">Your privacy is our priority. Control who can see your profile and contact you.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 text-center border-0 shadow">
                <div class="card-body p-4">
                    <i class="fas fa-search fa-3x text-info mb-3"></i>
                    <h4>Advanced Search</h4>
                    <p class="text-muted">Find your perfect match with our advanced search filters and preferences.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 text-center border-0 shadow">
                <div class="card-body p-4">
                    <i class="fas fa-mobile-alt fa-3x text-warning mb-3"></i>
                    <h4>Mobile Friendly</h4>
                    <p class="text-muted">Access your account anytime, anywhere with our mobile-responsive design.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 text-center border-0 shadow">
                <div class="card-body p-4">
                    <i class="fas fa-comments fa-3x text-danger mb-3"></i>
                    <h4>Instant Messaging</h4>
                    <p class="text-muted">Connect with your matches instantly through our built-in messaging system.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 text-center border-0 shadow">
                <div class="card-body p-4">
                    <i class="fas fa-headset fa-3x text-secondary mb-3"></i>
                    <h4>24/7 Support</h4>
                    <p class="text-muted">Our dedicated support team is always here to help you with any questions.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Section -->
<div class="bg-light py-5 my-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3">
                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                <h2 class="fw-bold">10,000+</h2>
                <p class="text-muted">Active Members</p>
            </div>
            <div class="col-md-3">
                <i class="fas fa-heart fa-3x text-danger mb-3"></i>
                <h2 class="fw-bold">5,000+</h2>
                <p class="text-muted">Success Stories</p>
            </div>
            <div class="col-md-3">
                <i class="fas fa-globe fa-3x text-success mb-3"></i>
                <h2 class="fw-bold">50+</h2>
                <p class="text-muted">Countries</p>
            </div>
            <div class="col-md-3">
                <i class="fas fa-star fa-3x text-warning mb-3"></i>
                <h2 class="fw-bold">4.8/5</h2>
                <p class="text-muted">User Rating</p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="container my-5 text-center">
    <div class="card bg-primary text-white border-0 shadow-lg">
        <div class="card-body p-5">
            <h2 class="display-5 fw-bold mb-4">Ready to Find Your Soulmate?</h2>
            <p class="lead mb-4">Join thousands of happy couples who found their perfect match through our platform.</p>
            <a href="{{ route('user.register') }}" class="btn btn-light btn-lg">
                <i class="fas fa-rocket"></i> Get Started Now
            </a>
        </div>
    </div>
</div>
@endsection
