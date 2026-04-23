@extends('layouts.app')

@section('title', 'Vulnerable Register')

@section('content')
<div class="row justify-content-center pt-5">
    <div class="col-md-5">
        <div class="alert alert-danger d-flex align-items-center mb-4 fw-bold" role="alert">
            <i class="fas fa-exclamation-triangle fs-4 me-3"></i>
            <div>
                VULNERABLE REGISTER DEMO
            </div>
        </div>

        <div class="card shadow-sm border-danger">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('vulnerable.register.store') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Name</label>
                        <input id="name" class="form-control border-danger focus-ring focus-ring-danger @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input id="email" class="form-control border-danger focus-ring focus-ring-danger @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input id="password" class="form-control border-danger focus-ring focus-ring-danger @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password">
                        <div class="form-text text-danger small mt-1">Vulnerable: No complexity requirement. Even "123" works.</div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                        <input id="password_confirmation" class="form-control border-danger focus-ring focus-ring-danger @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" required autocomplete="new-password">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-4">
                        <a class="text-decoration-none small text-muted text-hover-dark" href="{{ route('vulnerable.login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <button type="submit" class="btn btn-danger fw-bold px-4">
                            {{ __('Register (Vulnerable)') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
