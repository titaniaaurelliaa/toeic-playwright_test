@php
    $pendaftaran = $pendaftaran ?? null;
@endphp

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-info-circle"></i> Detail Pendaftaran
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
                                                {{ $pendaftaran->mahasiswa->mahasiswa_nim ?? '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 col-form-label font-weight-bold">Nama:</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-plaintext">
                                                {{ $pendaftaran->mahasiswa->mahasiswa_nama ?? '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 col-form-label font-weight-bold">Program Studi:</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-plaintext">
                                                {{ $pendaftaran->mahasiswa->prodi->prodi_nama ?? '-' }}</p>
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
                                        <label class="col-sm-5 col-form-label font-weight-bold">Tanggal Ujian:</label>
                                        <div class="col-sm-7">
                                            <p class="form-control-plaintext">
                                                @if ($pendaftaran->jadwal->tanggal)
                                                    {{ date('d F Y', strtotime($pendaftaran->jadwal->tanggal)) }}
                                                @else
                                                    -
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-5 col-form-label font-weight-bold">Jam Ujian:</label>
                                        <div class="col-sm-7">
                                            <p class="form-control-plaintext">
                                                @if ($pendaftaran->jadwal->tanggal)
                                                    {{ date('H:i', strtotime($pendaftaran->jadwal->tanggal)) }}
                                                @else
                                                    -
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-5 col-form-label font-weight-bold">Status:</label>
                                        <div class="col-sm-7">
                                            <p class="form-control-plaintext">
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
                                                    <span class="badge {{ $statusClass }} px-3 py-2">
                                                        {{ $pendaftaran->status->status_nama }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-light px-3 py-2">-</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dokumen Pendukung -->
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-light">
                            <h6 class="card-title mb-0 text-primary">
                                <i class="fas fa-file-alt"></i> Dokumen Pendukung
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @auth
                                    @if (auth()->user()->mahasiswa)
                                        <div class="col-md-4">
                                            <div class="document-item text-center">
                                                <i class="fas fa-id-card fa-3x text-primary mb-2"></i>
                                                <p class="mb-1 font-weight-bold">KTM</p>
                                                @if (auth()->user()->mahasiswa->file_ktm)
                                                    <a href="{{ asset('storage/dokumen/ktm_mahasiswa/' . auth()->user()->mahasiswa->file_ktm) }}"
                                                        class="btn btn-sm btn-outline-primary view-document"
                                                        data-url="{{ asset('storage/dokumen/ktm_mahasiswa/' . auth()->user()->mahasiswa->file_ktm) }}">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                @else
                                                    <span class="text-muted">Tidak tersedia</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="document-item text-center">
                                                <i class="fas fa-address-card fa-3x text-success mb-2"></i>
                                                <p class="mb-1 font-weight-bold">KTP</p>
                                                @if (auth()->user()->mahasiswa->file_ktp)
                                                    <a href="{{ asset('storage/dokumen/ktp_mahasiswa/' . auth()->user()->mahasiswa->file_ktp) }}"
                                                        class="btn btn-sm btn-outline-success view-document"
                                                        data-url="{{ asset('storage/dokumen/ktp_mahasiswa/' . auth()->user()->mahasiswa->file_ktp) }}">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                @else
                                                    <span class="text-muted">Tidak tersedia</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="document-item text-center">
                                                <i class="fas fa-camera fa-3x text-info mb-2"></i>
                                                <p class="mb-1 font-weight-bold">Pas Foto</p>
                                                @if (auth()->user()->mahasiswa->file_pas_foto)
                                                    <a href="{{ asset('storage/dokumen/pas_foto_mahasiswa/' . auth()->user()->mahasiswa->file_pas_foto) }}"
                                                        class="btn btn-sm btn-outline-info view-document"
                                                        data-url="{{ asset('storage/dokumen/pas_foto_mahasiswa/' . auth()->user()->mahasiswa->file_pas_foto) }}">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                @else
                                                    <span class="text-muted">Tidak tersedia</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endauth
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
        $('#detailModal').on('hidden.bs.modal', function() {
            $(this).remove();
        });

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

            // Pastikan modal benar-benar tertutup sebelum membuka yang baru
            $('#documentPreviewModal').on('hidden.bs.modal', function() {
                $(this).find('#documentPreviewImage').attr('src', '').hide();
                $(this).find('#documentPreviewPdf').attr('src', '').hide();
                $(this).find('#documentUnsupported').hide();
            });
        });
    });
</script>
