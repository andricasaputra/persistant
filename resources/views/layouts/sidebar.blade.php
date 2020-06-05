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
            @if(auth()->user()->setting()->first()->upload_setting == 'async')
                <li>
                    <a href="{{ route('failed') }}" class="waves-effect"><i class="fa fa-cloud-upload m-r-10" aria-hidden="true"></i>Data Gagal Upload</a>
                </li>
            @endif
            <li>
                <a href="{{ route('package.list') }}" class="waves-effect"><i class="fa fa-gift m-r-10" aria-hidden="true"></i>Order</a>
            </li>
            <li>
                <a href="{{ route('setting.index') }}" class="waves-effect">
                <i class="fa fa-gear m-r-10"></i> Setting</i></a>
            </li>
            <li>
                <a href="{{ route('info') }}" class="waves-effect">
                <i class="fa fa-info m-r-10"></i>General Info</i></a>
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