<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? '' : 'collapsed' }}" href="{{route('admin.dashboard')}}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-heading">Master Data</li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.datauser.*') ? '' : 'collapsed' }}" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-person"></i><span>Data User</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="user-nav" class="nav-content collapse {{ request()->routeIs('admin.datauser.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{route('admin.datauser.staf.index')}}" class="{{ request()->routeIs('admin.datauser.staf.*') ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>Staf</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.datauser.magang.index')}}" class="{{ request()->routeIs('admin.datauser.magang.*') ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>Magang</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.datauser.pkl.index')}}" class="{{ request()->routeIs('admin.datauser.pkl.*') ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>PKL/SMK</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.aktifitas.*') ? '' : 'collapsed' }}" data-bs-target="#aktifitas-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Aktifitas</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="aktifitas-nav" class="nav-content collapse {{ request()->routeIs('admin.aktifitas.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('admin.aktifitas.pending')}}" class="{{ request()->routeIs('admin.aktifitas.pending') ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>Pending Aktifitas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.aktifitas.index')}}" class="{{ request()->routeIs('admin.aktifitas.index') || request()->routeIs('admin.aktifitas.filter') ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>Aktifitas</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-heading">Data</li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.profile') ? '' : 'collapsed' }}" href="{{route('admin.profile')}}">
            <i class="bi bi-person"></i>
            <span>Profile</span>
        </a>
    </li>

</ul>