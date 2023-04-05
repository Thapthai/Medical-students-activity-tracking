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
            <div class='back-pass'>
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif
                @else
                    {{ Auth::user()->name }}

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                @endguest
            </div>
            <img src="asset/Chiang_Mai_University_Logo.png" alt="logo" .png class="logo" />
            <h3>Medical students Activity Tracking</h3>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="data">
                    <label for="name">{{ __('Name') }}</label>

                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="data">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="data">
                    <label for="user_id">{{ __('user_id') }}</label>

                    <input id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror"
                        name="user_id" value="{{ old('user_id') }}" required autocomplete="user_id" autofocus>

                    @error('user_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="data">
                    <label for="email">{{ __('Status') }}</label>

                    <select id="is_admin" class="selection-form @error('email') is-invalid @enderror" name="is_admin"
                        value="{{ old('is_admin') }}" required autocomplete="is_admin">
                        <option value="0">Student</option>
                        <option value="1">Teacher</option>
                    </select>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                </div>
                <div class="data">
                    <label for="password">{{ __('Password') }}</label>


                    <input id="password" type="password" class=" @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="data">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>


                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password">

                </div>

                <div class="row mb-0">

                    <button type="submit" class="btn-grad log-in">
                        {{ __('Register') }}
                    </button>

                </div>
            </form>
        </div>
    </div>
    <div class="footer">
        <p>Thapthai Rattananusarak Information Systems and Network Engineering (International)</p>
        <br>
    </div>
</body>
