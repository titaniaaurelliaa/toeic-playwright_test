<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="formDeletePendaftaran" method="POST"
            action="{{ route('admin.pendaftaran.destroy_ajax', $pendaftaran->id) }}">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus data pendaftaran berikut?</p>
                    <ul>
                        <li><strong>NIM:</strong> {{ $pendaftaran->mahasiswa->mahasiswa_nim }}</li>
                        <li><strong>Nama:</strong> {{ $pendaftaran->mahasiswa->mahasiswa_nama }}</li>
                        <li><strong>Tanggal:</strong> {{ $pendaftaran->tanggal_pendaftaran }}</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>
