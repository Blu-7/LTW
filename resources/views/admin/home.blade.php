<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('admin.template.head')
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">

    <!-- Site wrapper -->
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Right navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <!-- <span class="badge badge-warning navbar-badge">15</span> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
                        </a>
                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                        </a>
                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                        </a>
                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item border-md-right"></li>
                <li class="nav-item dropdown">
                    <a data-toggle="dropdown" class="nav-link" href="#">
                        <div class="user-panel pb-2">
                            <div class="image">
                                {{--                            @if(Auth::user()->image)--}}
                                {{--                                <img src="{{Auth::user()->image}}" class="img-circle admin-picture" alt="User Image">--}}
                                {{--                            @else--}}
                                {{--                                <img src="/template/admin/dist/img/avatar6.png" class="img-circle admin-picture" alt="User Image">--}}
                                {{--                            @endif--}}
                            </div>
                            <span class="ml-2 d-none d-lg-inline small admin-name">{{Auth::user()->name}}</span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg">
                        <a href="/admin/user-profile" class="dropdown-item">
                            <i class="fas fa-suitcase mr-2"></i> Thông tin tài khoản
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-cog mr-2"></i> Cài đặt
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/admin/logout" class="dropdown-item">
                            <i class="fas fa-power-off mr-2"></i> Đăng xuất
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.template.sidebar')

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @include('admin.template.alert')
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->
    @include('admin.template.footer')
    </body>

    </html>
