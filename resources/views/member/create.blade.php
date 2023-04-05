<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Subject</title>
    <link rel="icon" href="asset/Chiang_Mai_University_Logo.png">
    <!-- CSS -->

    <link rel="stylesheet" href="{{ url('form.css') }}">

    <!-- Unicons icon -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

</head>

<body>

    <section class="container">
        @if (session('status'))
            <p>{{ session('status') }}</p>
        @endif
        <header>Activity Form</header>
        <a href="{{ url('/admin/home') }}">back</a>
        <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
  
            <div class="input-box">
                <label>user id</label>
                <input type="text" name="user_id" placeholder="Enter user id" required />
            </div>

            <div class="input-box">
                <label>subject id</label>
                <input type="text" name="subject_id" placeholder="Enter Subject ID" required />
            </div>

            <div class="column">
                <div class="input-box">
                    <label>Section</label>
                    <input type="number" name="section" placeholder="Enter " required />
                </div>
               
            </div>
            <button>Submit</button>
        </form>
    </section>



</body>

</html>
