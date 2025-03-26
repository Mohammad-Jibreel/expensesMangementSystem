@extends('layouts.app')

@section('content')
<div class="d-lg-flex half" style="background: linear-gradient(to right, #ff6600, #ff9933); height: 100vh; justify-content: center; align-items: center;">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-7 form-container bg-white p-5 rounded shadow">
                <h3 class="text-center text-primary">{{ __('Forgot Your Password?') }}</h3>
                <p class="mb-4 text-center text-gray-600">
                    {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </p>
                @if (session('status'))
                    <div class="alert alert-success text-center">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input type="email" placeholder="your-email@gmail.com" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-custom w-100">{{ __('Email Password Reset Link') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
