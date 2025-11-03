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
        <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Profil -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('mahasiswa.profile.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profil</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Pendaftaran -->
    {{-- <li class="nav-item">
        @php
            $mahasiswa = Auth::user()->mahasiswa ?? null;
            $pendaftaran = $mahasiswa->pendaftaran->last() ?? null;
        @endphp

        @if (!$pendaftaran)
            <!-- Jika belum pernah mendaftar -->
            <a class="nav-link" href="{{ route('mahasiswa.pendaftaran.create_formulir') }}">
                <i class="fas fa-fw fa-folder-plus"></i>
                <span>Pendaftaran</span>
            </a>
        @elseif(in_array($pendaftaran->status_id, [1, 2]))
            <!-- Jika sudah mendaftar dengan status Diproses (1) atau Diterima (2) -->
            <a class="nav-link" href="{{ route('mahasiswa.pendaftaran.read_formulir') }}">
                <i class="fas fa-fw fa-folder-plus"></i>
                <span>Pendaftaran</span>
            </a>
        @elseif($pendaftaran->status_id == 3)
            <!-- Untuk status ditolak -->
            <a class="nav-link" href="{{ route('mahasiswa.pendaftaran.edit_formulir') . $pendaftaran->id }}">
                <i class="fas fa-fw fa-folder-plus"></i>
                <span>Pendaftaran</span>
            </a>
        @endif
    </li> --}}
    <li class="nav-item">
        {{-- @php
            $mahasiswa = Auth::user()->mahasiswa ?? null;
            $pendaftaran = $mahasiswa->pendaftaran->last() ?? null;
        @endphp --}}

        @php
            $mahasiswa = Auth::user()->mahasiswa ?? null;
            $pendaftaran = $mahasiswa?->pendaftaran?->last() ?? null;
        @endphp
        
        @if (!$pendaftaran)
            <!-- Jika belum pernah mendaftar -->
            <a class="nav-link" href="{{ route('mahasiswa.pendaftaran.create_formulir') }}">
                <i class="fas fa-fw fa-folder-plus"></i>
                <span>Pendaftaran</span>
            </a>
        @elseif(in_array($pendaftaran->status_id, [1, 2]))
            <!-- Jika sudah mendaftar dengan status Diproses (1) atau Diterima (2) -->
            <a class="nav-link" href="{{ route('mahasiswa.pendaftaran.read_formulir') }}">
                <i class="fas fa-fw fa-folder-open"></i>
                <span>Pendaftaran</span>
            </a>
        @elseif($pendaftaran->status_id == 3)
            <!-- Untuk status ditolak -->
            <a class="nav-link" href="{{ route('mahasiswa.pendaftaran.edit_formulir', $pendaftaran->id) }}">
                <i class="fas fa-fw fa-edit"></i>
                <span>Pendaftaran</span>
            </a>
        @endif
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Bantuan -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('mahasiswa.help') }}">
            <i class="fas fa-fw fa-question-circle"></i>
            <span>Bantuan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Logout with Confirmation Modal -->
    <li class="nav-item">
        <a class="nav-link" href="#" id="logout-link">
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

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('logout-link').addEventListener('click', function(e) {
            e.preventDefault();

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
                    confirmButton: 'btn-confirm',
                    cancelButton: 'btn-cancel'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    });
</script>

<style>
    .btn-confirm {
        background-color: #2449AD !important;
        color: white !important;
        padding: 8px 20px !important;
        border-radius: 4px !important;
        border: none !important;
        margin-right: 10px !important;
    }

    .btn-cancel {
        background-color: #d33 !important;
        color: white !important;
        padding: 8px 20px !important;
        border-radius: 4px !important;
        border: none !important;
    }
</style>
