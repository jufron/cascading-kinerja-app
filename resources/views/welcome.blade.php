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

<body class="min-h-screen flex flex-col">
    <!-- NAVBAR -->
    <nav class="w-full bg-white/70 backdrop-blur-md border-b border-white/40 shadow-sm fixed top-0 left-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                <span class="text-lg font-semibold text-gray-800">Cascading Kinerja</span>
            </div>

            <!-- Menu kanan -->
            <div class="flex gap-4 text-sm font-medium">
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-gray-700 hover:text-indigo-600 transition">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">Register</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="w-full bg-gray-50 py-40">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-center px-6">
            <!-- Text Left -->
            <div class="space-y-5">
                <h1 class="text-4xl md:text-5xl font-bold leading-tight text-gray-900">
                    Selamat Datang di Cascading Kinerja Online
                </h1>
                <p class="text-gray-600 text-lg">
                    Platform Cascading Kinerja membantu Anda menyusun target, memantau progres, dan mengevaluasi hasil dengan alur kerja yang sederhana, cepat, dan akurat.
                </p>
                <div class="pt-5">
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">Login</a>
                </div>
            </div>

            <!-- Image Right -->
            <div class="flex justify-center">
                <img src="{{ asset('img/gambar pariwisata.png') }}" alt="Hero Image"
                    class="rounded-xl shadow-lg w-full h-auto object-cover">
            </div>
        </div>
    </section>

</body>

</html>
