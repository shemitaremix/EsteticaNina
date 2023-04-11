@extends('layouts.app')

@section('css')
    <style type="text/css">
        :root {
            --pure-material-primary-rgb: 255, 191, 0;
            --pure-material-onsurface-rgb: 0, 0, 0;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: url("https://res.cloudinary.com/finnhvman/image/upload/v1541930411/pattern.png");
        }

        .registration {
            position: relative;
            border-radius: 8px;
            padding: 16px 48px;
            box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
            overflow: hidden;
            background-color: white;
        }

        h1 {
            margin: 32px 0;
            font-family: "Roboto", "Segoe UI", BlinkMacSystemFont, system-ui, -apple-system;
            font-weight: normal;
            text-align: center;
        }

        .registration>label {
            display: block;
            margin: 24px 0;
            width: 320px;
        }

        a {
            color: rgb(var(--pure-material-primary-rgb));
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        button {
            display: block !important;
            margin: 32px auto;
        }

        .done,
        .progress {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: white;
            visibility: hidden;
        }

        .done {
            transition: visibility 0s 1s;
        }

        .signed>.done {
            visibility: visible;
        }

        .done>a {
            display: inline-block;
            text-decoration: none;
        }

        .progress {
            opacity: 0;
        }

        .signed>.progress {
            animation: loading 4s;
        }

        @keyframes loading {
            0% {
                visibility: visible;
            }

            12.5% {
                opacity: 0;
            }

            25% {
                opacity: 1;
            }

            87.5% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        .left-footer,
        .right-footer {
            position: fixed;
            padding: 14px;
            bottom: 14px;
            color: #555;
            background-color: #eee;
            font-family: "Roboto", "Segoe UI", BlinkMacSystemFont, system-ui, -apple-system;
            font-size: 14px;
            line-height: 1.5;
            box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        }

        .left-footer {
            left: 0;
            border-radius: 0 4px 4px 0;
            text-align: left;
        }

        .right-footer {
            right: 0;
            border-radius: 4px 0 0 4px;
            text-align: right;
        }

        .left-footer>a,
        .right-footer>a {
            color: black;
        }

        .left-footer>a:hover,
        .right-footer>a:hover {
            text-decoration: underline;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" class="registration" action="{{ route('login') }}">
                            @csrf


                            <label for="email" class="pure-material-textfield-outlined">{{ __('Email Address') }}</label>
                            <label>
                                <input id="email" type="email"
                                    class="pure-material-textfield-outlined @error('email') is-invalid @enderror"
                                    name="email" placeholder="Email" value="{{ old('email') }}" required
                                    autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label for="password" class="pure-material-textfield-outlined">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var form = document.querySelector('form');
        form.onsubmit = function(event) {
            event.preventDefault();
            form.classList.add('signed');
        };
    </script>
@endsection
