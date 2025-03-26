@extends('layouts.app')

@section('title', 'Spendiary Login')

@section('content')
    <h3 class="text-center">Spendiary        Login</h3>
    <form>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="Enter your email">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" placeholder="Enter your password">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember me</label>
        </div>
        <button type="submit" class="btn btn-custom w-100">Sign In</button>
    </form>
@endsection

