<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta property="og:locale" content="id_ID">
        <meta property="og:site_name" content="STAK Kupang">

        <title>{{ $title ?? 'App laravel' }}</title>

        {{-- ? Custom fonts for this template --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        {{-- ? Custom styles for this template --}}
        <link href="{{ asset('assets/css/sb-admin-2.css') }}" rel="stylesheet">

        {{ $hadeOptional ?? null }}
    </head>
    <body id="page-top">

        {{-- ? Page Wrapper  --}}
        <div id="wrapper">

            {{-- ? Sidebar  --}}
            <x-dashboard.sidebar />
            {{-- ? End of Sidebar  --}}

            {{-- ? Content Wrapper  --}}
            <div id="content-wrapper" class="d-flex flex-column">

                {{-- ? Main Content  --}}
                <div id="content">

                    {{-- ? Topbar  --}}
                    <x-dashboard.topbar />
                    {{-- ? End of Topbar --}}

                    {{-- ? Begin Page Content  --}}
                    <div class="container-fluid">

                        {{ $content }}

                    </div>
                    {{-- ? Begin Page Content  --}}

                </div>
                {{-- ? End of Main Content  --}}

                {{-- ? Footer  --}}
                <x-dashboard.footer />
                {{-- ? End of Footer  --}}

            </div>
            {{-- ? End of Content Wrapper --}}

        </div>
        {{-- ? End of Page Wrapper  --}}

        {{-- ? Scroll to Top Button --}}
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        {{-- ? Logout Modal --}}
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Apakah Anda Yakin Ingin Keluar dari Sini.</div>
                    <div class="modal-footer">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                            <button class="btn btn-danger" type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ? fontawesome js --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- ? Bootstrap core JavaScript --}}
        <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        {{-- ? Core plugin JavaScript --}}
        <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        {{-- ? Custom scripts for all pages --}}
        <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

        @include('sweetalert::alert')

        {{ $buttonOptional ?? null }}
    </body>
</html>
