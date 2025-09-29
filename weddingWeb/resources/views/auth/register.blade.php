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
                <!-- Register Form -->
                <div class="col-lg-6">
                    <div class="form-card">
                        <h2 class="form-title">{{ __('Register') }}</h2>
                        <form method="POST" action="">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <button type="submit" class="btn btn-submit">{{ __('Register') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
