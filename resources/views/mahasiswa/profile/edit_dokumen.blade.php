<!-- Edit Dokumen -->
<div class="tab-pane fade" id="editDokumen" role="tabpanel" aria-labelledby="editDokumen-tab">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Edit Dokumen</h5>
        </div>
        <div class="card-body">
            <form id="editDokumenForm">
                @auth
                    @if (auth()->user()->mahasiswa)
                        <div class="row mb-4">
                            {{-- FOTO KTM --}}
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body text-center">
                                        <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                            Foto KTM
                                        </div><br>
                                        <div class="img-thumbnail-container mb-2">
                                            @if (auth()->user()->mahasiswa->file_ktm)
                                                <img src="{{ asset('storage/dokumen/ktm_mahasiswa/' . auth()->user()->mahasiswa->file_ktm) }}"
                                                    alt="Foto KTM" class="img-thumbnail" style="max-width: 150px;">
                                            @endif
                                        </div>
                                        <input type="file" id="file_ktm" name="file_ktm" accept="image/*"
                                            class="form-control-file mb-1">
                                        <small class="text-muted">Format: JPEG, PNG, JPG, GIF (max 2MB)</small>
                                    </div>
                                </div>
                            </div>

                            {{-- FOTO KTP --}}
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body text-center">
                                        <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                            Foto KTP
                                        </div><br>
                                        <div class="img-thumbnail-container mb-2">
                                            @if (auth()->user()->mahasiswa->file_ktp)
                                                <img src="{{ asset('storage/dokumen/ktp_mahasiswa/' . auth()->user()->mahasiswa->file_ktp) }}"
                                                    alt="Foto KTP" class="img-thumbnail" style="max-width: 150px;">
                                            @endif
                                        </div>
                                        <input type="file" id="file_ktp" name="file_ktp" accept="image/*"
                                            class="form-control-file mb-1">
                                        <small class="text-muted">Format: JPEG, PNG, JPG, GIF (max 2MB)</small>
                                    </div>
                                </div>
                            </div>

                            {{-- PAS FOTO 3x4 --}}
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body text-center">
                                        <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                            Pas Foto 3x4
                                        </div><br>
                                        <div class="img-thumbnail-container mb-2">
                                            @if (auth()->user()->mahasiswa->file_pas_foto)
                                                <img src="{{ asset('storage/dokumen/pas_foto_mahasiswa/' . auth()->user()->mahasiswa->file_pas_foto) }}"
                                                    alt="Pas Foto 3x4" class="img-thumbnail" style="max-width: 150px;">
                                            @endif
                                        </div>
                                        <input type="file" id="file_pas_foto" name="file_pas_foto" accept="image/*"
                                            class="form-control-file mb-1">
                                        <small class="text-muted">Format: JPEG, PNG, JPG, GIF (max 2MB)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endauth
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Handle dokumen form submission
        $('#editDokumenForm').on('submit', function(e) {
            e.preventDefault();

            // Show loading indicator
            Swal.fire({
                title: 'Menyimpan perubahan',
                html: 'Sedang mengunggah dokumen...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Buat FormData object untuk handle file upload
            var formData = new FormData(this);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            $.ajax({
                url: '{{ route('mahasiswa.profile.update_dokumen') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log("Success:", response);

                    // Close loading dialog
                    Swal.close();

                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 3000,
                        showConfirmButton: false
                    });

                    // Update preview gambar jika ada perubahan
                    if (response.file_ktm_url) {
                        $('#editDokumenForm').find('img[alt="Foto KTM"]').attr('src',
                            response.file_ktm_url);
                    }
                    if (response.file_ktp_url) {
                        $('#editDokumenForm').find('img[alt="Foto KTP"]').attr('src',
                            response.file_ktp_url);
                    }
                    if (response.file_pas_foto_url) {
                        $('#editDokumenForm').find('img[alt="Pas Foto"]').attr('src',
                            response.file_pas_foto_url);
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error:", xhr.responseText, status, error);

                    // Close loading dialog
                    Swal.close();

                    var errors = xhr.responseJSON?.errors;
                    var errorMessage = xhr.responseJSON?.message ||
                        'Terjadi kesalahan saat menyimpan perubahan';

                    if (errors) {
                        // Build error message with all validation errors
                        var errorList = '';
                        $.each(errors, function(key, value) {
                            errorList += '<li>' + value + '</li>';
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal menyimpan',
                            html: '<ul style="text-align: left;">' + errorList +
                                '</ul>',
                            confirmButtonText: 'Kembali'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal menyimpan',
                            text: errorMessage,
                            confirmButtonText: 'Kembali'
                        });
                    }
                }
            });
        });

        // Preview gambar sebelum upload
        $('input[type="file"]').on('change', function() {
            var input = this;
            var container = $(this).closest('.card-body').find('.img-thumbnail-container');

            if (input.files && input.files[0]) {
                // Validate file size (max 2MB)
                if (input.files[0].size > 2 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File terlalu besar',
                        text: 'Ukuran file maksimal 2MB',
                        confirmButtonText: 'Mengerti'
                    });
                    $(this).val(''); // Clear the file input
                    return;
                }

                // Validate file type
                var validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                if (!validTypes.includes(input.files[0].type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format tidak didukung',
                        text: 'Hanya menerima file JPEG, PNG, JPG, atau GIF',
                        confirmButtonText: 'Mengerti'
                    });
                    $(this).val(''); // Clear the file input
                    return;
                }

                var reader = new FileReader();

                reader.onload = function(e) {
                    container.html(
                        '<img src="' + e.target.result +
                        '" class="img-thumbnail" style="max-width: 150px;">'
                    );
                }

                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
