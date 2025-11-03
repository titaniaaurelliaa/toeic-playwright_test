<!-- change password -->
<div class="tab-pane fade" id="changePassword" role="tabpanel" aria-labelledby="changePassword-tab">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Ubah Password</h5> <!-- Judul diperbaiki -->
        </div>
        <div class="card-body">
            <form id="changePasswordForm" data-action="{{ route('admin.profile.change_password') }}">
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
                <button type="submit" class="btn btn-SUCCESS" id="submitBtn">Ubah Password</button>
                <div id="passwordMessage" class="mt-3"></div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#changePasswordForm').submit(function(e) {
            e.preventDefault();
            const btn = $('#submitBtn');
            const form = $(this);

            btn.prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...'
                );

            // Clear previous errors
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('').hide();

            $.ajax({
                url: form.data('action'), // Menggunakan data-action dari form
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    $('#passwordMessage').html(
                        '<div class="alert alert-success">' + response.message +
                        '</div>'
                    ).show();
                    form[0].reset();
                },
                error: function(xhr) {
                    let errorHtml = '<div class="alert alert-danger">';

                    if (xhr.status === 422) {
                        // Validation errors
                        const errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            const field = $('#' + key);
                            const errorDiv = $('#' + key + '_error');

                            field.addClass('is-invalid');
                            errorDiv.text(value[0]).show();
                        });
                        errorHtml += 'Terdapat kesalahan pada inputan';
                    } else {
                        // Other errors
                        errorHtml += xhr.responseJSON?.message ||
                        'Terjadi kesalahan server';
                    }

                    errorHtml += '</div>';
                    $('#passwordMessage').html(errorHtml).show();
                },
                complete: function() {
                    btn.prop('disabled', false).html('Ubah Password');
                    setTimeout(function() {
                        $('#passwordMessage').fadeOut();
                    }, 5000);
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
