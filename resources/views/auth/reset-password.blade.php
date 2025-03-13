<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="text-center mb-6">
            <h4 class="text-primary font-semibold text-2xl">{{ __('Reset Your Password') }}</h4>
            <p class="text-sm text-gray-600 mt-2">
                {{ __('Please choose a new password for your account. Make sure it’s at least 8 characters long.') }}
            </p>
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-6">
                <x-label for="email" value="{{ __('Email Address') }}" />
                <x-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>

            <div class="mb-6">
                <x-label for="password" value="{{ __('New Password') }}" />
                <x-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mb-6">
                <x-label for="password_confirmation" value="{{ __('Confirm New Password') }}" />
                <x-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="btn-primary">
                    {{ __('Reset Password') }}
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
        max-width: 400px;
        margin: 50px auto;
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
        text-transform: uppercase;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.8rem;
        box-shadow: none;
        border: 1px solid #ddd;
        width: 100%;
        margin-top: 0.5rem;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .text-sm {
        font-size: 0.875rem;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        color: red;
    }

    .text-center {
        text-align: center;
    }

    .mb-6 {
        margin-bottom: 1.5rem;
    }

    .mt-4 {
        margin-top: 1rem;
    }
</style>
@endpush
