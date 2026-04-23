@extends('layouts.app')

@section('title', 'Vulnerable Login')

@section('content')
<div class="row justify-content-center pt-5">
    <div class="col-md-5">
        <div class="alert alert-danger d-flex align-items-center mb-4 fw-bold" role="alert">
            <i class="fas fa-exclamation-triangle fs-4 me-3"></i>
            <div>
                VULNERABLE LOGIN DEMO
            </div>
        </div>

        <div class="card shadow-sm border-danger">
            <div class="card-body p-4">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success mb-4" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('vulnerable.login.store') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input id="email" class="form-control border-danger focus-ring focus-ring-danger @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input id="password" class="form-control border-danger focus-ring focus-ring-danger @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-4 form-check">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label text-muted">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <a class="text-decoration-none small text-muted text-hover-dark" href="{{ route('vulnerable.register') }}">
                            {{ __('Need an account?') }}
                        </a>

                        <button type="submit" class="btn btn-danger fw-bold px-4">
                            {{ __('Log in (Vulnerable)') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
