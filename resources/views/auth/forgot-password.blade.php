<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="text-center mb-4">
            <h4 class="text-primary">{{ __('Forgot Your Password?') }}</h4>
            <p class="text-sm text-gray-600">
                {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>
        </div>

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="btn-primary">
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

@push('styles')
<style>
    .card {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 2rem;
    }

    .text-primary {
        color: #007bff;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 0.8rem;
        font-weight: 600;
        border-radius: 10px;
        width: 100%;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.8rem;
        box-shadow: none;
    }

    .text-sm {
        font-size: 0.875rem;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        color: red;
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        border-radius: 15px 15px 0 0;
        padding: 1rem;
        text-align: center;
    }

    .text-gray-600 {
        color: #4b5563;
    }
</style>
@endpush
