<!-- Change Password -->
<div class="tab-pane fade" id="changePassword" role="tabpanel" aria-labelledby="changePassword-tab">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Ubah Password</h5>
        </div>
        <div class="card-body">
            <form id="changePasswordForm" data-action="{{ route('mahasiswa.profile.change_password') }}">
                @csrf
                <div class="mb-3">
                    <label for="current_password" class="form-label">Password Saat Ini</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                    <div class="invalid-feedback" id="current_password_error"></div>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">Password Baru</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                    <div class="invalid-feedback" id="new_password_error"></div>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    <div class="invalid-feedback" id="confirm_password_error"></div>
                </div>
                <button type="submit" class="btn btn-primary" id="submitBtn">Ubah Password</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#changePasswordForm').submit(function(e) {
            e.preventDefault();
            const btn = $('#submitBtn');
            const form = $(this);

            // Show loading indicator
            Swal.fire({
                title: 'Memproses perubahan password',
                html: 'Harap tunggu...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Clear previous errors
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('').hide();

            $.ajax({
                url: form.data('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                    form[0].reset();
                },
                error: function(xhr) {
                    // Close loading dialog
                    Swal.close();

                    if (xhr.status === 422) {
                        // Validation errors
                        const errors = xhr.responseJSON.errors;

                        // Show general error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal',
                            text: 'Terdapat kesalahan pada inputan',
                            confirmButtonText: 'Mengerti'
                        });

                        // Highlight specific fields
                        $.each(errors, function(key, value) {
                            const field = $('#' + key);
                            const errorDiv = $('#' + key + '_error');

                            field.addClass('is-invalid');
                            errorDiv.text(value[0]).show();
                        });
                    } else {
                        // Other errors
                        const errorMessage = xhr.responseJSON?.message ||
                            'Terjadi kesalahan saat mengubah password';

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Mengubah Password',
                            text: errorMessage,
                            confirmButtonText: 'Mengerti'
                        });
                    }
                },
                complete: function() {
                    btn.prop('disabled', false).html('Ubah Password');
                }
            });
        });

        // Clear validation when typing
        $('input').on('input', function() {
            $(this).removeClass('is-invalid');
            $('#' + $(this).attr('name') + '_error').text('').hide();
        });
    });
</script>
