<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ url('user') }}" class="logo d-flex align-items-center">
            <img src="{{ url('/assets/favicon.png') }}" alt="">
            <span class="d-none d-lg-block">LogBook</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">


            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ url('assets/profiles/').'/'.session('foto') }}" alt="{{ session('username') }}" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ session('nama') }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ session('nama') }}</h6>
                        <span>{{ session('username') }} | {{ ucfirst(session('role')) }}</span>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('user.profile') }}">
                            <i class="bi bi-person"></i>
                            <span>Profile</span>
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('auth.userLogout') }}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header>