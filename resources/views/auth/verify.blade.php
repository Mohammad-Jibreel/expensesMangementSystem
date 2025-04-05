<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login & Register')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-lg-flex" style="height: 92vh; justify-content: center; align-items: center;">
    <div class="">
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




    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
