<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Background blur */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: url('{{ asset('img/gambar pariwisata.png') }}') center/cover no-repeat;
            /* background: url('gambar pariwisata.PNG') center/cover no-repeat; */
            filter: blur(6px);
            z-index: -1;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen px-4">

    <div class="max-w-sm w-full bg-white/60 backdrop-blur-lg rounded-2xl shadow-xl p-8 text-center border border-white/30">

        <h1 class="text-2xl font-semibold text-gray-800 mb-2">
            Selamat Datang di <span class="text-indigo-600">Cascading Kinerja</span>
        </h1>

        <p class="text-gray-600 mb-6">
            Silakan login untuk melanjutkan
        </p>

        <a href="login.php"
            class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-lg shadow-md transition-all duration-300 text-sm font-medium">
            Login
        </a>
    </div>

</body>
</html>
