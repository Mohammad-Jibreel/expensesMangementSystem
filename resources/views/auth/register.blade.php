@extends('layouts.app')

@section('title', 'Register')



@section('content')
    <h3 class="text-center">Register</h3>
    <form>
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" placeholder="Enter your full name">
        </div>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" placeholder="Enter your username">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="Enter your email">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" placeholder="Enter your password">
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" class="form-control" placeholder="Confirm your password">
        </div>
        <button type="submit" class="btn btn-custom w-100">Register</button>
    </form>
@endsection
