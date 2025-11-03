<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">TOEIC</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Profil -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.profile.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profil</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne">
            <i class="fas fa-fw fa-book"></i>
            <span>Data Utama</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.prodi.index') }}">Program Studi</a>
                <a class="collapse-item" href="{{ route('admin.jurusan.index') }}">Jurusan</a>
                <a class="collapse-item" href="{{ route('admin.kampus.index') }}">Kampus</a>
                <a class="collapse-item" href="{{ route('admin.mahasiswa.index') }}">Mahasiswa</a>
            </div>
        </div>
    </li>

    {{-- <!-- Nav Item - Data Mahasiswa -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.mahasiswa.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Mahasiswa</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Data Kampus -->
    <li class="nav-item">
        <a class="nav-link {{ request()->is('kampus*') ? 'active' : '' }}" href="{{ route('admin.kampus.index') }}">
            <i class="fas fa-fw fa-university"></i>
            <span>Data Kampus</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/jurusan*') ? 'active' : '' }}" href="{{ route('jurusan.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Data Jurusan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/prodi*') ? 'active' : '' }}" href="{{ route('prodi.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Data Prodi</span>
        </a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder-plus"></i>
            <span>Data Pendaftaran</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.pendaftaran.index') }}">Validasi Pendaftaran</a>
                <a class="collapse-item" href="{{ route('admin.jadwal.index') }}">Jadwal & Kuota</a>
            </div>
        </div>
    </li>

    {{-- <!-- Nav Item - Data Pendaftaran -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.pendaftaran.index') }}">
            <i class="fas fa-fw fa-folder-plus"></i>
            <span>Data Pendaftaran</span></a>
    </li>

    <!-- Nav Item - Jadwal & Kuota -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.jadwal.index') }}">
            <i class="fas fa-fw fa-calendar-check"></i>
            <span>Jadwal & Kuota</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Bantuan -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.help') }}">
            <i class="fas fa-fw fa-question-circle"></i>
            <span>Bantuan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Logout with Confirmation Modal -->
    <li class="nav-item">
        <a class="nav-link" href="#" onclick="showLogoutConfirmation(event)">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<!-- Add this script to your layout file or existing JS file -->
<script>
    function showLogoutConfirmation(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan keluar dari sistem!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout!',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn btn-confirm',
                cancelButton: 'btn btn-cancel'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>

<!-- Optional: Add this CSS for button styling -->
<style>
    .btn-confirm {
        background-color: #2449AD;
        color: white;
        padding: 8px 20px;
        border-radius: 4px;
        border: none;
        margin-right: 10px;
    }

    .btn-cancel {
        background-color: #d33;
        color: white;
        padding: 8px 20px;
        border-radius: 4px;
        border: none;
    }
</style>
