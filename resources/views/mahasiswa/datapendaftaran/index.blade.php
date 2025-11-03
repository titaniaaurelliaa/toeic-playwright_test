@extends('layouts_mahasiswa.template')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Data Pendaftaran Mahasiswa</h6>
                        <button class="btn btn-primary btn-sm"
                            onclick="modalAction('{{ route('mahasiswa.pendaftaran.create_ajax') }}')">
                            <i class="fas fa-plus mr-1"></i> Tambah Data
                        </button>
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
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fungsi untuk modal detail/edit
        function modalAction(url) {
            $.ajax({
                url: url,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Memuat data',
                        html: 'Sedang memproses...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                },
                success: function(response) {
                    Swal.close();

                    // Hapus modal sebelumnya
                    $('body').find('#detailModal').remove();
                    $('body').find('#editModal').remove();

                    // Tambahkan modal baru
                    $('body').append(response);

                    // Tampilkan modal
                    if (url.includes('show_ajax')) {
                        $('#detailModal').modal('show');
                    } else {
                        $('#editModal').modal('show');
                    }

                    // Handle close button
                    $('.modal').on('click', '[data-dismiss="modal"]', function() {
                        $(this).closest('.modal').modal('hide');
                    });

                    // Auto remove ketika modal ditutup
                    $('.modal').on('hidden.bs.modal', function() {
                        $(this).remove();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data'
                    });
                    console.error(xhr);
                }
            });
        }

        // Fungsi untuk konfirmasi delete
        function deleteConfirm(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Menghapus',
                                html: 'Sedang memproses...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            });
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.success,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            $('#table_pendaftaran').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: xhr.responseJSON?.error || 'Gagal menghapus data'
                            });
                        }
                    });
                }
            });
        }

        // Inisialisasi DataTable
        $(document).ready(function() {
            $('#table_pendaftaran').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ route('mahasiswa.pendaftaran.list') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "mahasiswa.mahasiswa_nim",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "mahasiswa.mahasiswa_nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "mahasiswa.prodi.prodi_nama",
                        className: "",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "tanggal_pendaftaran",
                        className: "",
                        render: function(data) {
                            return new Date(data).toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            });
                        }
                    },
                    {
                        data: "status.status_nama",
                        className: "",
                        render: function(data) {
                            var badgeClass = 'badge-';
                            if (data === 'Diterima') {
                                badgeClass += 'success';
                            } else if (data === 'Ditolak') {
                                badgeClass += 'danger';
                            } else {
                                badgeClass += 'warning';
                            }
                            return '<span class="badge ' + badgeClass + '">' + (data || '-') +
                                '</span>';
                        }
                    },
                    {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
