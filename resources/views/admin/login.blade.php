<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="shortcut icon" href="{{ url('/assets/favicon.png') }}" type="image/x-icon">

    <title>{{$title}}</title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ url('/assets/favicon.png') }}" rel="icon">
    <link href="{{ url('res/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <title>{{$title}}</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- TypedJS CDN -->
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
</head>

<body class="bg-[url('/assets/22.jpg')] bg-cover">
    <div class="min-h-screen flex items-center justify-center gap-10">
        <div class="md:bg-slate-100 p-8 rounded-lg sm:shadow-2xl w-full max-w-md">
            <h2 class="text-2xl font-bold text-center text-white md:text-black">Login as Admin</h2>
            <p class="text-center text-white md:text-gray-600 mb-6">Masukkan username dan password untuk login.</p>

            <form action="{{route('auth.doLogin')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="username" class="block text-sm font-medium text-white md:text-gray-700">Username</label>
                        <input type="text" id="username" name="username" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-white md:text-gray-700">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500">
                            <button type="button" id="showPassword" class="absolute top-0 right-3 bottom-0">
                                <i class="fa-regular fa-eye" id="passwordIcon"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Log in
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="hidden lg:block w-1/4">
            <span class="text-white font-bold text-2xl" id="element"></span>
            <h1 class="text-4xl lg:text-6xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 via-blue-700 to-cyan-900">
                LOGBOOK
            </h1>
            <p class="text-white mt-5 text-3xl font-bold">
                Pantau dan awasi aktifitas peserta magang & PKL!
            </p>
        </div>
    </div>

    <!-- TypedJS CDN -->
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

    <script>
        var typed = new Typed('#element', {
            strings: ['<i>Service</i>', '<i>Catat</i>', '<i>Periksa</i>', '<i>Verifikasi</i>'],
            typeSpeed: 25,
            backSpeed: 35,
            loop: true
        });

        const passwordInput = document.getElementById('password');
        const showPasswordButton = document.getElementById('showPassword');
        const passwordIcon = document.getElementById('passwordIcon');

        showPasswordButton.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        });
    </script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session()->has('success'))
    <script>
        Swal.fire({
            toast: true,
            position: "top-end",
            icon: "success",
            title: "{{ session()->get('success') }}",
            showConfirmButton: false,
            timer: 2500
        })
    </script>
    @endif

    @if (session()->has('error'))
    <script>
        Swal.fire({
            toast: true,
            position: "top-end",
            icon: "error",
            title: "{{ session()->get('error') }}",
            showConfirmButton: false,
            timer: 2500
        })
    </script>
    @endif

</body>

</html>