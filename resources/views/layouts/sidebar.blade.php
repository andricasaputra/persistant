<!-- Sidebar scroll-->
<div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
        <ul id="sidebarnav">
            <li>
                <a href="{{ route('home') }}" class="waves-effect"><i class="fa fa-desktop m-r-10" aria-hidden="true"></i>Dashboard</a>
            </li>
            <li>
                <a href="{{ route('profile') }}" class="waves-effect"><i class="fa fa-user m-r-10" aria-hidden="true"></i>Profile</a>
            </li>
            <li>
                <a href="{{ route('log') }}" class="waves-effect"><i class="fa fa-table m-r-10" aria-hidden="true"></i>Log Aktivitas</a>
            </li>
            <li>
                <a href="{{ route('upload') }}" class="waves-effect"><i class="fa fa-cloud-upload m-r-10" aria-hidden="true"></i>Upload Aktivitas</a>
            </li>
            <li>
                <a href="{{ route('package.list') }}" class="waves-effect"><i class="fa fa-gift m-r-10" aria-hidden="true"></i>Paket</a>
            </li>
            <li>
                <a href="{{ route('logout') }}" class="waves-effect" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off m-r-10"></i> Logout</i></a>
            </li>
        </ul>
    </nav>
    <!-- End Sidebar navigation -->

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
</div>
<!-- End Sidebar scroll-->