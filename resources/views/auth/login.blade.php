@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 77vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg rounded-lg border-0">
                <div class="card-header text-center bg-primary text-white rounded-top">
                    <h4>{{ __('Login') }}</h4>

                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <a class="text-decoration-none" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
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
        background: #ffffff;
        border-radius: 15px;
    }

    .card-header {
        background-color: #007bff;
        border-radius: 15px 15px 0 0;
        padding: 1.5rem;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 0.8rem;
        font-weight: 600;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .form-control {
        border-radius: 10px;
        box-shadow: none;
    }

    .form-check-label {
        font-size: 0.9rem;
    }

    .invalid-feedback {
        font-size: 0.875rem;
    }
</style>
@endpush
