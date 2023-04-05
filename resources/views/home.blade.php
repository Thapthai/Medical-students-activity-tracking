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
    <link rel="stylesheet" href="{{ url('subject.css') }}">

    <!-- Unicons icon -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

</head>

<body>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
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
                    <span class="text">Dashboard </span>
                    <span class="text user">
                        {{ Auth::user()->name }}
                    </span>
                </div>
                <div class="boxes">

                    <button class="box box1 ">
                        @foreach ($newactivity as $item)
                            <a href="{{ url('activitydetail', $item->id) }}" class="subject-button">
                                <span class="text">New Activity :</span>
                                <p class="number">{{ $item->activity_name }}</p>
                                <p class="text">{{ $item->subject_name }}|{{ $item->subject_id }}
                                    section: {{ $item->section }}</p>
                                <p class="text">Due Date:{{ $item->duedate }}</p>
                            </a>
                        @endforeach

                    </button>

                    <div class="box box2 ">
                        <p class="number" style="color: red">NEWs</p>
                        @foreach ($newactivity as $item)
                            <a href="{{ url('activitydetail', $item->id) }}" class="subject-button">
                                {{ $item->subject_name }}|{{ $item->subject_id }}
                                section: {{ $item->section }} Due Date:{{ $item->duedate }}
                            </a>
                        @endforeach
                    </div>


                    <div class="box box3 ">
                        <p class="number">Submitted</p>
                        @foreach ($submitted as $item)
                            <a href="{{ url('activitydetail', $item->activity_name) }}"
                                class="subject-button">Activity: {{ $item->activity_name }} |
                                {{ $item->updated_at }} by {{ $item->task_owner }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">My classes</span>
                </div>
            </div>
            <div class="subject-boxes">
                @foreach ($subject as $item)
                    <button class="subject-box ">
                        <a href="{{ url('subjectdashboard', $item->id) }}" class="subject-button">
                            <span class="text">
                                <h3>{{ $item->subject_name }} </h3>
                            </span>
                            <span class="text">{{ $item->subject_id }} section {{ $item->section }}</span>
                            <span class="text">{{ $item->details }}</span>
                        </a>
                    </button>
                @endforeach
            </div>
            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Activity</span>
                </div>
                <div class="table">

                    <table id="example" class=" data" style="width:100%">
                        <thead>
                            <tr>
                                <th>Activity Name</th>
                                <th>Activity type</th>
                                <th>subject_number</th>
                                <th>Class Id</th>
                                <th>section</th>
                                <th>Teacher</th>
                                <th>Due Date</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activity as $item)
                            <tr>

                                <td>{{ $item->activity_name }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->subject_name }}</td>
                                <td>{{ $item->subject_id }}</td>
                                <td>{{ $item->section }}</td>
                                <td>{{ $item->owner }}</td>
                                <td>{{ $item->duedate }}</td>
                                <td><button style=" border: none; border-radius:10px;">
                                        <a href="{{ url('activitydetail', $item->id) }}" class="detail-button">
                                            Detail</a></button></td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>

            </div>

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

        /*=== datatable  ===*/
        $(document).ready(function() {
            $('#example').DataTable({
                order: [
                    [3, 'desc'],
                    [0, 'asc']
                ]
            });
        });
    </script>

    <!-- subject slider  -->
    <script>
        var container = document.getElementById('subject-container')
        var slider = document.getElementById('slider');
        var slides = document.getElementsByClassName('slide').length;
        var buttons = document.getElementsByClassName('btn');


        var currentPosition = 0;
        var currentMargin = 0;
        var slidesPerPage = 0;
        var slidesCount = slides - slidesPerPage;
        var containerWidth = container.offsetWidth;
        var prevKeyActive = false;
        var nextKeyActive = true;

        window.addEventListener("resize", checkWidth);

        function checkWidth() {
            containerWidth = container.offsetWidth;
            setParams(containerWidth);
        }

        function setParams(w) {
            if (w < 551) {
                slidesPerPage = 1;
            } else {
                if (w < 901) {
                    slidesPerPage = 2;
                } else {
                    if (w < 1101) {
                        slidesPerPage = 3;
                    } else {
                        slidesPerPage = 4;
                    }
                }
            }
            slidesCount = slides - slidesPerPage;
            if (currentPosition > slidesCount) {
                currentPosition -= slidesPerPage;
            };
            currentMargin = -currentPosition * (100 / slidesPerPage);
            slider.style.marginLeft = currentMargin + '%';
            if (currentPosition > 0) {
                buttons[0].classList.remove('inactive');
            }
            if (currentPosition < slidesCount) {
                buttons[1].classList.remove('inactive');
            }
            if (currentPosition >= slidesCount) {
                buttons[1].classList.add('inactive');
            }
        }

        setParams();

        function slideRight() {
            if (currentPosition != 0) {
                slider.style.marginLeft = currentMargin + (100 / slidesPerPage) + '%';
                currentMargin += (100 / slidesPerPage);
                currentPosition--;
            };
            if (currentPosition === 0) {
                buttons[0].classList.add('inactive');
            }
            if (currentPosition < slidesCount) {
                buttons[1].classList.remove('inactive');
            }
        };

        function slideLeft() {
            if (currentPosition != slidesCount) {
                slider.style.marginLeft = currentMargin - (100 / slidesPerPage) + '%';
                currentMargin -= (100 / slidesPerPage);
                currentPosition++;
            };
            if (currentPosition == slidesCount) {
                buttons[1].classList.add('inactive');
            }
            if (currentPosition > 0) {
                buttons[0].classList.remove('inactive');
            }
        };
    </script>

</body>

</html>
