@extends('web.layouts.master')

@push('web-styles')
    <style>
        .login-section {
            padding: 100px 0;
        }
        .form-card {
            background: #fff;
            border: 1px solid var(--gray-border);
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* max-width: 400px; */
            /* width: 100%; */
            margin: 0 1rem;
        }
        .form-title {
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 600;
            color: var(--brand);
        }
        .btn-submit {
            background: var(--gray-btn);
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 0.75rem;
            width: 100%;
            font-weight: 500;
        }
        .btn-submit:hover {
            background: #5a6268;
            color: #fff;
        }
        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
        @media (max-width: 768px) {
            .form-card {
                max-width: 100%;
            }
        }
    </style>
@endpush

@section('web-content')
    <section class="login-section">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Login Form -->
                <div class="col-lg-6">
                    <div class="form-card">
                        <h2 class="form-title">{{ __('Login') }}</h2>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="login-email" class="form-label">{{ __('Email Address') }}</label>
                                <input 
                                    type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    id="login-email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    autocomplete="email" 
                                    autofocus
                                >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="login-password" class="form-label">{{ __('Password') }}</label>
                                <input 
                                    type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    id="login-password" 
                                    name="password" 
                                    required 
                                    autocomplete="current-password"
                                >
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input 
                                    type="checkbox" 
                                    class="form-check-input" 
                                    id="remember" 
                                    name="remember" 
                                    {{ old('remember') ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                            </div>

                            <button type="submit" class="btn btn-submit">{{ __('Login') }}</button>

                            {{-- register --}}
                            <p class="mt-3 fw-light">Belum daftar? <a href="{{route('register')}}">Klik disini</a> </p>
                            {{-- @if (Route::has('password.request'))
                                <div class="mt-3">
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            @endif --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection