@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-lg">
                <div class="card-header bg-primary text-center text-white">
                    <h4>{{ __('Reset Password') }}</h4>
                </div>

                <div class="card-body">
                    <p class="text-center mb-4 text-sm text-gray-600">
                        {{ __('Please enter your email address and new password to reset your password.') }}
                    </p>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-4">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-primary px-4 ">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        font-weight: 600;
        font-size: 1.5rem;
        color: #007bff;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.8rem 1.5rem;
        font-size: 1rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .form-label {
        font-weight: 500;
        color: #333;
    }

    .form-control {
        border-radius: 8px;
        padding: 0.8rem;
        font-size: 1rem;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        color: red;
    }

    .text-center {
        text-align: center;
    }

    .text-sm {
        font-size: 0.875rem;
    }
</style>
@endpush
