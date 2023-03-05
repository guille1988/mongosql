<!DOCTYPE html>
    <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="csrf-token" content="{{ csrf_token() }}" />

            <title>Repository pattern Laravel</title>

        @stack('css')

        </head>

        <body id="page-top">

            <!-- Page Wrapper -->
            <div id="wrapper">

                <!-- Sidebar -->
                <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Tables
                    </div>

                    <!-- Nav Item - Posts -->
                    <li class="nav-item {{ request()->is('posts*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('posts.index')}}">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Posts</span></a>
                    </li>

                    <!-- Nav Item - Tasks -->
                    <li class="nav-item {{ request()->is('tasks*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('tasks.index')}}">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Tasks</span></a>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">

                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>

                </ul>
                <!-- End of Sidebar -->

                 @yield('content')

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="">
                <i class="fas fa-angle-up"></i>
            </a>

            @stack('scripts')

        </body>

    </html>
