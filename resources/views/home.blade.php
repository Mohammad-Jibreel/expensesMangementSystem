@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm rounded-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h5>{{ __('Dashboard') }}</h5>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="text-center mt-4">
                        <h4 class="text-secondary">{{ __('You are logged in!') }}</h4>
                        <p class="mt-3 text-muted">{{ __('Welcome back! You can now manage your account.') }}</p>
                    </div>


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
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #007bff;
        border-radius: 15px 15px 0 0;
    }

    .alert {
        margin-top: 1rem;
        font-size: 1rem;
        border-radius: 0.375rem;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
    }

    .btn-close {
        background-color: transparent;
        border: none;
        font-size: 1.2rem;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 1rem 2rem;
        font-size: 1.2rem;
        border-radius: 10px;
        text-transform: uppercase;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .mt-4 {
        margin-top: 2rem;
    }

    .mt-5 {
        margin-top: 3rem;
    }
</style>
@endpush
