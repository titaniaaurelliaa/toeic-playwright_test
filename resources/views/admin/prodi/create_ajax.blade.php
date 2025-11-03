<form id="formCreateProdi">
    @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Tambah Data Prodi</h5>
                <button type="button" class="close" onclick="closeModal()" style="color: white;">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="prodi_kode">Kode Prodi</label>
                    <input type="text" name="prodi_kode" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="prodi_nama">Nama Prodi</label>
                    <input type="text" name="prodi_nama" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal()" class="btn btn-outline-danger">Batal</button>
                <button type="button" onclick="storeProdi()" class="btn btn-outline-success">Simpan</button>
            </div>
        </div>
    </div>
</form>
