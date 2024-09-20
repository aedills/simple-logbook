<!DOCTYPE html>
<html lang="en">

<head>
    @include('../../user/template/components/header')
</head>

<body>

    <!-- Top Bar -->
    @include('../../user/template/components/topbar')

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar">
        @include('../../user/template/components/sidebar')
    </aside>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    @include('../../user/template/components/footer')

</body>

</html>