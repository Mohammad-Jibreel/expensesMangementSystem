@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-lg p-4">
                <div class="card-header text-center text-primary">
                    <h4>{{ __('Confirm Password') }}</h4>
                </div>

                <div class="card-body">
                    <p class="text-center mb-4 text-sm text-gray-600">
                        {{ __('Please confirm your password before continuing.') }}
                    </p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                {{ __('Confirm Password') }}
                            </button>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="mt-4 text-center">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        @endif
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
