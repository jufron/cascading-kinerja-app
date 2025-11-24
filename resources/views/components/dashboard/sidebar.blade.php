{{-- ? Sidebar  --}}
<ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

    {{-- ? Sidebar - Brand  --}}
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">App</div>
    </a>

    {{-- ? Divider  --}}
    <hr class="sidebar-divider my-0">

    {{-- ? Nav Item - Dashboard  --}}
    <li class="nav-item @if (request()->routeIs('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-chart-line"></i>
            <span>Dashboard</span>
        </a>
    </li>

    {{-- ? Divider  --}}
    <hr class="sidebar-divider">

    @role('admin')
    <li class="nav-item @if (request()->routeIs('daftar-admin.*')) active @endif">
        <a class="nav-link" href="{{ route('daftar-admin.index') }}">
            <i class="fas fa-chart-line"></i>
            <span>Daftar Admin</span>
        </a>
    </li>

    <li class="nav-item @if (request()->routeIs('pejabat-atasan.*')) active @endif">
        <a class="nav-link" href="{{ route('pejabat-atasan.index') }}">
            <i class="fas fa-chart-line"></i>
            <span>Daftar Pejabat Atasan</span>
        </a>
    </li>

    <li class="nav-item @if (request()->routeIs('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-chart-line"></i>
            <span>Daftar Kinerja</span>
        </a>
    </li>

    <li class="nav-item @if (request()->routeIs('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-chart-line"></i>
            <span>Catatan</span>
        </a>
    </li>

    <li class="nav-item @if (request()->routeIs('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-chart-line"></i>
            <span>Laporan</span>
        </a>
    </li>
    @endrole

    @role('pimpinan')
    <li class="nav-item @if (request()->routeIs('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-chart-line"></i>
            <span>Daftar Kinerja</span>
        </a>
    </li>
    <li class="nav-item @if (request()->routeIs('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-chart-line"></i>
            <span>Laporan</span>
        </a>
    </li>
    <li class="nav-item @if (request()->routeIs('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-chart-line"></i>
            <span>Catatan</span>
        </a>
    </li>
    @endrole

    @role('pegawai')
    <li class="nav-item @if (request()->routeIs('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-chart-line"></i>
            <span>Daftar Kinerja</span>
        </a>
    </li>

    <li class="nav-item @if (request()->routeIs('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-chart-line"></i>
            <span>Catatan</span>
        </a>
    </li>
    @endrole



    {{-- ? pengumuman --}}
    {{-- <li class="nav-item {{ request()->routeIs('dashboard.pengumuman*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.pengumuman.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Pengumuman</span></a>
    </li> --}}


    {{-- ? Divider  --}}
    <hr class="sidebar-divider">

    {{-- ? Sidebar Toggler (Sidebar)  --}}
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
{{-- ? End of Sidebar  --}}
