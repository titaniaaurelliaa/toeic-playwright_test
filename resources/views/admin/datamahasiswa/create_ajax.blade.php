<form action="{{ url('/admin/mahasiswa/store_ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
                <button type="button" class="close" onclick="closeModal()"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mahasiswa_nim">NIM <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="mahasiswa_nim" name="mahasiswa_nim"
                                placeholder="Masukkan NIM" maxlength="10" required>
                            <small id="error-mahasiswa_nim" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="mahasiswa_nama">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="mahasiswa_nama" name="mahasiswa_nama"
                                placeholder="Masukkan nama lengkap" required>
                            <small id="error-mahasiswa_nama" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat" required></textarea>
                            <small id="error-alamat" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No. Telepon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="no_telp" name="noTelp"
                                placeholder="Masukkan nomor telepon" maxlength="15" required>
                            <small id="error-no_telp" class="error-text form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan email" required>
                            <small id="error-email" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Program Studi</label>
                            <select name="prodi_id" id="prodi_id" class="form-control" required>
                                <option value="">- Pilih Program Studi -</option>
                                {{-- @foreach ($prodi as $p)
                                    <option value="{{ $p->prodi_id }}">{{ $p->prodi_nama }}</option>
                                @endforeach --}}
                                <option value="1">1</option>
                            </select>
                            <small id="error-prodi_id" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="fileKTM">File KTM</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="fileKTM" name="fileKTM">
                                <label class="custom-file-label" for="fileKTM">Pilih file...</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fileKTP">File KTP</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="fileKTP" name="fileKTP">
                                <label class="custom-file-label" for="fileKTP">Pilih file...</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="filePasFoto">Pas Foto</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="filePasFoto" name="filePasFoto">
                                <label class="custom-file-label" for="filePasFoto">Pilih file...</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal()" class="btn btn-outline-danger">Batal</button>
                <button type="submit" class="btn btn-outline-success">Simpan</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-tambah").validate({
            rules: {
                mahasiswa_nim: {
                    required: true,
                    minlength: 3,
                    maxlength: 10
                },
                mahasiswa_nama: {
                    required: true,
                    maxlength: 100
                },
                alamat: {
                    required: true,
                    maxlength: 225
                },
                no_telp: {
                    required: true,
                    maxlength: 15
                },
                emai: {
                    required: true,
                    maxlength: 100
                },
                prodi_id: {
                    required: true,
                    number: true
                },
            },
            submitHandler: function(form) {
                $.ajax({
                    url: "/admin/mahasiswa/store_ajax",
                    type: "POST",
                    data: $("#form-mahasiswa").serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataUser.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
