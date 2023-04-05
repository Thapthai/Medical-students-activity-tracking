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
    <link rel="stylesheet" href="{{ url('student.css') }}">

    <!-- Unicons icon -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">


</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="{{ url('asset/Chiang_Mai_University_Logo.png') }}" alt="logo"
                    style="width:40px;height: 40px; margin: 14px;" />
            </div>

            <span class="logo_name">Medical students</span>
            <span class="logo_name">Activity Tracking</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li>
                    <a href="{{ route('admin.home') }}">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dahsboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('subject') }}">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Course</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('activity.create') }}">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Activity</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('activity') }}">
                        <i class="uil uil-file-check-alt"></i>
                        <span class="link-name">Checknig Activity</span>
                    </a>
                </li>

            </ul>

            <ul class="logout-mode">
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        <a onclick="this.parentNode.submit();">
                            <i class="uil uil-signout"></i>
                            <span class="link-name">Logout</span>
                        </a>
                    </form>
                </li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>

                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Student Dashboard</span>
                    <span class="text user">{{ Auth::user()->name }}</span>
                </div>
                <h3>Subject</h3>
            </div>
            @if ($message = Session::get('success'))
                <p>{{ $message }}</p>
            @endif

            <table class="data-table">
                <tr>
                    <th>ID</th>
                    <th>subject_number</th>
                    <th>subject_name</th>
                    <th>section</th>
                    <th>details</th>
                    <th>owner</th>
                    <th>number</th>

                </tr>
                @foreach ($subject as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->subject_id }}</td>
                        <td>{{ $row->subject_name }}</td>
                        <td>{{ $row->section }}</td>
                        <td>{{ $row->details }}</td>
                        <td>{{ $row->owner }}</td>
                        <td>{{ $row->user_id }}</td>

                    </tr>
                @endforeach

            </table>

        </div>



    </section>

    <script>
       
    </script>



</body>

</html>
