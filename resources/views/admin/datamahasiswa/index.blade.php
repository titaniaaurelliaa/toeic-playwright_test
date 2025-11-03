@extends('layouts_admin.template')

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
        <!-- Tabel Mahasiswa -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
                        <div class="float-right">
                            <!-- Tombol untuk membuka modal -->
                            <button class="btn btn-outline-success btn-sm" onclick="openImportModal()">
                                <i class="fas fa-upload"></i> Import Data
                            </button>

                            {{-- <button class="btn btn-primary btn-sm"
                                onclick="modalAction('{{ url('admin/mahasiswa/create_ajax') }}')">
                                <i class="fas fa-plus mr-1"></i> Tambah Data
                            </button> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="row mb-3">
                                {{-- <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="filter_prodi">Program Studi</label>
                                        <select class="form-control" id="filter_prodi" name="filter_prodi">
                                            <option value="">Semua Prodi</option>
                                            @foreach ($prodi as $p)
                                                <option value="{{ $p->id }}">{{ $p->prodi_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="filter_jurusan">Filter</label>
                                        <select class="form-control" id="filter_jurusan" name="filter_jurusan">
                                            <option value="">Semua Jurusan</option>
                                            @foreach ($jurusan as $j)
                                                <option value="{{ $j->id }}">{{ $j->jurusan_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="filter_kampus">Kampus</label>
                                        <select class="form-control" id="filter_kampus" name="filter_kampus">
                                            <option value="">Semua Kampus</option>
                                            @foreach ($kampus as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama_kampus }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                            </div>
                            <table class="table table-borderless" id="table_mahasiswa" width="100%" cellspacing="0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">No</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">NIM</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Nama</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Alamat</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">No. Telepon</th>
                                        {{-- <th class="border-0 font-weight-bold text-gray-700 py-3">Email</th> --}}
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Program Studi</th>
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
    <!-- Modal Detail -->
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalDetailContent">
                <!-- Konten detail dimuat di sini -->
            </div>
        </div>
    </div>

    <!-- Modal untuk Upload File -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Mahasiswa</h5>
                    <button type="button" class="close" onclick="closeImportModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- FORM Upload -->
                <form id="importForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">Pilih File Excel (.xls / .xlsx)</label>
                            <input type="file" name="file" id="file" class="form-control" accept=".xls,.xlsx"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeImportModal()">Batal</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Include CSS dan JS eksternal -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>


    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
    <script>
        // Fungsi untuk membuka modal import
        function openImportModal() {
            $('#importModal').modal('show');
        }

        // Fungsi untuk mengirimkan file menggunakan AJAX
        $('#importForm').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: '{{ route('admin.mahasiswa.import') }}', // Rute untuk import data
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status) {
                        Swal.fire('Berhasil!', response.message, 'success');
                        $('#importModal').modal('hide');
                        $('#table_mahasiswa').DataTable().ajax.reload();
                    } else {
                        Swal.fire('Gagal!', response.message, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire('Terjadi kesalahan!', 'Gagal mengimpor data', 'error');
                }
            });
        });

        // Tampilkan modal detail
        function showDetail(id) {
            $.get('/admin/mahasiswa/' + id + '/show_ajax', function(response) {
                $('#modalDetailContent').html(response);
                $('#modalDetail').modal('show');
            });
        }

        // Menutup modal secara manual jika perlu
        $(document).on('click', '[data-dismiss="modal"]', function() {
            $('#importModal').modal('hide');
        });

        // Reset password mahasiswa
        function resetPassword(id) {
            // SweetAlert konfirmasi
            Swal.fire({
                title: 'Yakin ingin reset password?',
                text: "Password akan direset ke 12345!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, reset!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                // Jika user menekan tombol 'Ya, reset!'
                if (result.isConfirmed) {
                    // Melakukan AJAX POST ke server untuk reset password
                    $.post('/admin/mahasiswa/' + id + '/reset_password', {
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token untuk keamanan
                    }, function(response) {
                        // Menampilkan pesan sukses setelah reset password
                        Swal.fire({
                            title: 'Password berhasil direset!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    }).fail(function(xhr) {
                        // Menangani jika terjadi kesalahan
                        Swal.fire({
                            title: 'Terjadi kesalahan!',
                            text: xhr.responseText,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
                }
            });
        }


        // ------ UNTUK DATATABLES ------
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        function closeModal() {
            $('#myModal').modal('hide');
        }

        var dataMahasiswa;
        $(document).ready(function() {
            dataMahasiswa = $('#table_mahasiswa').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('admin/mahasiswa/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.kampus_id = $('#filter_kampus').val(); // filter kampus
                        d.jurusan_id = $('#filter_jurusan').val();
                        d.prodi_id = $('#filter_prodi').val();
                    }
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "mahasiswa_nim",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "mahasiswa_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "alamat",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "no_telp",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "prodi.prodi_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });

            // $('#filter_kampus').change(function() {
            //     $('#filter_jurusan').val('');
            //     $('#filter_prodi').val('');
            //     dataMahasiswa.ajax.reload();
            // });

            // Ketika jurusan berubah, update dropdown prodi
            $('#filter_jurusan').change(function() {
                var jurusanId = $(this).val();
                var $prodiSelect = $('#filter_prodi');

                // Reset dropdown prodi
                $prodiSelect.empty().append('<option value="">Semua Prodi</option>');

                if (jurusanId) {
                    // Jika jurusan dipilih, ambil prodi berdasarkan jurusan
                    $.get("{{ url('admin/prodi/by-jurusan') }}/" + jurusanId, function(data) {
                        $.each(data, function(key, value) {
                            $prodiSelect.append('<option value="' + value.id + '">' + value
                                .prodi_nama + '</option>');
                        });
                    });
                } else {
                    // Jika jurusan dikosongkan, isi dengan semua prodi
                    $.get("{{ url('admin/prodi/list') }}", function(data) {
                        $.each(data, function(key, value) {
                            $prodiSelect.append('<option value="' + value.id + '">' + value
                                .prodi_nama + '</option>');
                        });
                    });
                }

                // Reset nilai filter prodi dan reload tabel
                $prodiSelect.val('').trigger('change');
                dataMahasiswa.ajax.reload();
            });

            // // Ketika prodi berubah, reload tabel dengan parameter jurusan dan prodi
            // $('#filter_prodi').change(function() {
            //     dataMahasiswa.ajax.reload();
            // });
        });

        function deleteConfirm(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(res) {
                            if (res.status) {
                                $('#table_mahasiswa').DataTable().ajax.reload(null, false);
                                Swal.fire('Berhasil!', res.message, 'success');
                            } else {
                                Swal.fire('Gagal!', res.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data', 'error');
                        }
                    });
                }
            });
        }
    </script>

    <script>
        $('#form-edit').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let id = $('#mahasiswa_id').val(); // pastikan ada input hidden dengan ID ini

            $.ajax({
                url: '/admin/mahasiswa/update_ajax/' + id,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status) {
                        $('#myModal').modal('hide');
                        $('#table_mahasiswa').DataTable().ajax.reload();
                        alert(res.message);
                    } else {
                        if (res.msgField) {
                            let err = Object.values(res.msgField).map(item => item.join(', ')).join(
                                '\n');
                            alert('Validasi gagal:\n' + err);
                        } else {
                            alert('Gagal menyimpan data');
                        }
                    }
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat menyimpan');
                }
            });
        });
    </script>
@endpush
