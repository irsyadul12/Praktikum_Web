<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Manajemen Sekolah</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    @if (Auth::user()->isAdmin() || Auth::user()->isGuru())
    <!-- Student Management -->
    <li class="nav-item {{ request()->is('students*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('students.index') }}">
            <i class="fas fa-user-graduate fa-fw"></i>
            <span>Manajemen Siswa</span>
        </a>
    </li>
    @endif

    @if (Auth::user()->isAdmin())
    <!-- Teacher Management -->
    <li class="nav-item {{ request()->is('gurus*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('gurus.index') }}">
            <i class="fas fa-user-tie fa-fw"></i>
            <span>Manajemen Guru</span>
        </a>
    </li>
    @endif

    @if (Auth::user()->isAdmin() || Auth::user()->isGuru())
    <li class="nav-item {{ request()->is('kelas*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kelas.index') }}">
            <i class="fas fa-chalkboard-teacher fa-fw"></i>
            <span>Pengelolaan Kelas</span>
        </a>
    </li>
    @endif

    @if (Auth::user()->isAdmin())
    <li class="nav-item {{ request()->is('jadwal*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('jadwal.index') }}">
            <i class="fas fa-calendar-alt fa-fw"></i>
            <span>Jadwal Pelajaran</span>
        </a>
    </li>
    @endif

    @if (Auth::user()->isAdmin() || Auth::user()->isGuru())
    <li class="nav-item {{ request()->is('absensi*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('absensi.index') }}">
            <i class="fas fa-clipboard-list fa-fw"></i>
            <span>Absensi Siswa</span>
        </a>
    </li>
    @endif

    @if (Auth::user()->isAdmin())
    <li class="nav-item {{ request()->is('mata-pelajaran*') || request()->is('jam-pelajaran*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMapel"
            aria-expanded="true" aria-controls="collapseMapel">
            <i class="fas fa-book fa-fw"></i>
            <span>Manajemen Mapel</span>
        </a>
        <div id="collapseMapel"
            class="collapse {{ request()->is('mata-pelajaran*') || request()->is('jam-pelajaran*') ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('mata-pelajaran*') ? 'active' : '' }}"
                    href="{{ route('mata-pelajaran.index') }}">Daftar Mapel</a>
                <a class="collapse-item {{ request()->is('jam-pelajaran*') ? 'active' : '' }}"
                    href="{{ route('jam-pelajaran.index') }}">Pengaturan Jam</a>
            </div>
        </div>
    </li>
    @endif

    @if (Auth::user()->isAdmin() || Auth::user()->isGuru())
    <li class="nav-item {{ request()->is('pelanggarans*') || request()->is('prestasi*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporanPP"
            aria-expanded="true" aria-controls="collapseLaporanPP">
            <i class="fas fa-chart-bar fa-fw"></i>
            <span>Pelanggaran & Prestasi</span>
        </a>
        <div id="collapseLaporanPP"
            class="collapse {{ request()->is('pelanggarans*') || request()->is('prestasi*') ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('pelanggarans*') ? 'active' : '' }}"
                    href="{{ route('pelanggarans.index') }}">Pelanggaran Siswa</a>
                <a class="collapse-item {{ request()->is('prestasi*') ? 'active' : '' }}"
                    href="{{ route('prestasi.index') }}">Prestasi Siswa</a>
            </div>
        </div>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>

    @if (Auth::user()->isAdmin() || Auth::user()->isGuru())
    <li class="nav-item {{ request()->is('laporan*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
            aria-expanded="true" aria-controls="collapseLaporan">
            <i class="fas fa-file-alt fa-fw"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseLaporan"
            class="collapse {{ request()->is('laporan*') ? 'show' : '' }}"
            aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Jenis Laporan:</h6>
                <a class="collapse-item {{ request()->is('laporan/siswa*') ? 'active' : '' }}"
                    href="{{ route('laporan.siswa') }}">Laporan Siswa</a>
                @if (Auth::user()->isAdmin())
                <a class="collapse-item {{ request()->is('laporan/guru*') ? 'active' : '' }}"
                    href="{{ route('laporan.guru') }}">Laporan Guru</a>
                @endif
                <a class="collapse-item {{ request()->is('laporan/kelas*') ? 'active' : '' }}"
                    href="{{ route('laporan.kelas') }}">Laporan Kelas</a>
                <a class="collapse-item {{ request()->is('laporan/absensi*') ? 'active' : '' }}"
                    href="{{ route('laporan.absensi') }}">Laporan Absensi</a>
                <a class="collapse-item {{ request()->is('laporan/pelanggaran*') ? 'active' : '' }}"
                    href="{{ route('laporan.pelanggaran') }}">Laporan Pelanggaran</a>
                <a class="collapse-item {{ request()->is('laporan/prestasi*') ? 'active' : '' }}"
                    href="{{ route('laporan.prestasi') }}">Laporan Prestasi</a>
                @if (Auth::user()->isAdmin())
                <a class="collapse-item {{ request()->is('laporan/mata-pelajaran*') ? 'active' : '' }}"
                    href="{{ route('laporan.mata-pelajaran') }}">Laporan Mata Pelajaran</a>
                @endif
            </div>
        </div>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User & System
    </div>

    @if (Auth::user()->isAdmin() || Auth::user()->isGuru())
    <!-- Nav Item - Profile -->
    <li class="nav-item {{ request()->is('profile*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('profile.show') }}">
            <i class="fas fa-user fa-fw"></i>
            <span>Profile</span>
        </a>
    </li>

    <!-- Nav Item - Settings -->
    <li class="nav-item {{ request()->is('settings*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('settings.index') }}">
            <i class="fas fa-cogs fa-fw"></i>
            <span>Settings</span>
        </a>
    </li>

    <!-- Nav Item - Activity Log -->
    <li class="nav-item {{ request()->is('activity-log*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('activity_log.index') }}">
            <i class="fas fa-list fa-fw"></i>
            <span>Activity Log</span>
        </a>
    </li>
    @endif

    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>