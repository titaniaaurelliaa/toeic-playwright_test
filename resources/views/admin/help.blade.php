@extends('layouts_admin.template')

@section('content')
<div class="container-fluid">
    <div id="helpAccordion" class="accordion">
        <!-- Question 1 -->
        <div class="card mb-2">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link font-weight-bold text-dark collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    1. Bagaimana cara ubah password akun saya?
                    </button>
                </h5>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#helpAccordion">
                <div class="card-body">
                    <p>Anda dapat mengubah password melalui:</p>
                    <ol>
                        <li>Buka menu "Profile" di dashboard</li>
                        <li>Pilih "Edit Profile"</li>
                        <li>Scroll ke bagian "Ubah Password"</li>
                        <li>Masukkan password lama dan baru</li>
                        <li>Klik tombol "Simpan"</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Question 2 -->
        <div class="card mb-2">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link font-weight-bold text-dark collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    2. Bagaimana cara kelola data mahasiswa?
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#helpAccordion">
                <div class="card-body">
                    <p>Anda dapat mengelola data mahasiswa melalui :</p>
                    <ol>
                        <li>Buka menu "Data Mahasiswa" di dashboard</li>
                        <li>Pilih "Tambah Data" untuk menambah mahasiswa baru</li>
                        <li>Isi form yang tersedia dan klik "Simpan"</li>
                        <li>Untuk mengedit atau menghapus data, pilih mahasiswa yang diinginkan dan klik tombol yang sesuai</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Question 3 -->
        <div class="card mb-2">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link font-weight-bold text-dark collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    3. Bagaimana kelola jadwal & kuota pelaksanaan ujian?
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#helpAccordion">
                <div class="card-body">
                    <p>Anda dapat mengelola jadwal & kuota pelaksanaan ujian melalui:</p>
                    <ol>
                        <li>Buka menu "Jadwal & Kuota" di dashboard</li>
                        <li>Pilih "Tambah Jadwal" untuk menambah jadwal baru</li>
                        <li>Isi form yang tersedia dan klik "Simpan"</li>
                        <li>Untuk mengedit atau menghapus jadwal, pilih jadwal yang diinginkan dan klik tombol yang sesuai</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Question 4 -->
        <div class="card mb-2">
            <div class="card-header" id="headingFour">
                <h5 class="mb-0">
                    <button class="btn btn-link font-weight-bold text-dark collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    4. Bagaimana cara validasi data pendaftaran yang telah terinput?
                    </button>
                </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#helpAccordion">
                <div class="card-body">
                    <p>Anda dapat melakukan validasi data pendaftaran melalui:</p>
                    <ol>
                        <li>Buka menu "Data Pendaftaran" di dashboard</li>
                        <li>Pilih pendaftaran yang ingin divalidasi</li>
                        <li>Periksa data yang terinput</li>
                        <li>Klik tombol "Validasi" jika data sudah benar</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection