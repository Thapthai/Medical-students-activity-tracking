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
        <header>Task Form</header>

        <a href="{{ url('/') }}">back</a>

        <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            <input type="text" label="owner" hidden name="task_owner" value="{{ Auth::user()->name }}" autoFocus />

            <div class="input-box">
                <label>activity_id</label>
                <input type="text" name="activity_id" placeholder="Enter Activity Name" required />
            </div>

            <div class="input-box">
                <label>Subject</label>
                <input type="text" name="file_path" placeholder="Enter Subject" required />
            </div>

            <div class="column">
                <div class="input-box">
                    <label>Section</label>
                    <input type="number" name="point" placeholder="Enter " required />
                </div>
            </div>

            <div class="input-box address">
                <label>Detail</label>
                <input type="text" name="decision" placeholder="Enter Detail" required />
            </div>

            <button>Submit</button>
        </form>
    </section>

</body>

</html>
