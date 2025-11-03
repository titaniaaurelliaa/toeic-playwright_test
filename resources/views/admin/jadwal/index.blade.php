@extends('layouts_admin.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Jadwal Ujian</h6>
                        <button class="btn btn-primary btn-sm" onclick="modalAction('{{ route('admin.jadwal.create_ajax') }}')">
                            <i class="fas fa-plus mr-1"></i> Tambah Jadwal
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="table_jadwal" width="100%" cellspacing="0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0">No</th>
                                        <th class="border-0">Tanggal Pelaksanaan</th>
                                        <th class="border-0">Jam Pelaksanaan</th>
                                        <th class="border-0">Total Kuota</th>
                                        <th class="border-0">Sisa Kuota</th>
                                        <th class="border-0">Aksi</th>
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
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    function modalAction(url) {
        $('#myModal').modal('hide').find('.modal-content').empty();
        
        $.get(url)
            .done(function(response) {
                $('#myModal .modal-content').html(response);
                $('#myModal').modal('show');
            })
            .fail(function() {
                alert('Gagal memuat formulir');
            });
    }

    // untuk modal close
    function closeModal() {
        $('#myModal').modal('hide');
    }

    var dataJadwal;
    $(document).ready(function() {
        dataJadwal = $('#table_jadwal').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ route('admin.jadwal.list') }}",
                type: "POST"
            },
            columns: [
                { data: "DT_RowIndex", orderable: false, searchable: false },
                { data: "tanggal_pelaksanaan" },
                { data: "jam_pelaksanaan" },
                { data: "kuota", className: "text-center" },
                { data: "kuota_tersisa", className: "text-center" },
                { 
                    data: "id", 
                    render: function(data) {
                        return `
                            <button class="btn btn-sm btn-outline-warning mr-1" 
                                onclick="modalAction('{{ route('admin.jadwal.edit_ajax', '') }}/${data}')">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-outline-danger" 
                                onclick="deleteConfirm('{{ route('admin.jadwal.delete_ajax', '') }}/${data}')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        `;
                    },
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
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if(res.status) {
                            dataJadwal.ajax.reload();
                            Swal.fire('Berhasil!', res.message, 'success');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            xhr.responseJSON?.message || 'Terjadi kesalahan',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
@endpush