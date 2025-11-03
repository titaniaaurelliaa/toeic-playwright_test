@extends('layouts_mahasiswa.template')

@section('content')
    <div class="container-fluid">
        @php
            $mahasiswa = Auth::user()->load([
                'mahasiswa.pendaftaran' => function ($query) {
                    $query->latest()->first(); // Get the most recent pendaftaran
                },
            ])->mahasiswa;
            $pendaftaran = $mahasiswa->pendaftaran->first() ?? null;
        @endphp

        @if (!$mahasiswa)
            <div class="alert alert-danger">
                Data mahasiswa tidak ditemukan!
            </div>
        @elseif (!$pendaftaran)
            <div class="alert alert-danger">
                Data pendaftaran tidak ditemukan!
            </div>
        @else
            <div class="card shadow mb-4">
                {{-- <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: #fff2a6">
                    <h6 class="m-0 font-weight-bold text-primary text-dark">Edit Formulir Pendaftaran TOEIC</h6>
                </div> --}}
                <div class="alert alert-warning">
                    Perbarui Formulir Pendaftaran TOEIC Anda
                </div>
                <div class="card-body">
                    <form id="formEditPendaftaran"
                        action="{{ route('mahasiswa.pendaftaran.edit_formulir_proses', $pendaftaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Kolom Kiri: Data Mahasiswa -->
                            <div class="col-md-6">
                                <div class="card border-left-primary mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="card-title mb-0 text-primary">
                                            <i class="fas fa-user-graduate"></i> Data Mahasiswa
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="nim"
                                                class="col-md-4 col-form-label font-weight-bold">NIM</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="nim"
                                                    value="{{ $mahasiswa->mahasiswa_nim }}" disabled>
                                                @if (!$mahasiswa->mahasiswa_nim)
                                                    <small class="text-danger">NIM kosong! Mohon perbarui pada menu
                                                        profile!</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nik"
                                                class="col-md-4 col-form-label font-weight-bold">NIK</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="nik"
                                                    value="{{ $mahasiswa->nik }}" disabled>
                                                @if (!$mahasiswa->nik)
                                                    <small class="text-danger">NIK kosong! Mohon perbarui pada menu
                                                        profile!</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama" class="col-md-4 col-form-label font-weight-bold">Nama
                                                Lengkap</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="nama"
                                                    value="{{ $mahasiswa->mahasiswa_nama }}" disabled>
                                                @if (!$mahasiswa->mahasiswa_nama)
                                                    <small class="text-danger">Nama kosong! Mohon perbarui pada menu
                                                        profile!</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="no_telp" class="col-md-4 col-form-label font-weight-bold">No.
                                                Telepon</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="no_telp"
                                                    value="{{ $mahasiswa->no_telp }}" disabled>
                                                @if (!$mahasiswa->no_telp)
                                                    <small class="text-danger">No. Telepon kosong! Mohon perbarui pada menu
                                                        profile!</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email"
                                                class="col-md-4 col-form-label font-weight-bold">Email</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="email"
                                                    value="{{ $mahasiswa->email }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="alamat"
                                                class="col-md-4 col-form-label font-weight-bold">Alamat</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="alamat"
                                                    value="{{ $mahasiswa->alamat }}" disabled>
                                                @if (!$mahasiswa->alamat)
                                                    <small class="text-danger">Alamat kosong! Mohon perbarui pada menu
                                                        profile!</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="prodi" class="col-md-4 col-form-label font-weight-bold">Program
                                                Studi</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="prodi"
                                                    value="{{ $mahasiswa->prodi->prodi_nama ?? '-' }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="jurusan"
                                                class="col-md-4 col-form-label font-weight-bold">Jurusan</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="jurusan"
                                                    value="{{ $mahasiswa->jurusan->jurusan_nama ?? '-' }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="kampus"
                                                class="col-md-4 col-form-label font-weight-bold">Kampus</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="kampus"
                                                    value="{{ $mahasiswa->kampus->kampus_nama ?? '-' }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-between">
                                    <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                    <small class="text-danger mt-2" style="font-size: 16px; font-weight: bold;">Pastikan
                                        data diri dan dokumen Anda telah sesuai sebelum submit ulang.</small>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check"></i> Perbarui
                                    </button>
                                </div>
                            </div>

                            <!-- Kolom Kanan: Jadwal & Dokumen -->
                            <div class="col-md-6">
                                <!-- Dokumen Section -->
                                <div class="card border-left-primary mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="card-title mb-0 text-primary">
                                            <i class="fas fa-file-alt"></i> Dokumen Pendukung
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label font-weight-bold">Kartu Tanda Mahasiswa
                                                (KTM)</label>
                                            <div class="col-md-8">
                                                @if ($mahasiswa->file_ktm)
                                                    <div class="d-flex align-items-center">
                                                        <button type="button"
                                                            class="btn btn-sm btn-success mr-2 btn-preview-dokumen"
                                                            data-image="{{ asset('storage/dokumen/ktm_mahasiswa/' . $mahasiswa->file_ktm) }}">
                                                            <i class="fas fa-eye"></i> Lihat
                                                        </button>
                                                        <span class="text-success">Dokumen sudah diunggah</span>
                                                    </div>
                                                @else
                                                    <span class="text-danger">Belum diunggah</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label font-weight-bold">Kartu Tanda Penduduk
                                                (KTP)</label>
                                            <div class="col-md-8">
                                                @if ($mahasiswa->file_ktp)
                                                    <div class="d-flex align-items-center">
                                                        <button type="button"
                                                            class="btn btn-sm btn-success mr-2 btn-preview-dokumen"
                                                            data-image="{{ asset('storage/dokumen/ktp_mahasiswa/' . $mahasiswa->file_ktp) }}">
                                                            <i class="fas fa-eye"></i> Lihat
                                                        </button>
                                                        <span class="text-success">Dokumen sudah diunggah</span>
                                                    </div>
                                                @else
                                                    <span class="text-danger">Belum diunggah</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label font-weight-bold">Pas Foto (3x4)</label>
                                            <div class="col-md-8">
                                                @if ($mahasiswa->file_pas_foto)
                                                    <div class="d-flex align-items-center">
                                                        <button type="button"
                                                            class="btn btn-sm btn-success mr-2 btn-preview-dokumen"
                                                            data-image="{{ asset('storage/dokumen/pas_foto_mahasiswa/' . $mahasiswa->file_pas_foto) }}">
                                                            <i class="fas fa-eye"></i> Lihat
                                                        </button>
                                                        <span class="text-success">Dokumen sudah diunggah</span>
                                                    </div>
                                                @else
                                                    <span class="text-danger">Belum diunggah</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modifikasi Bagian Jadwal -->
                                <div class="card border-left-primary mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="card-title mb-0 text-primary">
                                            <i class="fas fa-calendar-alt"></i> Jadwal Ujian
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="jadwal_id" class="col-md-4 col-form-label font-weight-bold">Pilih
                                                Jadwal</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="jadwal_id" name="jadwal_id" required>
                                                    <option value="">-- Pilih Jadwal Baru --</option>
                                                    @foreach ($jadwal as $j)
                                                        <option value="{{ $j->id }}"
                                                            {{ $pendaftaran->jadwal_id == $j->id ? 'selected' : '' }}>
                                                            {{ \Carbon\Carbon::parse($j->tanggal)->translatedFormat('l, d F Y H:i') }}
                                                            (Kuota: {{ $j->kuota }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {{-- <small class="text-danger mt-2">Status pendaftaran Anda ditolak. Silakan
                                                    pilih jadwal baru dan submit ulang.</small> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-left-primary mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="card-title mb-0 text-primary">
                                            <i class="fas fa-file-alt"></i> Status Pendaftaran
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        @if ($pendaftaran && $pendaftaran->mahasiswa_id == Auth::user()->mahasiswa->id)
                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label font-weight-bold">Status Saat
                                                    Ini</label>
                                                <div class="col-md-8">
                                                    <span
                                                        class="badge badge-{{ $pendaftaran->status_id == 2 ? 'success' : ($pendaftaran->status_id == 3 ? 'danger' : 'warning') }} p-2">
                                                        {{ $pendaftaran->status->status_nama ?? 'Sedang Diproses' }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label font-weight-bold">Keterangan
                                                    Validasi</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="keterangan"
                                                        value="{{ $pendaftaran->keterangan ?? '-' }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label font-weight-bold">Terakhir
                                                    Diperbarui</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                        value="{{ $pendaftaran->updated_at ? \Carbon\Carbon::parse($pendaftaran->updated_at)->translatedFormat('l, d F Y H:i:s') : 'Belum pernah diperbarui' }}"
                                                        disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label font-weight-bold">Tanggal
                                                    Pendaftaran</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                        value="{{ $pendaftaran->tanggal_pendaftaran ? \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->translatedFormat('l, d F Y') : '-' }}"
                                                        disabled>
                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-info">
                                                Anda belum memiliki data pendaftaran TOEIC.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal Preview Dokumen -->
    <div class="modal fade" id="modalPreviewDokumen" tabindex="-1" role="dialog" aria-labelledby="modalLabelDokumen"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pratinjau Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="previewDokumenImage" src="" class="img-fluid rounded shadow" alt="Dokumen">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // SweetAlert untuk notifikasi
        document.addEventListener('DOMContentLoaded', function() {
            // Alert sukses
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'Mengerti',
                    timer: 3000
                }).then(() => {
                    window.location.href = "{{ route('mahasiswa.pendaftaran.read_formulir') }}";
                });
            @endif

            // Alert error
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'Mengerti'
                });
            @endif

            // Validasi client-side
            document.getElementById('formEditPendaftaran').addEventListener('submit', function(e) {
                const jadwalSelect = document.getElementById('jadwal_id');
                if (!jadwalSelect.value) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Jadwal Belum Dipilih',
                        text: 'Silakan pilih jadwal ujian terlebih dahulu!',
                        confirmButtonText: 'Mengerti'
                    });
                    jadwalSelect.focus();
                }
            });
        });

        // Script untuk preview dokumen
        $(document).ready(function() {
            $('.btn-preview-dokumen').on('click', function() {
                const imageUrl = $(this).data('image');
                $('#previewDokumenImage').attr('src', imageUrl);
                $('#modalPreviewDokumen').modal('show');
            });
        });

        // Script untuk menutup modal ketika tombol close diklik
        $(document).on('click', '#modalPreviewDokumen .close', function() {
            $('#modalPreviewDokumen').modal('hide');
        });
    </script>
@endpush
