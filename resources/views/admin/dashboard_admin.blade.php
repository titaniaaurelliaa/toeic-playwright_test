@extends('layouts_admin.template')

@section('content')
<!-- Main Content -->
<div class="container-fluid">
    <!-- Selamat Datang -->
    <div class="bg-white p-4 rounded-lg shadow-sm mb-5">
        <h2 class="text-xl font-semibold text-gray-800">Selamat datang, {{ $admin->admin_nama ?? 'Admin' }}!</h2>
        <p class="text-sm text-gray-600 mt-1">Semoga harimu menyenangkan dan produktif.</p>
    </div>

    <!-- Kartu Statistik -->
    <div class="row mb-4">
        {{-- total data --}}
        <div class="col-md-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <h5>Total Pendaftaran</h5>
                    <h3>{{ $totalPendaftaran }}</h3>
                </div>
            </div>
        </div>

        {{-- data diproses --}}
        <div class="col-md-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <h5>Diproses</h5>
                    <h3>{{ $totalDiproses }}</h3>
                </div>
            </div>
        </div>

        {{-- data diterima --}}
        <div class="col-md-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <h5>Diterima</h5>
                    <h3>{{ $totalDiterima }}</h3>
                </div>
            </div>
        </div>

        {{-- data ditolak --}}
        <div class="col-md-3">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <h5>Ditolak</h5>
                    <h3>{{ $totalDitolak }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa dalam Proses</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="pendaftaran-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jadwal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftaranDiproses as $key => $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->mahasiswa->mahasiswa_nama ?? 'N/A' }}</td>
                            <td>{{ $data->mahasiswa->email ?? 'N/A' }}</td>
                            <td>{{ $data->jadwal->tanggal ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    {{ $data->status->status_nama ?? 'Diproses' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk Grafik dan Tabel -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#pendaftaran-table').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Indonesian.json"
        }
    });
});
</script>   
@endsection