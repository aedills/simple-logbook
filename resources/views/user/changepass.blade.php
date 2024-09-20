<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[url('/assets/changepass_bg.jpg')] bg-cover">
    <div class="min-h-screen flex justify-center relative">
        <div class="md:bg-slate-100 p-8 rounded-lg sm:shadow-2xl w-full max-w-md top-28 absolute">
            <h2 class="text-2xl font-bold text-center text-white md:text-black">Tunggu!</h2>
            <p class="text-center text-white md:text-gray-600 mb-6">Ganti password dulu yuk!</p>

            <form action="/" method="POST">
                <div class="space-y-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-white md:text-gray-700">Password
                            baru</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400
                                      focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500">
                            <button type="button" id="showPassword" class="absolute top-0 right-3 bottom-0">
                                <i class="fa-regular fa-eye" id="passwordIcon"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Ganti Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const showPasswordButton = document.getElementById('showPassword');
        const passwordIcon = document.getElementById('passwordIcon');

        showPasswordButton.addEventListener('click', function() {
            // Toggle password
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
</body>

</html>