@extends('layouts.app')

@section('title', 'Spendiary Login')

@section('content')
    <h3 class="text-center">Spendiary Login</h3>



    <form action="{{ route('login') }}" method="POST">
        @csrf {{-- CSRF token for security --}}

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember me</label>
            <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot Password?</a>

        </div>

        <button type="submit" class="btn btn-custom w-100">Sign In</button>

        <div class="text-center mt-3">
            <span>Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Create Account</a>
        </div>

    </form>
@endsection
