@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <h3 class="text-center">Reset Password</h3>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf {{-- CSRF token for security --}}

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-custom w-100 py-2">Send Password Reset Link</button>

        <div class="text-center mt-3">
            <span>Remember your password?</span>
            <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Sign In</a>
        </div>
    </form>
@endsection
