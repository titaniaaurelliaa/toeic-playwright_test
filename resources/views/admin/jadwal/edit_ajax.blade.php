<form id="formEditJadwal" action="{{ route('admin.jadwal.update_ajax', $jadwal->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="modal-content">
        <div class="modal-header bg-warning text-dark">
            <h5 class="modal-title">Edit Data Jadwal</h5>
            <button type="button" class="close" onclick="closeModal()" style="color: white;">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="edit_id" value="{{ $jadwal->id }}">
            
            <div class="form-group">
                <label for="edit_tanggal">Tanggal Ujian <span class="text-danger">*</span></label>
                <input type="datetime-local" name="tanggal" id="edit_tanggal" 
                       value="{{ date('Y-m-d\TH:i', strtotime($jadwal->tanggal)) }}" 
                       class="form-control" required>
                <small class="text-danger" id="error-edit-tanggal"></small>
            </div>
            
            <div class="form-group">
                <label for="edit_kuota">Kuota Peserta <span class="text-danger">*</span></label>
                <input type="number" name="kuota" id="edit_kuota" 
                       value="{{ $jadwal->kuota }}" 
                       class="form-control" min="1" required>
                <small class="text-danger" id="error-edit-kuota"></small>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" onclick="closeModal()">Batal</button>
            <button type="submit" class="btn btn-outline-success">Perbarui</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#formEditJadwal').on('submit', function(e) {
            e.preventDefault();
            
            $('.text-danger').text('');

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: $(this).serialize(),
                success: function(res) {
                    if (res.status) {
                        $('#myModal').modal('hide');
                        dataJadwal.ajax.reload(null, false);
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
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        for (let field in errors) {
                            $(`#error-edit-${field}`).text(errors[field][0]);
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan pada server'
                        });
                    }
                }
            });
        });
    });
</script>