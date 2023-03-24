<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dating Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/images/favicon.png') }}">
    <link href="{{ asset('/vendor/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/chartist/css/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.css">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{ url('/') }}/home" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('/images/logo.png') }}" alt="">
                <img class="logo-compact" src="{{ asset('/images/logo-text.png') }}" alt="">
                <img class="brand-title" src="{{ asset('/images/logo-text.png') }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span
                        class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search"
                                            aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong>
                                                        Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="danger"><i class="ti-bookmark"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as
                                                        unsolved.
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-heart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-image"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong> James.</strong> has added a<strong>customer</strong>
                                                        Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="./app-profile.html" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="./email-inbox.html" class="dropdown-item">
                                        <i class="icon-envelope-open"></i>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <a  class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2"   onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">Logout </span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>


        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">

                    <li>
                        <a href="{{ url('/') }}/home" aria-expanded="false">
                            <i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                    </li>

                    <li>
                        <a href="{{ url('/') }}/live-user" aria-expanded="false">
                            <i class="icon icon-single-04"></i><span class="nav-text">Live User</span></a>
                    </li>

                    <li>
                        <a href="{{ url('/') }}/user" aria-expanded="false">
                            <i class="icon icon-single-04"></i><span class="nav-text">User</span></a>
                    </li>

                    <li>
                        <a href="{{ url('/') }}/country" aria-expanded="false">
                            <i class="icon icon-single-04"></i><span class="nav-text">Country</span></a>
                    </li>


                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-app-store"></i><span class="nav-text">Gift</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('/') }}/category">Category</a></li>
                            <li><a href="{{ url('/') }}/gift">Gift</a></li>
                        </ul>
                    </li>

                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-chart-bar-33"></i><span class="nav-text">Effects</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('/') }}/emoji">Emoji</a></li>
                            <li><a href="{{ url('/') }}/sticker">Sticker</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ url('/') }}/point-management" aria-expanded="false">
                            <i class="icon icon-single-04"></i><span class="nav-text">Point management</span></a>
                    </li>


                    <li>
                        <a href="{{ url('/') }}/point-information" aria-expanded="false">
                            <i class="icon icon-single-04"></i><span class="nav-text">Point Information</span></a>
                    </li>

                    <li>
                        <a href="{{ url('/') }}/payment-redeem-request" aria-expanded="false">
                            <i class="icon icon-single-04"></i><span class="nav-text">Payment(redeem) request
                            </span></a>
                    </li>

                    <li>
                        <a href="{{ url('/') }}/advertisment" aria-expanded="false">
                            <i class="icon icon-single-04"></i><span class="nav-text">Advertisment</span></a>
                    </li>

                    <li>
                        <a href="{{ url('/') }}/settings" aria-expanded="false">
                            <i class="icon icon-single-04"></i><span class="nav-text">Settings</span></a>
                    </li>

                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-chart-bar-33"></i><span class="nav-text">Profile</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('/') }}/all-users">All Users</a></li>
                            <li><a href="{{ url('/') }}/add-users">Add User</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        @yield('content')

        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->

        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer>
    </script>
    <script src="{{ asset('/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('/js/custom.min.js') }}"></script>

    <script src="{{ asset('/vendor/chartist/js/chartist.min.js') }}"></script>

    <script src="{{ asset('/vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/vendor/pg-calendar/js/pignose.calendar.min.js') }}"></script>


    <script src="{{ asset('/js/dashboard/dashboard-2.js') }}"></script>
    <!-- Circle progress -->

</body>

</html>
