<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link  {{ request()->routeIs('user.dashboarduser') ? '' : 'collapsed' }}" href="{{route('user.dashboarduser')}}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-heading">Aktifitas</li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.aktifitasuser.upload.*') ? '' : 'collapsed' }}" href="{{route('user.aktifitasuser.upload.index')}}">
            <i class="bi bi-upload"></i>
            <span>Upload Aktifitas</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.aktifitasuser.pending') ? '' : 'collapsed' }}" href="{{route('user.aktifitasuser.pending')}}">
            <i class="bi bi-clock"></i>
            <span>Pending Aktifitas</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.aktifitasuser.history') ? '' : 'collapsed' }}" href="{{route('user.aktifitasuser.history')}}">
            <i class="bi bi-calendar-week"></i>
            <span>History Aktifitas</span>
        </a>
    </li>

    <li class="nav-heading">Data</li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.profile') ? '' : 'collapsed' }}" href="{{ route('user.profile') }}">
            <i class="bi bi-person"></i>
            <span>Profile</span>
        </a>
    </li>

</ul>