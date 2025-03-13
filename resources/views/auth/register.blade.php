@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-lg">
                <div class="card-header text-center bg-primary">
                    <h4 class="text-white">{{ __('Create Account') }}</h4>
                    <p class=" text-white">{{ __('Please fill in the details to create your account.') }}</p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                            <button type="submit" class="btn btn-primary  btn-lg">
                                {{ __('Register') }}
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
        border-radius: 12px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        font-weight: 700;
        font-size: 1.8rem;
        color: #007bff;
    }

    .card-header p {
        font-size: 1rem;
        color: #666;
        margin-top: 5px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-weight: 600;
        border-radius: 8px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: translateY(-2px);
    }

    .form-label {
        font-weight: 500;
        color: #333;
        font-size: 1.1rem;
    }

    .form-control {
        border-radius: 8px;
        padding: 1rem;
        font-size: 1.1rem;
        border: 1px solid #ced4da;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .invalid-feedback {
        font-size: 0.875rem;
        color: red;
    }

    .d-flex {
        display: flex;
    }

    .justify-content-center {
        justify-content: center;
    }
</style>
@endpush
