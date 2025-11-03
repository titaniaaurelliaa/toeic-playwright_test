@extends('layouts_admin.template')

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

@section('content')
    <div class="container-fluid">
        <div class="card-body">
            @if ($pendaftaran)
                <form id="form-validasi" action="{{ route('admin.pendaftaran.validasi_proses', $pendaftaran->id) }}"
                    method="POST">
                    @csrf
                    <input type="hidden" id="status_id" name="status_id" value="">
                    <div class="row">
                        <!-- Kolom Kiri: Data Mahasiswa -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-primary">
                                        <i class="fas fa-user-graduate"></i> Data Mahasiswa
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row align-items-center">
                                        <label for="mahasiswa_nim" class="col-md-3 col-form-label font-weight-bold">NIM :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="text" class="form-control flex-grow-1 mr-2" id="mahasiswa_nim"
                                                name="mahasiswa_nim" maxlength="15"
                                                value="{{ $mahasiswa->mahasiswa_nim ?? '' }}" readonly>
                                            {{-- <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="mahasiswa_nim_checkbox"
                                                    name="mahasiswa_nim_checkbox">
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="nik" class="col-md-3 col-form-label font-weight-bold">NIK :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="text" class="form-control flex-grow-1 mr-2" id="nik"
                                                name="nik" maxlength="15" value="{{ $mahasiswa->nik ?? '' }}" readonly>
                                            {{-- <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="nik_checkbox"
                                                    name="nik_checkbox">
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="mahasiswa_nama" class="col-md-3 col-form-label font-weight-bold">Nama
                                            Lengkap : </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="text" class="form-control flex-grow-1 mr-2" id="mahasiswa_nama"
                                                name="mahasiswa_nama" maxlength="15"
                                                value="{{ $mahasiswa->mahasiswa_nama ?? '' }}" readonly>
                                            {{-- <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="mahasiswa_nama_checkbox"
                                                    name="mahasiswa_nama_checkbox">
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="no_telp" class="col-md-3 col-form-label font-weight-bold">Nomor Telepon
                                            :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="text" class="form-control flex-grow-1 mr-2" id="no_telp"
                                                name="no_telp" maxlength="15" value="{{ $mahasiswa->no_telp ?? '' }}"
                                                readonly>
                                            {{-- <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="no_telp_checkbox"
                                                    name="no_telp_checkbox">
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="email" class="col-md-3 col-form-label font-weight-bold">Email :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="email" class="form-control flex-grow-1 mr-2" id="email"
                                                name="email" maxlength="15" value="{{ $mahasiswa->email ?? '' }}"
                                                readonly>
                                            {{-- <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="email_checkbox"
                                                    name="email_checkbox">
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="text" class="col-md-3 col-form-label font-weight-bold">Alamat :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="alamat" class="form-control flex-grow-1 mr-2" id="alamat"
                                                name="alamat" maxlength="15" value="{{ $mahasiswa->alamat ?? '' }}"
                                                readonly>
                                            {{-- <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="alamat_checkbox"
                                                    name="alamat_checkbox">
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="prodi" class="col-md-3 col-form-label font-weight-bold">Program
                                            Studi :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="prodi" class="form-control flex-grow-1 mr-2" id="prodi"
                                                name="prodi" maxlength="15"
                                                value="{{ $mahasiswa->prodi->prodi_nama ?? '' }}" readonly>
                                            {{-- <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="prodi_checkbox"
                                                    name="prodi_checkbox">
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="jurusan" class="col-md-3 col-form-label font-weight-bold">Jurusan :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="jurusan" class="form-control flex-grow-1 mr-2" id="jurusan"
                                                name="jurusan" maxlength="15"
                                                value="{{ $mahasiswa->jurusan->jurusan_nama ?? '' }}" readonly>
                                            {{-- <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="jurusan_checkbox"
                                                    name="jurusan_checkbox">
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="kampus" class="col-md-3 col-form-label font-weight-bold">Kampus :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="kampus" class="form-control flex-grow-1 mr-2" id="kampus"
                                                name="kampus" maxlength="15"
                                                value="{{ $mahasiswa->kampus->kampus_nama ?? '' }}" readonly>
                                            {{-- <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="kampus_checkbox"
                                                    name="kampus_checkbox">
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="button" id="btn-simpan" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Jadwal + Dokumen -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-primary">
                                        <i class="fas fa-calendar-check"></i> Jadwal Ujian
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @php $jadwal = $pendaftaran->jadwal; @endphp
                                    <div class="form-group row align-items-center">
                                        <label for="tanggal" class="col-md-3 col-form-label font-weight-bold">Tanggal :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="tanggal" class="form-control flex-grow-1 mr-2" id="tanggal"
                                                name="tanggal" maxlength="15"
                                                value="{{ $jadwal && $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') : '-' }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="jam" class="col-md-3 col-form-label font-weight-bold">Jam :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="jam" class="form-control flex-grow-1 mr-2" id="jam"
                                                name="jam" maxlength="15"
                                                value="{{ $jadwal && $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->format('H:i') : '-' }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-primary">
                                        <i class="fas fa-file-alt"></i> Dokumen Pendaftaran
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 text-center mb-3">
                                            <i class="fas fa-id-card fa-3x text-primary mb-2"></i>
                                            <p class="font-weight-bold mb-1">KTM</p>
                                            @if ($pendaftaran->mahasiswa && $pendaftaran->mahasiswa->file_ktm)
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="#"
                                                        class="btn btn-sm btn-outline-primary view-document mr-2"
                                                        data-url={{ asset('storage/dokumen/ktm_mahasiswa/' . $pendaftaran->mahasiswa->file_ktm) }}>
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                </div>
                                            @else
                                                <span class="text-danger">Belum diupload</span>
                                            @endif
                                        </div>

                                        <div class="col-md-4 text-center mb-3">
                                            <i class="fas fa-address-card fa-3x text-success mb-2"></i>
                                            <p class="font-weight-bold mb-1">KTP</p>
                                            @if ($pendaftaran->mahasiswa && $pendaftaran->mahasiswa->file_ktp)
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="#"
                                                        class="btn btn-sm btn-outline-primary view-document mr-2"
                                                        data-url='{{ asset('storage/dokumen/ktp_mahasiswa/' . $pendaftaran->mahasiswa->file_ktp) }}'>
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                </div>
                                            @else
                                                <span class="text-danger">Belum diupload</span>
                                            @endif
                                        </div>

                                        <div class="col-md-4 text-center mb-3">
                                            <i class="fas fa-camera fa-3x text-info mb-2"></i>
                                            <p class="font-weight-bold mb-1">Pas Foto</p>
                                            @if ($pendaftaran->mahasiswa && $pendaftaran->mahasiswa->file_pas_foto)
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="#"
                                                        class="btn btn-sm btn-outline-primary view-document mr-2"
                                                        data-url="{{ asset('storage/dokumen/pas_foto_mahasiswa/' . $pendaftaran->mahasiswa->file_pas_foto) }}">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                </div>
                                            @else
                                                <span class="text-danger">Belum diupload</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kelengkapan Data & Dokumen -->
                            <div class="card mt-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 text-dark"><i class="fas fa-file-alt"></i> Kelengkapan Data & Dokumen
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-start">
                                        <!-- Kolom checkbox -->
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="ktm_checkbox"
                                                    name="ktm_checkbox">
                                                <label class="form-check-label" for="dataLengkap">
                                                    KTM
                                                </label><br>

                                                <input class="form-check-input" type="checkbox" id="ktp_checkbox"
                                                    name="ktp_checkbox">
                                                <label class="form-check-label" for="dataLengkap">
                                                    KTP
                                                </label><br>

                                                <input class="form-check-input" type="checkbox" id="pas_foto_checkbox"
                                                    name="pas_foto_checkbox">
                                                <label class="form-check-label" for="dataLengkap">
                                                    Pas Foto
                                                </label><br>

                                                <input type="checkbox" class="form-check-input" id="data_dokumen"
                                                    name="data_dokumen">
                                                <label class="form-check-label" for="dataLengkap">
                                                    Data Diri & Dokumen sesuai?
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Kolom keterangan -->
                                        <div class="col-md-8">
                                            <label for="keterangan" class="form-label">Keterangan (opsional)</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control" rows="3"
                                                placeholder="Tulis data yang tidak sesuai"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Timeline Pendaftaran -->
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-primary">
                                        <i class="fas fa-history"></i> Timeline Pendaftaran
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <!-- Pendaftaran Dibuat -->
                                        <div class="col-md-4 text-center mb-3">
                                            <div class="text-primary mb-2">
                                                <i class="fas fa-calendar-plus fa-2x"></i>
                                            </div>
                                            <h6 class="mb-1">Pendaftaran Dibuat</h6>
                                            <p class="mb-0 text-muted">
                                                {{ $pendaftaran->created_at->translatedFormat('l, d F Y H:i') }}
                                            </p>
                                        </div>

                                        <!-- Status Diperbarui -->
                                        @if ($pendaftaran->status)
                                            @php
                                                $status = $pendaftaran->status->status_nama;
                                                $statusClass = match ($status) {
                                                    'Diterima' => 'success',
                                                    'Ditolak' => 'danger',
                                                    'Diproses' => 'warning',
                                                    default => 'light',
                                                };
                                            @endphp
                                            <div class="col-md-4 text-center mb-3">
                                                <div class="text-{{ $statusClass }} mb-2">
                                                    <i class="fas fa-check-circle fa-2x"></i>
                                                </div>
                                                <h6 class="mb-1">
                                                    Status: <span
                                                        class="badge bg-{{ $statusClass }} text-white">{{ $status }}</span>
                                                </h6>
                                                <h6 class="text-muted">Diperbarui:
                                                    {{ $pendaftaran->updated_at->diffForHumans() }}</h6>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </form>
            @else
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> Data pendaftaran tidak ditemukan!
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Preview Dokumen -->
    <div class="modal fade" id="modalPreviewDokumen" tabindex="-1" aria-labelledby="modalPreviewDokumenLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="previewImage" src="" class="img-fluid rounded" alt="Dokumen">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>

    <script>
        $(document).ready(function() {
            emailjs.init('YBVRRlRqt0OMCr-de'); // Replace with your actual EmailJS user ID

            $('#btn-simpan').click(function(e) {
                e.preventDefault();

                const mahasiswaEmail = $('#email').val();
                const mahasiswaNama = $('#mahasiswa_nama').val();
                const mahasiswaNim = $('#mahasiswa_nim').val();
                const mahasiswaNik = $('#nik').val();
                const statusIdToSend = $('#status_id').val();
                const keterangan = $('#keterangan').val();

                const tanggalDB = $('#tanggal').val(); // Assuming this is in 'YYYY-MM-DD' format
                const date = new Date(tanggalDB);

                // Konfigurasi format hari, tanggal, bulan, tahun
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                    'September', 'Oktober', 'November', 'Desember'
                ];

                const hari = days[date.getDay()]; // "Senin"
                const tanggal = date.getDate(); // 16
                const bulan = months[date.getMonth()]; // "Juni"
                const tahun = date.getFullYear(); // 2025

                const jam = String(date.getHours()).padStart(2, '0'); // "08"
                const menit = String(date.getMinutes()).padStart(2, '0'); // "00"

                // Format akhir
                const tanggalFormatted = `${hari}, ${tanggal} ${bulan} ${tahun}`; // "Senin, 16 Juni 2025"
                const jamFormatted = `${jam}:${menit}`; // "08:00"

                const checkboxes = $('.form-check-input[type="checkbox"]');
                const checkedBoxes = $('.form-check-input[type="checkbox"]:checked');

                // If no checkboxes at all
                if (checkboxes.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak ada data yang divalidasi',
                        text: 'Silakan tambahkan field yang perlu divalidasi.',
                    });
                    return;
                }

                // If none checked
                if (checkedBoxes.length === 0) {
                    Swal.fire({
                        title: 'Validasi Data',
                        text: "Anda belum mencentang data yang divalidasi. Yakin ingin melanjutkan?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Tolak Pendaftaran',
                        cancelButtonText: 'Kembali'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#status_id').val(3); // rejected
                            sendEmailNotification(
                                mahasiswaEmail,
                                mahasiswaNama,
                                mahasiswaNim,
                                mahasiswaNik,
                                tanggalFormatted,
                                jamFormatted,
                                'ditolak',
                                keterangan
                            );
                            // $('#form-validasi').submit();
                        }
                    });
                    return;
                }

                // If all checked
                if (checkedBoxes.length === checkboxes.length) {
                    Swal.fire({
                        title: 'Validasi Data',
                        text: "Semua data sudah divalidasi. Terima pendaftaran?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Terima Pendaftaran',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#status_id').val(2); // accepted
                            sendEmailNotification(
                                mahasiswaEmail,
                                mahasiswaNama,
                                mahasiswaNim,
                                mahasiswaNik,
                                tanggalFormatted,
                                jamFormatted,
                                'diterima',
                                keterangan
                            );
                            // $('#form-validasi').submit();
                        }
                    });
                }
                // If partially checked
                else {
                    Swal.fire({
                        title: 'Validasi Data',
                        text: "Hanya sebagian data yang divalidasi. Apa pendaftaran akan ditolak?",
                        icon: (statusIdToSend === 2) ? 'question' : 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Tolak Pendaftaran',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#status_id').val(3); // accepted
                            sendEmailNotification(
                                mahasiswaEmail,
                                mahasiswaNama,
                                mahasiswaNim,
                                mahasiswaNik,
                                tanggalFormatted,
                                jamFormatted,
                                'ditolak',
                                keterangan
                            );
                            // $('#form-validasi').submit();
                        }
                    });
                }
            });

            // Function to send email notification
            function sendEmailNotification(
                email,
                nama,
                nim,
                nik,
                tanggalFormatted,
                jamFormatted,
                status,
                keterangan
            ) {
                const templateParams = {
                    to_email: email,
                    to_name: nama,
                    nim: nim,
                    nik: nik,
                    status: status,
                    tanggalFormatted: tanggalFormatted || 'Akan diinformasikan',
                    jamFormatted: jamFormatted || 'Akan diinformasikan',
                    keterangan: keterangan || '-'
                };

                // Use your specific template IDs
                const templateId = status === 'diterima' ?
                    'template_d54bd1c' :
                    'template_cw84rvf';

                console.log('Mengirim email dengan template:', templateId, 'dan params:', templateParams);


                emailjs.send('service_yost8ss', templateId, templateParams)
                    .then(function(response) {
                        console.log('Email berhasil dikirim', response);
                        // $('#form-validasi').submit();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Status pendaftaran berhasil diperbarui dan email notifikasi telah dikirim',
                            timer: 3000
                        }).then((result) => {
                            $('#form-validasi').submit();
                        });
                    }, function(error) {
                        console.error('Gagal mengirim email', error);
                        Swal.fire({
                            icon: 'warning',
                            title: 'Email Gagal Dikirim',
                            text: 'Status berhasil diperbarui tetapi email notifikasi gagal dikirim',
                        }).then((result) => {
                            $('#form-validasi').submit();
                        });
                    });
                // $('#form-validasi').submit();
            }

            // Tampilkan gambar dokumen di modal saat tombol "Lihat" diklik
            $(document).on('click', '.view-document', function(e) {
                e.preventDefault();

                const imageUrl = $(this).data('url');
                $('#previewImage').attr('src', imageUrl);
                $('#modalPreviewDokumen').modal('show');
            });
        });
    </script>
@endpush
