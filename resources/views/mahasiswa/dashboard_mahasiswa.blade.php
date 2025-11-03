@extends('layouts_mahasiswa.template')

@section('content')
<!-- Main Content -->
<div class="container-fluid">

    <!-- Selamat Datang -->
    <div class="bg-white p-4 rounded-lg shadow-sm mb-5">
        <h2 class="text-xl font-semibold text-gray-800">Selamat datang, {{ $mahasiswa->mahasiswa_nama ?? 'Mahasiswa' }}!</h2>
        <p class="text-sm text-gray-600 mt-1">Semoga harimu menyenangkan dan produktif.</p>
    </div>

    <!-- Shortcut Cards -->
    <div class="row mb-4">
        <!-- Card 1: Lengkapi Profil -->
        <div class="col-md-4">
            <div class="card shadow-sm text-white bg-primary">
                <div class="card-body text-center">
                    <h5 class="card-title">Lengkapi Profil</h5>
                    <p class="card-text">Lengkapi data diri dan dokumen anda</p>
                    <a href="{{ route('mahasiswa.profile.index') }}" class="btn btn-light btn-sm">Selengkapnya</a>
                </div>
            </div>
        </div>

        <!-- Card 2: Daftar TOEIC -->
        <div class="col-md-4">
            @php
                $mahasiswa = Auth::user()->load('mahasiswa.pendaftaran')->mahasiswa;
                $pendaftaran = null;
                if ($mahasiswa && $mahasiswa->pendaftaran) {
                    $pendaftaran = $mahasiswa->pendaftaran->whereIn('status_id', [1, 2])->first();
                }
            @endphp
            <div class="card shadow-sm text-white bg-success">
                <div class="card-body text-center">
                    <h5 class="card-title">Daftar TOEIC</h5>
                    <p class="card-text">Pertama kali mendaftar TOEIC?</p>
                    @if(!$pendaftaran)
                        <a href="{{ route('mahasiswa.pendaftaran.create_formulir') }}" class="btn btn-light btn-sm">Daftar</a>
                    @elseif($pendaftaran && in_array($pendaftaran->status_id, [1, 2]))
                        <a href="{{ route('mahasiswa.pendaftaran.read_formulir') }}" class="btn btn-light btn-sm">Lihat Pendaftaran</a>
                    @else
                        <a href="{{ route('mahasiswa.pendaftaran.edit_formulir') }}" class="btn btn-light btn-sm">Daftar</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Card 3: Info TOEIC -->
        <div class="col-md-4">
            <div class="card shadow-sm text-white bg-info">
                <div class="card-body text-center">
                    <h5 class="card-title">Info TOEIC</h5>
                    <p class="card-text">Sudah pernah mendaftar TOEIC?</p>
                    <a href="https://smartcart.id/sertifikat/english-certification" class="btn btn-light btn-sm" target="_blank">Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include CSS dan JS eksternal -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
@endsection