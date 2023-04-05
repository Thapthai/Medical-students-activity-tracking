<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Medical students Activity Tracking</title>
    <link rel="icon" href="asset/Chiang_Mai_University_Logo.png">
    <!-- CSS -->

    <link rel="stylesheet" href="welcome.css" />

    <!-- Unicons icon -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

</head>

<body>

    <div class="center">
        <div class="container">
            <img src="asset/Chiang_Mai_University_Logo.png" alt="logo" .png class="logo" />
            <h3>Medical students Activity Tracking</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="data">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input id="email" placeholder="Your CMU Email @cmu.ac.th" type="email"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="data">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" placeholder='Your Password'
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <div class="signup-link">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif

                    @guest
                    
                        @if (Route::has('register'))
                            <br>
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            <br>
                        @endif
                    @else
                        {{ Auth::user()->name }}

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    @endguest
                </div>
                <button type="submit" class="btn-grad log-in">
                    {{ __('Login') }}
                </button>
            </form>

        </div>
    </div>
    <div class="footer">
        <p>Thapthai Rattananusarak Information Systems and Network Engineering (International)</p>
        
    </div>
</body>

</html>
