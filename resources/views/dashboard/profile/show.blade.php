@extends('layouts.mainLayout')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Your Profile</h2>

    @if(session('success'))
        <div class="alert alert-success text-center mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow rounded-4 border-0 p-4 text-center">
                <!-- Profile Image (centered) -->
                <div class="d-flex justify-content-center mb-4">
                    <img
                        src="{{ $user->profile_image ? asset('storage/profile_images/' . $user->profile_image) : 'https://via.placeholder.com/150' }}"
                        class="rounded-circle shadow"
                        alt="Profile Image"
                        style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #007bff;"
                    >
                </div>

                <!-- Name -->
                <h4 class="fw-bold mb-2">{{ $user->name }}</h4>

                <!-- Email -->
                <p class="text-muted mb-3">
                    <i class="bi bi-envelope-fill me-2 text-primary"></i>
                    {{ $user->email }}
                </p>

                <hr class="my-4">

                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary w-100">
                    <i class="bi bi-pencil-square me-1"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
