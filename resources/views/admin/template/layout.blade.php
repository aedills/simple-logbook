<!DOCTYPE html>
<html lang="en">

<head>
    @include('../../admin/template/components/header')
</head>

<body>

    <!-- Top Bar -->
    @include('../../admin/template/components/topbar')

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar">
        @include('../../admin/template/components/sidebar')
    </aside>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    @include('../../admin/template/components/footer')

</body>

</html>