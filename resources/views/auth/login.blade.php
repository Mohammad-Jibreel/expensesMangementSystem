@extends('layouts.app')

@section('content')
<div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{ asset('loginpage/images/bg_1.jpg') }}');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <h3>{{ __('Login') }} to <strong>Spendiary</strong></h3>
            <p class="mb-4">Welcome to <strong>Spendiary</strong>, your personal finance management tool. Log in to track your expenses, set budgets, and achieve your financial goals. Take control of your spending and make smarter financial decisions. Start managing your finances today!</p>



                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group first">
                            <label for="username" >{{ __('Email Address') }}</label>
                            <input  type="email" placeholder="your-email@gmail.com" id="username" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group last mb-3">
                            <label for="password">{{ __('Password') }}</label>
                            <input  type="password" placeholder="Your Password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex mb-5 align-items-center">
                            <label class="control control--checkbox mb-0"><span class="caption">

                            </span>
                                <input class="checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <div class="control__indicator"></div>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <a class="text-decoration-none" href="{{ route('password.request') }}">

                                </a>
                            @endif

                            <span class="ml-auto"><a href="#" class="forgot-pass">   {{ __('Forgot Your Password?') }}</a></span>

                        </div>

                            <input type="submit" value="{{ __('Login') }}" class="btn btn-block btn-primary col-md-6">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

