<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{ url('admin/mahasiswa/update_ajax/'.$mahasiswa->id) }}" method="POST" id="formEditMahasiswa">
            @csrf
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title">Edit Data Mahasiswa</h5>
                <button type="button" class="close" onclick="closeModal()" style="color: black">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control" value="{{ $mahasiswa->nik }}" required>
                </div>

                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" name="mahasiswa_nim" class="form-control" value="{{ $mahasiswa->mahasiswa_nim }}" required>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="mahasiswa_nama" class="form-control" value="{{ $mahasiswa->mahasiswa_nama }}" required>
                </div>

                <div class="form-group">
                    <label>Program Studi</label>
                    <select name="prodi_id" class="form-control" required>
                        @foreach ($prodi as $p)
                            <option value="{{ $p->id }}" {{ $mahasiswa->prodi_id == $p->id ? 'selected' : '' }}>
                                {{ $p->prodi_nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jurusan</label>
                    <select name="jurusan_id" class="form-control" required>
                        @foreach ($jurusan as $j)
                            <option value="{{ $j->id }}" {{ $mahasiswa->jurusan_id == $j->id ? 'selected' : '' }}>
                                {{ $j->jurusan_nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Kampus</label>
                    <select name="kampus_id" class="form-control" required>
                        @foreach ($kampus as $k)
                            <option value="{{ $k->id }}" {{ $mahasiswa->kampus_id == $k->id ? 'selected' : '' }}>
                                {{ $k->kampus_nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ $mahasiswa->alamat }}" required>
                </div>
                
                <div class="form-group">
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ $mahasiswa->no_telp }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $mahasiswa->email }}" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn btn-outline-warning">Perbarui</button>
            </div>
        </form>

        <script>
            $(document).ready(function() {
                $('#formEditMahasiswa').on('submit', function(e) {
                    e.preventDefault();
                    let form = $(this);
                    let url = form.attr('action');
                    let data = form.serialize();

                    $('.text-danger').text('');
            
                    $.post(url, data, function(res) {
                        if (res.status) {
                            $('#myModal').modal('hide');
                            $('#table_mahasiswa').DataTable().ajax.reload(null, false);
                            Swal.fire('Sukses!', res.message, 'success');
                        } else {
                            let msg = '';
                            if (res.msgField) {
                                for (const field in res.msgField) {
                                    msg += `${res.msgField[field].join('<br>')}<br>`;
                                }
                            } else {
                                msg = res.message;
                            }
            
                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal',
                                html: msg
                            });
                        }
                    }).fail(function() {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan data', 'error');
                    });
                });
            });
            </script>
            
    </div>
</div>
