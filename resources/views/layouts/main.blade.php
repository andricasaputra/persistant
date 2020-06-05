<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.header')
    @yield('styles')
</head>

<body class="fix-header fix-sidebar card-no-border">

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
        </svg>
    </div>

    <div id="main-wrapper">

        <header class="topbar">

            @include('layouts.navbar')

        </header>

        <aside class="left-sidebar">

            @include('layouts.sidebar')

        </aside>

        <div class="page-wrapper">

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    @include('layouts.message')
                </div>   
            </div>

            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                @yield('breadcrumb')
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>

            <footer class="footer text-center">
                © 2019 | Dric
            </footer>

        </div>
    </div>

    @include('layouts.script')

    @yield('extra_script')

</body>

</html>
