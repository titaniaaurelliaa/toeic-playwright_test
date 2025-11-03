<form id="formEditProdi">
    @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title">Edit Data Prodi</h5>
                <button type="button" class="close" onclick="closeModal()" style="color: rgb(0, 0, 0);">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="prodi_kode">Kode Prodi</label>
                    <input type="text" name="prodi_kode" class="form-control" value="{{ $data->prodi_kode }}" required>
                </div>
                <div class="form-group">
                    <label for="prodi_nama">Nama Prodi</label>
                    <input type="text" name="prodi_nama" class="form-control" value="{{ $data->prodi_nama }}" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal()" class="btn btn-outline-danger">Batal</button>
                <button type="button" onclick="updateProdi({{ $data->id }})" class="btn btn-outline-success">Perbarui</button>
            </div>
        </div>
    </div>
</form>
