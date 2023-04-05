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
    <link rel="stylesheet" href="{{ url('teacher.css') }}">
    <link rel="stylesheet" href="{{ url('student.css') }}">
    <link rel="stylesheet" href="{{ url('subject-slider.css') }}">
    <link rel="stylesheet" href="{{ url('test.css') }}">

    <!-- Unicons icon -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

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
                    <th>activity_name</th>
                    <th>subject_number</th>
                    <th>section</th>
                    <th>owner</th>
                    <th>type</th>
                    <th>point</th>
                    <th>detail</th>
                    <th>duedate</th>
                  
                </tr>
                @foreach ($activity as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->activity_name}}</td>
                            <td>{{$row->subject_id}}</td>
                            <td>{{$row->section}}</td>
                            <td>{{$row->owner}}</td>
                            <td>{{$row->type}}</td>
                            <td>{{$row->point}}</td>
                            <td>{{$row->detail}}</td>
                            <td>{{$row->duedate}}</td>
                    
                        </tr>
                @endforeach

            </table>

        </div>
    </section>

    <script>
        const body = document.querySelector("body"),
            modeToggle = body.querySelector(".mode-toggle");
        sidebar = body.querySelector("nav");
        sidebarToggle = body.querySelector(".sidebar-toggle");

        let getMode = localStorage.getItem("mode");
        if (getMode && getMode === "dark") {
            body.classList.toggle("dark");
        }

        let getStatus = localStorage.getItem("status");
        if (getStatus && getStatus === "close") {
            sidebar.classList.toggle("close");
        }

        modeToggle.addEventListener("click", () => {
            body.classList.toggle("dark");
            if (body.classList.contains("dark")) {
                localStorage.setItem("mode", "dark");
            } else {
                localStorage.setItem("mode", "light");
            }
        });

        sidebarToggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
            if (sidebar.classList.contains("close")) {
                localStorage.setItem("status", "close");
            } else {
                localStorage.setItem("status", "open");
            }
        })
    </script>


</body>

</html>
