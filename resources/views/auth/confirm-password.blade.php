@extends('layouts.app')

@section('content')
<div class="d-lg-flex half" style="background: linear-gradient(to right, #ff6600, #ff9933); height: 100vh; justify-content: center; align-items: center;">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-7 form-container bg-white p-5 rounded shadow">
                <h3 class="text-center text-primary">{{ __('Confirm Your Password') }}</h3>
                <p class="mb-4 text-center text-gray-600">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>
                <x-validation-errors class="mb-4" />
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input type="password" placeholder="Your Password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-custom w-100">{{ __('Confirm') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
