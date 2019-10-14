<nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
    <!-- ============================================================== -->
    <!-- Logo -->
    <!-- ============================================================== -->
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('home') }}">
            <!-- Logo icon -->
            <b>
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                {{-- <img src="{{ asset("images/logo-icon.png") }}" class="dark-logo" /> --}}
                <i class="wi wi-sunset"></i>
            </b>
            <!--End Logo icon -->
            <!-- Logo text -->
            <span>
                <!-- dark Logo text -->
                {{-- <img src="{{ asset("images/logo-text.png") }}" class="dark-logo" /> --}}
            </span>
        </a>
    </div>
    <!-- ============================================================== -->
    <!-- End Logo -->
    <!-- ============================================================== -->
    <div class="navbar-collapse">
        <!-- ============================================================== -->
        <!-- toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav mr-auto mt-md-0 ">
            <!-- This is  -->
            <li class="nav-item dropdown" style="margin: auto;">
              <a href="#" id="btnNotifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="badge-container">
                  <span class="badge badge-pill badge-danger dropdown-count"></span>
                </div>
                <div  class="bell-icon-container" style="color: #fff">
                  <i class="fa fa-bell"></i>
                </div>
              </a>
              <div class="dropdown-menu notifications-menu">
                <ul id="main_notifications" class="dropdown-item" role="menu" aria-hidden="true" style="list-style: none; background-color: #fff;"></ul>
                <ul id="on-mobile">
                   <li>
                     <a href="#">Lihat semua pemberitahuan</a>
                   </li>
                </ul>
              </div>
            </li>
        </ul>
        <!-- ============================================================== -->
        <!-- User profile and search -->
        <!-- ============================================================== -->
        <ul class="navbar-nav my-lg-0">
            <li class="nav-item dropdown">
                <a id="profileNav" class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" data-src="0" aria-haspopup="true" aria-expanded="false" >{{ 'Administrator' }}</a>
            </li>

        </ul>
    </div>
</nav>
