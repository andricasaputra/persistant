<!-- Sidebar scroll-->
<div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
        <ul id="sidebarnav">
            <li>
                <a href="{{ route('admin.home') }}" class="waves-effect"><i class="fa fa-clock-o m-r-10" aria-hidden="true"></i>Dashboard</a>
            </li>
            <li>
                <a href="{{ route('users.index') }}" class="waves-effect"><i class="fa fa-user-o m-r-10" aria-hidden="true"></i>Users</a>
            </li>
            <li>
                <a href="{{ route('roles.index') }}" class="waves-effect"><i class="fa fa-gear m-r-10" aria-hidden="true"></i>Roles</a>
            </li>
            <li>
                <a href="{{ route('permissions.index') }}" class="waves-effect"><i class="fa fa-check-square m-r-10" aria-hidden="true"></i>Permissions</a>
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