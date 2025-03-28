@extends('layouts.mainLayout')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Your Profile</h2>

    @if(session('success'))
        <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-4 text-center">
            <!-- Profile Image -->
            <img
                src="{{ $user->profile_image ? asset('storage/profile_images/' . $user->profile_image) : 'https://via.placeholder.com/150' }}"
                class="img-fluid rounded-circle mb-3"
                alt="Profile Image"
                style="max-width: 150px; border: 2px solid #ddd; box-shadow: 0 4px 6px rgba(0,0,0,0.1);"
            >
        </div>

        <div class="col-md-6">
            <!-- Profile Info -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">{{ $user->name }}</h3>
                    <p class="card-text text-muted">{{ $user->email }}</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-block">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
