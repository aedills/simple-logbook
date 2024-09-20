<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link " href="index.html">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-heading">Master Data</li>

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-person"></i><span>Data User</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="user-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="">
                    <i class="bi bi-circle"></i><span>Staf</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="bi bi-circle"></i><span>Magang</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="bi bi-circle"></i><span>PKL/SMK</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#aktifitas-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Aktifitas</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="aktifitas-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="forms-elements.html">
                    <i class="bi bi-circle"></i><span>Pending Aktifitas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.aktifitas.index')}}">
                    <i class="bi bi-circle"></i><span>Aktifitas</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-heading">Data</li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
            <i class="bi bi-person"></i>
            <span>Profile</span>
        </a>
    </li>

</ul>