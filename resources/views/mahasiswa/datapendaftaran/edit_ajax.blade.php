<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editModalLabel">
                    <i class="fas fa-plus-circle"></i> Tambah Pendaftaran Baru
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditPendaftaran" action="{{ route('mahasiswa.pendaftaran.store_ajax') }}" method="POST">
                @csrf
                <div class="modal-body">
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
                                                {{ $mahasiswa->mahasiswa_nim ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 col-form-label font-weight-bold">Nama:</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-plaintext">
                                                {{ $mahasiswa->mahasiswa_nama ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 col-form-label font-weight-bold">Program Studi:</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-plaintext">
                                                {{ $mahasiswa->prodi->prodi_nama ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 col-form-label font-weight-bold">Jurusan:</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-plaintext">
                                                {{ $mahasiswa->jurusan->jurusan_nama ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 col-form-label font-weight-bold">Kampus:</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-plaintext">
                                                {{ $mahasiswa->kampus->kampus_nama ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 col-form-label font-weight-bold">No. Telp:</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-plaintext">
                                                {{ $mahasiswa->no_telp ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 col-form-label font-weight-bold">Email:</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-plaintext">
                                                {{ $mahasiswa->email ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 col-form-label font-weight-bold">Alamat:</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-plaintext">
                                                {{ $mahasiswa->alamat ?? '-' }}
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
                                    <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">

                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label font-weight-bold">Jadwal*</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="jadwal_id" required>
                                                <option value="">Pilih Jadwal</option>
                                                @foreach ($jadwal as $j)
                                                    <option value="{{ $j->id }}">
                                                        {{ \Carbon\Carbon::parse($j->tanggal)->translatedFormat('l, d F Y H:i') }}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                            @if (auth()->user()->mahasiswa->file_ktm)
                                                <a href="{{ asset('storage/dokumen/ktm_mahasiswa/' . auth()->user()->mahasiswa->file_ktm) }}"
                                                    class="btn btn-sm btn-outline-primary view-document"
                                                    data-url="{{ asset('storage/dokumen/ktm_mahasiswa/' . auth()->user()->mahasiswa->file_ktm) }}">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            @else
                                                <span class="text-danger">Belum diupload</span>
                                            @endif
                                        </div>
                                        <div class="col-md-4 text-center mb-3">
                                            <i class="fas fa-address-card fa-3x text-success mb-2"></i>
                                            <p class="mb-1 font-weight-bold">KTP</p>
                                            @if (auth()->user()->mahasiswa->file_ktp)
                                                <a href="{{ asset('storage/dokumen/ktp_mahasiswa/' . auth()->user()->mahasiswa->file_ktp) }}"
                                                    class="btn btn-sm btn-outline-success view-document"
                                                    data-url="{{ asset('storage/dokumen/ktp_mahasiswa/' . auth()->user()->mahasiswa->file_ktp) }}">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            @else
                                                <span class="text-danger">Belum diupload</span>
                                            @endif
                                        </div>
                                        <div class="col-md-4 text-center mb-3">
                                            <i class="fas fa-camera fa-3x text-info mb-2"></i>
                                            <p class="mb-1 font-weight-bold">Pas Foto</p>
                                            @if (auth()->user()->mahasiswa->file_pas_foto)
                                                <a href="{{ asset('storage/dokumen/pas_foto_mahasiswa/' . auth()->user()->mahasiswa->file_pas_foto) }}"
                                                    class="btn btn-sm btn-outline-info view-document"
                                                    data-url="{{ asset('storage/dokumen/pas_foto_mahasiswa/' . auth()->user()->mahasiswa->file_pas_foto) }}">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            @else
                                                <span class="text-danger">Belum diupload</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label font-weight-bold">Tanggal
                                            Pendaftaran</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="tanggal_pendaftaran"
                                                value="{{ date('Y-m-d') }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <input type="hidden" id="editPendaftaranId" name="pendaftaran_id" value="">
                    <button type="submit" class="btn btn-primary" id="editSubmitButton">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
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

    select.form-control:required:invalid {
        color: #6c757d;
    }

    option[value=""][disabled] {
        display: none;
    }

    option {
        color: #000;
    }

    .document-item {
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .document-item:hover {
        background-color: #f8f9fa;
    }
</style>

<script>
    $(document).ready(function() {
        // Tampilkan modal ketika di-load
        $('#editModal').modal('show');

        // Handle ketika modal ditutup
        $('#editModal').on('hidden.bs.modal', function() {
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
        // Form submission edit
        $('#formEditPendaftaran').submit(function(e) {
            e.preventDefault();
            var submitButton = $('#editSubmitButton');
            var pendaftaranId = $('#editPendaftaranId').val();

            submitButton.prop('disabled', true).html(
                '<i class="fas fa-spinner fa-spin"></i> Memproses...');

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        $('#table_pendaftaran').DataTable().ajax.reload();
                        $('#editModal').modal('hide');
                    });
                },
                error: function(xhr) {
                    submitButton.prop('disabled', false).html(
                        '<i class="fas fa-save"></i> Simpan');

                    var errorMessage = xhr.responseJSON?.message ||
                        'Gagal memperbarui data';
                    var status = xhr.status;

                    if (status === 422) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Tidak Dapat Edit',
                            text: errorMessage,
                            confirmButtonText: 'Mengerti'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage
                        });
                    }
                }
            });
        });
    });

    function openEditModal(id) {
        $.ajax({
            url: "{{ route('mahasiswa.pendaftaran.edit_ajax', '') }}/" + id,
            type: 'GET',
            beforeSend: function() {
                Swal.fire({
                    title: 'Memuat data...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response) {
                Swal.close();

                // Fill form data
                $('#editPendaftaranId').val(response.pendaftaran.id);
                $('#edit_jadwal_id').val(response.pendaftaran.jadwal_id);
                $('#edit_tanggal_pendaftaran').val(response.pendaftaran.tanggal_pendaftaran);

                // Update form action
                $('#formEditPendaftaran').attr('action',
                    "{{ route('mahasiswa.pendaftaran.update_ajax', '') }}/" + id);

                // Status validation
                if (![1, 3, 4].includes(response.pendaftaran.status_id)) {
                    $('#formEditPendaftaran :input').prop('disabled', true);
                    $('#editSubmitButton').hide();

                    let message = '';
                    switch (response.pendaftaran.status_id) {
                        case 2:
                            message = 'Data pendaftaran yang telah divalidasi tidak bisa diedit';
                            break;
                        default:
                            message = 'Data dengan status ini tidak bisa diedit';
                    }

                    Swal.fire({
                        icon: 'info',
                        title: 'Informasi',
                        text: message,
                        confirmButtonText: 'Mengerti'
                    });
                } else {
                    $('#formEditPendaftaran :input').prop('disabled', false);
                    $('#editSubmitButton').show();
                }

                // Show modal
                $('#editModal').modal('show');
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || 'Gagal memuat data pendaftaran'
                });
            }
        });
    }

    // Function to handle delete
    function deleteConfirm(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            $('#table_pendaftaran').DataTable().ajax.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.message || 'Gagal menghapus data'
                        });
                    }
                });
            }
        });
    }

    // Form submission for edit
    $('#formEditPendaftaran').submit(function(e) {
    e.preventDefault();
    var submitButton = $('#editSubmitButton');
    submitButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Memproses...');

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: response.message,
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                $('#table_pendaftaran').DataTable().ajax.reload();
                $('#editModal').modal('hide');
            });
        },
        error: function(xhr) {
            submitButton.prop('disabled', false).html('<i class="fas fa-save"></i> Simpan');

            var errorMessage = xhr.responseJSON?.message || 'Gagal memperbarui data';
            if (xhr.status === 422) {
                Swal.fire({
                    icon: 'error',
                    title: 'Tidak Dapat Edit',
                    text: errorMessage
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage
                });
            }
        }
    });
</script>
