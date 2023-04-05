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
        <form action="{{ route('activity.store') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            <input type="text" label="owner" hidden name="owner" value="{{ Auth::user()->name }}" autoFocus />

            <div class="input-box">
                <label>Activity Name</label>
                <input type="text" name="activity_name" placeholder="Enter Activity Name" required />
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
                <div class="input-box">
                    <label>Due Date</label>
                    <input type="date" name="duedate" placeholder="Enter birth date" required />
                </div>
            </div>
            <div class="gender-box">
                <h3>Type of Activity</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="check-male" name="type" value="Compulsory" checked />
                        <label>Compulsory</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-female" name="type" value="Freedom" />
                        <label>Freedom</label>
                    </div>
                </div>
            </div>
            <div class="input-box address">
                <label>Detail</label>
                <input type="text" name="detail" placeholder="Enter Detail" required />
            </div>
            <div class="input-box address">
                <label>Point</label>
                <input type="text" name="point" placeholder="Enter Detail" required />
            </div>
            <button>Submit</button>
        </form>
    </section>



</body>

</html>
