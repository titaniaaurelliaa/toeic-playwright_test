<form id="formCreateJurusan" onsubmit="storeJurusan(); return false;">
    @csrf
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Tambah Data Jurusan</h5>
                <button type="button" class="close" onclick="closeModal()" style="color: white;">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="jurusan_kode">Kode Jurusan</label>
                    <input type="text" name="jurusan_kode" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jurusan_nama">Nama Jurusan</label>
                    <input type="text" name="jurusan_nama" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn btn-outline-success">Simpan</button>
            </div>
        </div>
    </div>
</form>

   