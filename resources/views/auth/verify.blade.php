@extends('layouts.mainLayout')

@section('content')
<div class="d-lg-flex" style="height: 92vh; justify-content: center; align-items: center;">
    <div class="col-md-7 form-container bg-white p-5 rounded shadow-lg">
        <h3 class="text-center text-primary mb-4">{{ __('Verify Your Email Address') }}</h3>

        {{-- Display success message --}}
        @if (session('resent'))
            <div class="alert alert-success text-center mb-4" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        {{-- Instructional text --}}
        <p class="text-center mb-4 text-gray-600">
            {{ __('Before proceeding, please check your email for a verification link.') }}
            <br>
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-primary">{{ __('click here to request another') }}</button>.
            </form>
        </p>

        {{-- Optional Back to Login link --}}
        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="btn btn-primary w-100">{{ __('Back to Login') }}</a>
        </div>
    </div>
</div>
@endsection
