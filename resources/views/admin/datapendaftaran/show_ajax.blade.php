<div class="modal-header">
    <h5 class="modal-title">Detail Pendaftaran</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
{{-- <div class="modal-body">
    <table class="table table-borderless">
        <tr>
            <th class="text-right">NIM</th>
            <td>{{ $pendaftaran->pendaftaran->mahasiswa->mahasiswa_nim ?? '-' }}</td>
        </tr>
        <tr>
            <th class="text-right">Nama</th>
            <td>{{ $pendaftaran->pendaftaran->mahasiswa->mahasiswa_nama ?? '-' }}</td>
        </tr>
        <tr>
            <th class="text-right">Program Studi</th>
            <td>{{ $pendaftaran->pendaftaran->mahasiswa->prodi->prodi_nama ?? '-' }}</td>
        </tr>
        <tr>
            <th class="text-right">Jurusan</th>
            <td>{{ $pendaftaran->pendaftaran->mahasiswa->jurusan->jurusan_nama ?? '-' }}</td>
        </tr>
        <tr>
            <th class="text-right">Kampus</th>
            <td>{{ $pendaftaran->pendaftaran->mahasiswa->kampus->kampus_nama ?? '-' }}</td>
        </tr>
        <tr>
            <th class="text-right">Tanggal Pendaftaran</th>
            <td>{{ \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th class="text-right">Status</th>
            <td>{{ $pendaftaran->status->status_nama ?? '-' }}</td>
        </tr>
        <tr>
            <th class="text-right">Jadwal</th>
            <td>{{ $pendaftaran->jadwal->jadwal_nama ?? '-' }}</td>
        </tr>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
</div>

<script>
    $(document).on('click', '[data-dismiss="modal"]', function() {
        $('#modalContainer').modal('hide');
    });
</script> --}}

{{-- <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-info-circle"></i> Detail Pendaftaran
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
<div class="modal-body">
    @if ($pendaftaran)
        <div class="row">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0 text-primary">
                            <i class="fas fa-user-graduate"></i> Data Mahasiswa
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-form-label font-weight-bold">NIM:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">
                                    {{ $pendaftaran->mahasiswa->mahasiswa_nim ?? '-' }}
                                </p>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-form-label font-weight-bold">Nama:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">
                                    {{ $pendaftaran->mahasiswa->mahasiswa_nama ?? '-' }}
                                </p>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-form-label font-weight-bold">Program
                                Studi:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">
                                    {{ $pendaftaran->mahasiswa->prodi->prodi_nama ?? '-' }}
                                </p>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-form-label font-weight-bold">Jurusan:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">
                                    {{ $pendaftaran->mahasiswa->jurusan->jurusan_nama ?? '-' }}
                                </p>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-form-label font-weight-bold">Kampus:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">
                                    {{ $pendaftaran->mahasiswa->kampus->kampus_nama ?? '-' }}
                                </p>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-form-label font-weight-bold">No. Telp:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">
                                    {{ $pendaftaran->mahasiswa->no_telp ?? '-' }}
                                </p>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-form-label font-weight-bold">Email:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">
                                    {{ $pendaftaran->mahasiswa->email ?? '-' }}
                                </p>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-form-label font-weight-bold">Alamat:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">
                                    {{ $pendaftaran->mahasiswa->alamat ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0 text-primary">
                            <i class="fas fa-calendar-check"></i> Jadwal Ujian
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-form-label font-weight-bold">Tanggal:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">
                                    {{ $pendaftaran->jadwal && $pendaftaran->jadwal->tanggal
                                        ? \Carbon\Carbon::parse($pendaftaran->jadwal->tanggal)->translatedFormat('l, d F Y')
                                        : '-' }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-form-label font-weight-bold">Jam:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">
                                    {{ $pendaftaran->jadwal && $pendaftaran->jadwal->tanggal
                                        ? \Carbon\Carbon::parse($pendaftaran->jadwal->tanggal)->format('H:i')
                                        : '-' }}
                                </p>
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
                                <p class="mb-1 font-weight-bold">KTM</p>
                                @if ($pendaftaran->mahasiswa && $pendaftaran->mahasiswa->file_ktm)
                                    <a href="{{ asset('storage/dokumen/ktm_mahasiswa/' . $pendaftaran->mahasiswa->file_ktm) }}"
                                        class="btn btn-sm btn-outline-primary view-document"
                                        data-url="{{ asset('storage/dokumen/ktm_mahasiswa/' . $pendaftaran->mahasiswa->file_ktm) }}">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-danger">Belum diupload</span>
                                @endif
                            </div>

                            <div class="col-md-4 text-center mb-3">
                                <i class="fas fa-address-card fa-3x text-success mb-2"></i>
                                <p class="mb-1 font-weight-bold">KTP</p>
                                @if ($pendaftaran->mahasiswa->file_ktp)
                                    <a href="{{ asset('storage/dokumen/ktp_mahasiswa/' . $pendaftaran->mahasiswa->file_ktp) }}"
                                        class="btn btn-sm btn-outline-success view-document"
                                        data-url="{{ asset('storage/dokumen/ktp_mahasiswa/' . $pendaftaran->mahasiswa->file_ktp) }}">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-danger">Belum diupload</span>
                                @endif
                            </div>
                            <div class="col-md-4 text-center mb-3">
                                <i class="fas fa-camera fa-3x text-info mb-2"></i>
                                <p class="mb-1 font-weight-bold">Pas Foto</p>
                                @if ($pendaftaran->mahasiswa->file_pas_foto)
                                    <a href="{{ asset('storage/dokumen/pas_foto_mahasiswa/' . $pendaftaran->mahasiswa->file_pas_foto) }}"
                                        class="btn btn-sm btn-outline-info view-document"
                                        data-url="{{ asset('storage/dokumen/pas_foto_mahasiswa/' . $pendaftaran->mahasiswa->file_pas_foto) }}">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-danger">Belum diupload</span>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label font-weight-bold">Tanggal
                                Pendaftaran</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="tanggal_pendaftaran"
                                    value="{{ date('Y-m-d') }}" readonly>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

</div>

<!-- Timeline Pendaftaran -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-light">
        <h6 class="card-title mb-0 text-primary">
            <i class="fas fa-history"></i> Timeline Pendaftaran
        </h6>
    </div>
    <div class="card-body">
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-point timeline-point-primary">
                    <i class="fas fa-calendar-plus"></i>
                </div>
                <div class="timeline-event">
                    <div class="timeline-heading">
                        <h6>Pendaftaran Dibuat</h6>
                    </div>
                    <div class="timeline-body">
                        <p>{{ $pendaftaran->created_at->translatedFormat('l, d F Y H:i') }}</p>
                    </div>
                </div>
            </div>

            @if ($pendaftaran->status)
                @if ($pendaftaran->status)
                    @php
                        $statusClass = '';
                        switch ($pendaftaran->status->status_nama) {
                            case 'Diterima':
                                $statusClass = 'badge-success';
                                break;
                            case 'Ditolak':
                                $statusClass = 'badge-danger';
                                break;
                            case 'Diproses':
                                $statusClass = 'badge-warning';
                                break;
                            case 'Belum Bayar':
                                $statusClass = 'badge-secondary';
                                break;
                            case 'Sudah Bayar':
                                $statusClass = 'badge-primary';
                                break;
                            default:
                                $statusClass = 'badge-light';
                        }
                    @endphp
                @else
                    <span class="badge badge-light px-3 py-2">-</span>
                @endif
                <div class="timeline-item">
                    <div class="timeline-point timeline-point-{{ $statusClass }}">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="timeline-event">
                        <div class="timeline-heading">
                            <h6>Status Diperbarui</h6>
                        </div>
                        <div class="timeline-body">
                            <p>Status: <span
                                    class="badge {{ $statusClass }}">{{ $pendaftaran->status->status_nama }}</span>
                            </p>
                            <small class="text-muted">Terakhir diperbarui:
                                {{ $pendaftaran->updated_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@else
<div class="alert alert-danger">
    <i class="fas fa-exclamation-circle"></i> Data pendaftaran tidak ditemukan!
</div>
@endif
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">
        <i class="fas fa-times"></i> Tutup
    </button>
    <button type="button" class="btn btn-primary" onclick="window.print()">
        <i class="fas fa-print"></i> Cetak
    </button>
</div>
</div>
</div>
</div>

<!-- Modal untuk preview dokumen -->
<div class="modal-header">
    <h5 class="modal-title">Detail Pendaftaran</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal fade" id="documentPreviewModal" tabindex="-1" role="dialog"
    aria-labelledby="documentPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentPreviewModalLabel">Preview Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="documentPreviewImage" src="" class="img-fluid" alt="Preview Dokumen"
                    style="max-height: 80vh; display: none;">
                <iframe id="documentPreviewPdf" src="" style="width:100%; height:80vh; display: none;"
                    frameborder="0"></iframe>
                <div id="documentUnsupported" style="display: none;">
                    <i class="fas fa-file-alt fa-5x text-muted mb-3"></i>
                    <p>Format dokumen tidak didukung untuk preview. Silahkan unduh untuk melihat.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <a id="documentDownloadLink" href="#" class="btn btn-primary" download>
                    <i class="fas fa-download"></i> Unduh
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control-plaintext {
        padding-left: 0;
        padding-right: 0;
        border: none;
        background: transparent;
    }

    .card {
        transition: all 0.3s ease;
        border-radius: 0.5rem;
    }

    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }

    .document-item {
        padding: 1rem;
        border-radius: 0.5rem;
        background-color: #f8f9fa;
        height: 100%;
    }

    .timeline {
        padding-left: 5px;
        list-style: none;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 20px;
    }

    .timeline-point {
        position: absolute;
        left: -20px;
        top: 0;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        text-align: center;
        line-height: 40px;
        color: white;
    }

    .timeline-point-primary {
        background-color: #4e73df;
    }

    .timeline-point-success {
        background-color: #1cc88a;
    }

    .timeline-point-warning {
        background-color: #f6c23e;
    }

    .timeline-point-danger {
        background-color: #e74a3b;
    }

    .timeline-event {
        margin-left: 30px;
        padding: 10px;
        border-radius: 5px;
        background-color: #f8f9fa;
    }

    @media print {

        .modal-header,
        .modal-footer {
            display: none !important;
        }

        .modal-body {
            padding: 0 !important;
        }

        .document-item {
            page-break-inside: avoid;
        }
    }
</style>
<script>
    $(document).ready(function() {
        // Tampilkan modal ketika di-load
        $('#detailModal').modal('show');

        // Handle ketika modal ditutup
        // $('#detailModal').on('hidden.bs.modal', function() {
        //     $(this).remove();
        // });

        // Preview dokumen - menggunakan event delegation untuk elemen yang mungkin belum ada saat DOM loaded
        $(document).on('click', '.view-document', function(e) {
            e.preventDefault();
            var url = $(this).data('url');
            var ext = url.split('.').pop().toLowerCase();

            // Reset semua tampilan preview
            $('#documentPreviewImage').hide().attr('src', '');
            $('#documentPreviewPdf').hide().attr('src', '');
            $('#documentUnsupported').hide();

            // Set link download
            $('#documentDownloadLink').attr('href', url);

            // Tampilkan sesuai tipe file
            if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
                $('#documentPreviewImage').attr('src', url).show();
            } else if (ext === 'pdf') {
                $('#documentPreviewPdf').attr('src', url).show();
            } else {
                $('#documentUnsupported').show();
            }

            // Tampilkan modal dan bersihkan event sebelumnya
            $('#documentPreviewModal').modal('show').off('hidden.bs.modal');

            // // Pastikan modal benar-benar tertutup sebelum membuka yang baru
            // $('#documentPreviewModal').on('hidden.bs.modal', function() {
            //     $(this).find('#documentPreviewImage').attr('src', '').hide();
            //     $(this).find('#documentPreviewPdf').attr('src', '').hide();
            //     $(this).find('#documentUnsupported').hide();
            // });

            // Pastikan semua elemen dalam modal reset ketika ditutup
            $('#documentPreviewModal').on('hidden.bs.modal', function() {
                $('#detailModal').modal('show');
                $('#documentPreviewImage').attr('src', '').hide();
                $('#documentPreviewPdf').attr('src', '').hide();
                $('#documentUnsupported').hide();
                $('#documentDownloadLink').attr('href', '#');
            });
        });
    });
</script>
