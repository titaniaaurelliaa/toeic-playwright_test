@extends('layouts_admin.template')

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
        <!-- Tabel Jurusan -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Data Jurusan</h6>
                        <button class="btn btn-primary btn-sm" onclick="modalAction('{{ url('admin/jurusan/create_ajax') }}')">
                            <i class="fas fa-plus mr-1"></i> Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="table_jurusan" width="100%" cellspacing="0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">No</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Kode Jurusan</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Nama Jurusan</th>
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

    <!-- Modal -->
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    function closeModal() {
        $('#myModal').modal('hide');
    }

    function storeJurusan() {
    let form = $('#formCreateJurusan')[0];
    let formData = new FormData(form); // pakai FormData biar aman untuk file (meski ini text)

    $.ajax({
        url: "{{ url('admin/jurusan/store_ajax') }}",  // ganti sesuai route store kamu
        type: 'POST',
        data: formData,
        processData: false,  // agar data tidak diubah jadi query string
        contentType: false,  // agar header multipart/form-data otomatis ter-set
        success: function(res) {
            if (res.status) {
                closeModal();
                dataJurusan.ajax.reload(null, false); // reload datatable tanpa reset page
                Swal.fire('Berhasil!', res.message, 'success');
            } else {
                Swal.fire('Gagal!', res.message, 'error');
            }
        },
        error: function(xhr) {
            let msg = 'Terjadi kesalahan saat menyimpan data.';
            if(xhr.responseJSON && xhr.responseJSON.message) {
                msg = xhr.responseJSON.message;
            }
            Swal.fire('Error!', msg, 'error');
        }
    });
    
}

function updateJurusan(id) {
    let form = $('#formEditJurusan')[0];
    let formData = new FormData(form);

    $.ajax({
        url: "/admin/jurusan/update_ajax/" + id,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(res) {
            if (res.status) {
                closeModal();
                dataJurusan.ajax.reload(null, false);
                Swal.fire('Berhasil!', res.message, 'success');
            } else {
                Swal.fire('Gagal!', res.message, 'error');
            }
        },
        error: function(xhr) {
            Swal.fire('Error!', 'Terjadi kesalahan saat memperbarui data.', 'error');
        }
    });
}

    var dataJurusan;
    $(document).ready(function() {
        dataJurusan = $('#table_jurusan').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ url('admin/jurusan/list') }}",
                type: "POST"
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "jurusan_kode"
                },
                {
                    data: "jurusan_nama"
                },
                {
                    data: "aksi",
                    orderable: false,
                    searchable: false
                }
            ]
        });
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
                            dataJurusan.ajax.reload(null, false);
                            Swal.fire('Berhasil!', res.message, 'success');
                        } else {
                            Swal.fire('Gagal!', res.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
