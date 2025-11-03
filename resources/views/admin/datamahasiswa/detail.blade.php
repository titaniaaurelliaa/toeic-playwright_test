<!-- Modal Detail Mahasiswa -->
<div class="modal-header bg-primary text-white">
    <h5 class="modal-title">
        <i class="fas fa-user-graduate me-2"></i> Detail Mahasiswa
    </h5>
    <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row mb-4">
        <div class="col-md-3 text-center">
            <div class="avatar-placeholder bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2rem;">
                {{ strtoupper(substr($mahasiswa->mahasiswa_nama, 0, 1)) }}
            </div>
        </div>
        <div class="col-md-9">
            <h4 class="mb-1">{{ $mahasiswa->mahasiswa_nama }}</h4>
            <p class="text-muted mb-2">{{ $mahasiswa->mahasiswa_nim }}</p>
            <span class="badge">{{ $mahasiswa->prodi->prodi_nama ?? 'Belum ada prodi' }}</span>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-light">
            <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i> Informasi Pribadi</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small mb-1">Alamat</label>
                    <p class="mb-0">{{ $mahasiswa->alamat ?? '-' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small mb-1">No. Telepon</label>
                    <p class="mb-0">{{ $mahasiswa->no_telp ?? '-' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small mb-1">Email</label>
                    <p class="mb-0">{{ $mahasiswa->email ?? '-' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small mb-1">Status</label>
                    <p class="mb-0">
                        <span class="badge bg-success">Aktif</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times me-1"></i> Tutup
        </button>
        <div>
            <button type="button" onclick="resetPassword({{ $mahasiswa->id }})" class="btn btn-danger">
                <i class="fas fa-key me-1"></i> Reset Password
            </button>
        </div>
    </div>
</div>

@push('js')
<script>
    // Fungsi untuk mereset password mahasiswa dengan SweetAlert
    function resetPassword(id) {
        Swal.fire({
            title: 'Reset Password?',
            text: "Password akan direset ke default (12345)",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Reset!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/mahasiswa/' + id + '/reset_password',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire(
                            'Berhasil!',
                            response.message,
                            'success'
                        );
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan: ' + xhr.responseText,
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
@endpush