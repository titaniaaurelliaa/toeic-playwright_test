<div class="modal-header">
    <h5 class="modal-title">Edit Pendaftaran Mahasiswa</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="formEditPendaftaran">
    @csrf
    <input type="hidden" name="id" value="{{ $pendaftaran->id }}">
    <div class="modal-body">
        <h6>Data Mahasiswa</h6>
        <div class="form-group">
            <label>NIM</label>
            <input type="text" class="form-control" name="mahasiswa_nim"
                value="{{ $pendaftaran->mahasiswa->mahasiswa_nim }}">
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="mahasiswa_nama"
                value="{{ $pendaftaran->mahasiswa->mahasiswa_nama }}">
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" name="alamat">{{ $pendaftaran->mahasiswa->alamat }}</textarea>
        </div>
        <div class="form-group">
            <label>No Telepon</label>
            <input type="text" class="form-control" name="no_telp" value="{{ $pendaftaran->mahasiswa->no_telp }}">
        </div>
        <div class="form-group">
            <label>NIK</label>
            <input type="text" class="form-control" name="nik" value="{{ $pendaftaran->mahasiswa->nik }}">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" value="{{ $pendaftaran->mahasiswa->email }}">
        </div>
        <div class="form-group">
            <label>Prodi</label>
            <select class="form-control" name="prodi_id">
                <option value="">-- Pilih Prodi --</option>
                @foreach ($prodi as $item)
                    <option value="{{ $item->id }}"
                        {{ $item->id == $pendaftaran->mahasiswa->prodi_id ? 'selected' : '' }}>
                        {{ $item->prodi_nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Jurusan</label>
            <select class="form-control" name="jurusan_id">
                <option value="">-- Pilih Jurusan --</option>
                @foreach ($jurusan as $item)
                    <option value="{{ $item->id }}"
                        {{ $item->id == $pendaftaran->mahasiswa->jurusan_id ? 'selected' : '' }}>
                        {{ $item->jurusan_nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Kampus</label>
            <select class="form-control" name="kampus_id">
                <option value="">-- Pilih Kampus --</option>
                @foreach ($kampus as $item)
                    <option value="{{ $item->id }}"
                        {{ $item->id == $pendaftaran->mahasiswa->kampus_id ? 'selected' : '' }}>
                        {{ $item->kampus_nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <hr>
        <h6>Data Pendaftaran</h6>
        <div class="form-group">
            <label>Tanggal Jadwal</label>
            <input type="datetime-local" class="form-control" name="tanggal"
                value="{{ \Carbon\Carbon::parse($pendaftaran->jadwal->tanggal)->format('Y-m-d\TH:i') }}">
        </div>
        <div class="form-group">
            <label>Tanggal Pendaftaran</label>
            <input type="datetime-local" class="form-control" name="tanggal_pendaftaran"
                value="{{ \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('Y-m-d\TH:i') }}">
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status_id">
                <option value="">-- Pilih Status --</option>
                @foreach ($status as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $pendaftaran->status_id ? 'selected' : '' }}>
                        {{ $item->status_nama }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
</form>

<script>
    $('#formEditPendaftaran').validate({
        rules: {
            mahasiswa_nim: {
                minlength: 3,
                maxlength: 10
            },
            mahasiswa_nama: {
                maxlength: 100
            },
            alamat: {
                maxlength: 225
            },
            no_telp: {
                maxlength: 15
            },
            nik: {
                maxlength: 15
            },
            email: {
                maxlength: 100
            },
            prodi_id: {
                number: true
            },
            jurusan_id: {
                number: true
            },
            kampus_id: {
                number: true
            },
            tanggal: {
                required: true,
                date: true
            },
            tanggal_pendaftaran: {
                date: true
            },
            status_id: {
                required: true,
                number: true
            },
        },
        submitHandler: function(form) {
            $.ajax({
                url: "{{ url('admin/pendaftaran/update') }}",
                type: "POST",
                data: $(form).serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        $('#modalContainer').modal('hide');
                        $('#table_pendaftaran').DataTable().ajax.reload(null, false);
                        Swal.fire('Sukses', response.message, 'success');
                    } else {
                        Swal.fire('Gagal', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Terjadi kesalahan server.', 'error');
                }
            });
        }
    });
</script>
