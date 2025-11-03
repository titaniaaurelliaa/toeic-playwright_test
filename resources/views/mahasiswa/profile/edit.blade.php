@php
use App\Models\ProdiModel as Prodi;
use App\Models\JurusanModel as Jurusan;
use App\Models\KampusModel as Kampus;

$prodis = Prodi::all();
$jurusans = Jurusan::all();
$kampuses = Kampus::all();
@endphp

<!-- Edit Profil -->
<div class="tab-pane fade" id="editProfile" role="tabpanel" aria-labelledby="editProfile-tab">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Edit Profil</h5>
        </div>
        <div class="card-body">
            <form id="editProfileForm">
                @auth
                    @if (auth()->user()->mahasiswa)
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim"
                                value="{{ auth()->user()->mahasiswa->mahasiswa_nim }}" z>
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                value="{{ auth()->user()->mahasiswa->nik }}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ auth()->user()->mahasiswa->mahasiswa_nama }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ auth()->user()->mahasiswa->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                value="{{ auth()->user()->mahasiswa->no_telp }}">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="{{ auth()->user()->mahasiswa->alamat }}">
                        </div>
                        <div class="mb-3">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <select class="form-control" id="prodi_id" name="prodi_id">
                                @foreach ($prodis as $prodi)
                                    <option value="{{ $prodi->id }}"
                                        {{ auth()->user()->mahasiswa->prodi_id == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->prodi_nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan_id" class="form-label">Jurusan</label>
                            <select class="form-control" id="jurusan_id" name="jurusan_id">
                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}"
                                        {{ auth()->user()->mahasiswa->jurusan_id == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->jurusan_nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kampus_id" class="form-label">Kampus</label>
                            <select class="form-control" id="kampus_id" name="kampus_id">
                                @foreach ($kampuses as $kampus)
                                    <option value="{{ $kampus->id }}"
                                        {{ auth()->user()->mahasiswa->kampus_id == $kampus->id ? 'selected' : '' }}>
                                        {{ $kampus->kampus_nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="foto_profil" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" id="foto_profil" name="foto_profil" accept="image/*">
                            <small class="text-muted">Format: JPEG, PNG, JPG, GIF (max 2MB)</small>
                            <div class="mt-2">
                                {{-- @if (auth()->user()->mahasiswa->foto_profil)
                                    <img src="{{ asset('storage/profile_pictures/' . auth()->user()->mahasiswa->foto_profil) }}"
                                        alt="Foto Profil" class="img-thumbnail" style="max-width: 150px;">
                                @endif --}}
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Handle profile form submission
        $('#editProfileForm').on('submit', function(e) {
            e.preventDefault();

            // Tampilkan loading indicator
            Swal.fire({
                title: 'Menyimpan perubahan',
                html: 'Sedang memproses data...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Kirim data form
            $.ajax({
                url: '{{ route('mahasiswa.profile.update') }}',
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    var errorMessage = xhr.responseJSON?.message || 'Terjadi kesalahan';
                    var errors = xhr.responseJSON?.errors;

                    if (errors) {
                        var errorList = '';
                        $.each(errors, function(key, value) {
                            errorList += '<li>' + value + '</li>';
                        });
                        errorMessage = '<ul style="text-align:left">' + errorList + '</ul>';
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        html: errorMessage,
                        confirmButtonText: 'Tutup'
                    });
                }
            });
        });

        // Handle profile picture upload
        $('#foto_profil').on('change', function() {
            if (!this.files[0]) return;

            // Tampilkan loading indicator
            Swal.fire({
                title: 'Mengupload foto',
                html: 'Sedang memproses gambar...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            var formData = new FormData();
            formData.append('foto_profil', this.files[0]);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            $.ajax({
                url: '{{ route('mahasiswa.profile.update_picture') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'success') {
                        // Update the profile picture preview
                        $('.profile-picture img').attr('src', response.image_url);
                        $('.img-thumbnail').attr('src', response.image_url);

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr) {
                    var errorMessage = xhr.responseJSON?.message ||
                        'Terjadi kesalahan saat mengupload foto';

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: errorMessage,
                        confirmButtonText: 'Tutup'
                    });
                }
            });
        });

        // Preview gambar sebelum upload (opsional)
        $('#foto_profil').on('change', function() {
            var input = this;
            var imgPreview = $(this).siblings('.mt-2').find('img');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    if (imgPreview.length === 0) {
                        $(input).siblings('.mt-2').html(
                            '<img src="' + e.target.result +
                            '" class="img-thumbnail" style="max-width: 150px;">'
                        );
                    } else {
                        imgPreview.attr('src', e.target.result);
                    }
                }

                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
