<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li><a href="{{ route('result.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Home</span></a></li>
    <li class="treeview">
        <a href="#">
        <i class="fa fa-users text-white"></i>
        <span>Data Peserta</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('result.baru') }}"><i class="fa fa-users text-white"></i> <span>Baru</span></a></li>
            <li><a href="{{ route('result.interview') }}"><i class="fa fa-users text-white"></i> <span>Interview</span></a></li>
            <li><a href="{{ route('result.tolak') }}"><i class="fa fa-users text-white"></i> <span>Ditolak</span></a></li>
            <li><a href="{{ route('result.users') }}"><i class="fa fa-users text-white"></i> <span>Semua</span></a></li>
        </ul>
    </li>

    <?php /*<li><a href=""><i class="fa fa-laptop text-muted"></i> <span>Setting</span></a></li>*/ ?>


</ul>
