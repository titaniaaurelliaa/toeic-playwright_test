<form id="formKampus">
    @csrf
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Tambah Data Kampus</h5>
                <button type="button" class="close text-white" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="kampus_nama">Nama Kampus</label>
                    <input type="text" name="kampus_nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="kampus_alamat">Alamat</label>
                    <textarea name="kampus_alamat" class="form-control" required></textarea>
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
    $('#formKampus').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('admin.kampus.store_ajax') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(res) {
                if (res.status) {
                    $('#myModal').modal('hide');
                    dataKampus.ajax.reload(null, false);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: res.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: res.message
                    });
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let message = '';
                for (let field in errors) {
                    message += `${errors[field][0]}\n`;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    text: message
                });
            }
        });
    });
</script>
