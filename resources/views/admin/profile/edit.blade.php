<!-- Edit Profil -->
<div class="tab-pane fade" id="editProfile" role="tabpanel" aria-labelledby="editProfile-tab">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Edit Profil</h5>
        </div>
        <div class="card-body">
            <form id="editProfileForm">
                @auth
                    @if (auth()->user()->admin)
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ auth()->user()->admin->admin_nama }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ auth()->user()->admin->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ auth()->user()->admin->no_telp }}">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="{{ auth()->user()->admin->alamat }}">
                        </div>
                        {{-- <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{ auth()->user()->admin->username }}">
                        </div> --}}
                        <div class="mb-3">
                            <label for="foto_profil" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" id="foto_profil" name="foto_profil" accept="image/*">
                            <small class="text-muted">Format: JPEG, PNG, JPG, GIF (max 2MB)</small>
                            <div class="mt-2">
                                @if (auth()->user()->admin->foto_profil)
                                    <img src="{{ asset('storage/profile_pictures/' . auth()->user()->admin->foto_profil) }}"
                                        alt="Foto Profil" class="img-thumbnail" style="max-width: 150px;">
                                @endif
                            </div>
                        </div>
                    @endif
                @endauth
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <div id="profileMessage" class="mt-3"></div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        console.log("jQuery loaded"); // Debugging

        // Handle profile form submission
        $('#editProfileForm').on('submit', function(e) {
            e.preventDefault();
            console.log("Form submitted"); // Debugging

            $.ajax({
                url: '{{ route('admin.profile.update') }}',
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log("Success:", response);
                    $('#profileMessage').html(
                        '<div class="alert alert-success">' + response.message +
                        '</div>'
                    ).show();
                    setTimeout(function() {
                        $('#profileMessage').fadeOut();
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    console.log("Error:", xhr.responseText, status, error);
                    var errors = xhr.responseJSON?.errors;
                    var errorMessage = xhr.responseJSON?.message || 'Terjadi kesalahan';

                    var errorHtml = '<div class="alert alert-danger">';
                    if (errors) {
                        errorHtml += '<ul>';
                        $.each(errors, function(key, value) {
                            errorHtml += '<li>' + value + '</li>';
                        });
                        errorHtml += '</ul>';
                    } else {
                        errorHtml += errorMessage;
                    }
                    errorHtml += '</div>';

                    $('#profileMessage').html(errorHtml).show();
                }
            });
        });

        // Handle profile picture upload
        $('#foto_profil').on('change', function() {
            var formData = new FormData();
            formData.append('foto_profil', this.files[0]);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            $.ajax({
                url: '{{ route('admin.profile.update_picture') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'success') {
                        // Update the profile picture preview
                        $('.profile-picture img').attr('src', response.image_url);
                        $('.img-thumbnail').attr('src', response.image_url);

                        // Show success message
                        $('#profileMessage').html(
                            '<div class="alert alert-success">' + response.message +
                            '</div>'
                        ).show();

                        setTimeout(function() {
                            $('#profileMessage').fadeOut();
                        }, 3000);
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON?.message ||
                        'Terjadi kesalahan saat mengupload foto';
                    $('#profileMessage').html(
                        '<div class="alert alert-danger">' + errorMessage + '</div>'
                    ).show();
                }
            });
        });
    });
</script>
