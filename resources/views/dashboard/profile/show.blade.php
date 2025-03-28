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
            <img src="{{ $user->profile_image ? url('storage/public/profile_images/' . $user->profile_image) : 'https://via.placeholder.com/150' }}" class="img-fluid rounded-circle" alt="Profile Image">


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
