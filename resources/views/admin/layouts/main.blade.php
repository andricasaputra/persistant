<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.header')
</head>

<body class="fix-header fix-sidebar card-no-border">

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
        </svg>
    </div>

    <div id="main-wrapper">

        <header class="topbar">

            @include('admin.layouts.navbar')

        </header>

        <aside class="left-sidebar">

            @include('admin.layouts.sidebar')

        </aside>

        <div class="page-wrapper">

            <div class="row">
                <div class="col-md-4 offset-md-4">
                    @include('layouts.message')
                </div>   
            </div>
            
            @yield('content')

            <footer class="footer text-center">
                © 2019 | Dric
            </footer>

        </div>
    </div>

    @include('layouts.script')

    @yield('extra_script')

</body>

</html>
