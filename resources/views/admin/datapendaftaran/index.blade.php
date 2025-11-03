@extends('layouts_admin.template')

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
        <!-- Tabel Pendaftaran Mahasiswa -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Data Pendaftaran Mahasiswa</h6>
                        <div class="float-right">
                            <button class="btn btn-outline-success btn-sm"
                                onclick="window.location.href='{{ route('admin.pendaftaran.export') }}'">
                                <i class="fas fa-download"></i> Export Data
                            </button>
                            {{-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahPendaftaranModal">
                                <i class="fas fa-plus mr-1"></i> Tambah Data
                            </button> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="table_pendaftaran" width="100%" cellspacing="0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">No</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">NIM</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Nama</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Program Studi</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Tanggal Pendaftaran</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Status</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editPendaftaranModal" tabindex="-1" role="dialog" aria-labelledby="editPendaftaranLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formEditPendaftaran">
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pendaftaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_mahasiswa_id">Mahasiswa</label>
                            <select class="form-control" id="edit_mahasiswa_id" name="mahasiswa_id" required>
                                <option value="">Pilih Mahasiswa</option>
                                <option value="1">John Doe</option>
                                <option value="2">Jane Smith</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_tanggal_pendaftaran">Tanggal Pendaftaran</label>
                            <input type="date" class="form-control" id="edit_tanggal_pendaftaran" name="tanggal_pendaftaran" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_jadwal_id">Jadwal</label>
                            <select class="form-control" id="edit_jadwal_id" name="jadwal_id" required>
                                <option value="">Pilih Jadwal</option>
                                <option value="1">Jadwal 1</option>
                                <option value="2">Jadwal 2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_status_id">Status</label>
                            <select class="form-control" id="edit_status_id" name="status_id" required>
                                <option value="">Pilih Status</option>
                                <option value="1">Belum Bayar</option>
                                <option value="2">Sudah Bayar</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Container untuk Delete -->
    <div id="deleteModalContainer"></div>

    <!-- Modal Container -->
    <div class="modal fade" id="modalContainer" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="modalContent">
                <!-- Konten modal akan dimuat di sini -->
            </div>
        </div>
    </div>

    <!-- Include CSS dan JS eksternal -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@push('js')
    <script>
        $(document).on('click', '[data-dismiss="modal"]', function() {
            $('#modalContainer').modal('hide');
        });
    </script>

    <script>
        function modalAction(url) {
            $('#modalContent').html('<div class="text-center p-5">Memuat data...</div>');
            $('#modalContainer').modal('show');
            $.get(url, function(res) {
                $('#modalContent').html(res);
            }).fail(function() {
                $('#modalContainer').modal('hide');
                Swal.fire('Error', 'Gagal memuat data detail.', 'error');
            });
        }
    </script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        var dataPendaftaran = $('#table_pendaftaran').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('admin/pendaftaran/list') }}",
                "dataType": "json",
                "type": "POST"
            },
            columns: [{
                data: "DT_RowIndex",
                className: "text-center",
                orderable: false,
                searchable: false
            }, {
                data: "mahasiswa.mahasiswa_nim",
                className: "",
                orderable: true,
                searchable: true
            }, {
                data: "mahasiswa.mahasiswa_nama",
                className: "",
                orderable: true,
                searchable: true
            }, {
                data: "mahasiswa.prodi.prodi_nama",
                className: "",
                orderable: false,
                searchable: false
            }, {
                data: "tanggal_pendaftaran",
                className: "",
                orderable: false,
                searchable: false
            }, {
                data: "status.status_nama",
                className: "",
                orderable: false,
                searchable: false,
            }, {
                data: "aksi",
                className: "",
                orderable: false,
                searchable: false
            }]
        });
    });

    // Fungsi untuk menampilkan modal delete
    function showDeleteModal(id) {
        // Hapus modal sebelumnya jika ada
        $('#deleteModalContainer').empty();
        
        // Load konten modal
        $.get('/admin/pendaftaran/delete_ajax/' + id, function(response) {
            $('#deleteModalContainer').html(response);
            $('#deleteConfirmationModal').modal('show');
        }).fail(function() {
            Swal.fire('Error', 'Gagal memuat form konfirmasi hapus', 'error');
        });
    }

    // Event handler untuk tombol close modal (gunakan event delegation)
    $(document).on('click', '[data-dismiss="modal"]', function() {
        $(this).closest('.modal').modal('hide');
    });

    // Handle submit form delete
    $(document).on('submit', '#formDeletePendaftaran', function(e) {
        e.preventDefault();
        var form = $(this);
        
        $.ajax({
            url: form.attr('action'),
            type: 'DELETE',
            data: form.serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    $('#deleteConfirmationModal').modal('hide');
                    $('#table_pendaftaran').DataTable().ajax.reload(null, false);
                    Swal.fire('Sukses', response.message, 'success');
                } else {
                    Swal.fire('Gagal', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Gagal', 'Terjadi kesalahan pada server.', 'error');
            }
        });
    });
</script>
@endpush