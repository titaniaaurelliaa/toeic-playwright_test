@extends('layouts_mahasiswa.template')

@section('content')
<div class="container-fluid">
    <div id="helpAccordion" class="accordion">
        <!-- Question 1 -->
        <div class="card mb-2">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link font-weight-bold text-dark" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    1. Bagaimana cara melengkapi data diri?
                    </button>
                </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#helpAccordion">
                <div class="card-body">
                    <p>Anda dapat melengkapi data diri melalui:</p>
                    <ol>
                        <li>Buka menu "Profile" di dashboard</li>
                        <li>Pilih "Edit Profile"</li>
                        <li>Isi form yang tersedia dengan data diri Anda</li>
                        <li>Pastikan semua data yang diisi sudah benar</li>
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
                    2. Bagaimana cara melengkapi dokumen pribadi?
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#helpAccordion">
                <div class="card-body">
                    <p>Anda dapat melengkapi dokumen pribadi melalui:</p>
                    <ol>
                        <li>Buka menu "Data Mahasiswa" di dashboard</li>
                        <li>Pilih "Tambah Data" untuk menambah mahasiswa baru</li>
                        <li>Isi form yang tersedia dan klik "Simpan"</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Question 3 -->
        <div class="card mb-2">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link font-weight-bold text-dark collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    3. Bagaimana cara ubah password akun saya?
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#helpAccordion">
                <div class="card-body">
                    <p>Anda dapat mengubah password akun melalui:</p>
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

        <!-- Question 4 -->
        <div class="card mb-2">
            <div class="card-header" id="headingFour">
                <h5 class="mb-0">
                    <button class="btn btn-link font-weight-bold text-dark collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    4. Bagaimana cara melakukan pendaftaran ujian TOEIC?
                    </button>
                </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#helpAccordion">
                <div class="card-body">
                    <p>Anda dapat melakukan pendaftaran ujian TOEIC melalui:</p>
                    <ol>
                        <li>Buka menu "Pendaftaran" di dashboard</li>
                        <li>Pilih "Daftar Ujian"</li>
                        <li>Isi form yang tersedia dengan data diri Anda</li>
                        <li>Klik tombol "Daftar Ujian"</li>
                        <li>Periksa email Anda untuk konfirmasi pendaftaran</li>
                        <li>Jika ada masalah, hubungi admin melalui menu "Bantuan"</li>
                        <li>Pastikan semua data yang diisi sudah benar</li>
                        <li>Klik tombol "Simpan"</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Question 5 -->
        <div class="card mb-2">
            <div class="card-header" id="headingFive">
                <h5 class="mb-0">
                    <button class="btn btn-link font-weight-bold text-dark collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    5. Bagaimana cara melihat jadwal ujian TOEIC?
                    </button>
                </h5>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#helpAccordion">
                <div class="card-body">
                    <p>Anda dapat melihat jadwal ujian TOEIC melalui:</p>
                    <ol>
                        <li>Buka menu "Jadwal" di dashboard</li>
                        <li>Pilih "Lihat Jadwal Ujian"</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Question 6 -->
        <div class="card mb-2">
            <div class="card-header" id="headingSix">
                <h5 class="mb-0">
                    <button class="btn btn-link font-weight-bold text-dark collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    6. Bagaimana cara proses pendaftaran ujian TOEIC bagi pendaftaran pertama?
                    </button>
                </h5>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#helpAccordion">
                <div class="card-body">
                    <p>Anda dapat melakukan proses pendaftaran ujian TOEIC bagi pendaftaran pertama melalui:</p>
                    <ol>
                        <li>Buka menu "Pendaftaran" di dashboard</li>
                        <li>Pilih "Daftar Ujian"</li>
                        <li>Isi form yang tersedia dengan data diri Anda</li>
                        <li>Klik tombol "Daftar Ujian"</li>
                        <li>Periksa email Anda untuk konfirmasi pendaftaran</li>
                        <li>Jika ada masalah, hubungi admin melalui menu "Bantuan"</li>
                        <li>Pastikan semua data yang diisi sudah benar</li>
                        <li>Klik tombol "Simpan"</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Question 7 -->
        <div class="card mb-2">
            <div class="card-header" id="headingSeven">
                <h5 class="mb-0">
                    <button class="btn btn-link font-weight-bold text-dark collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    7. Bagaimana proses pendaftaran ujian TOEIC bagi pendaftaran kedua?
                    </button>
                </h5>
            </div>
            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#helpAccordion">
                <div class="card-body">
                    <p>Anda dapat melakukan proses pendaftaran ujian TOEIC bagi pendaftaran kedua melalui:</p>
                    <ol>
                        <li>Buka menu "Pendaftaran" di dashboard</li>
                        <li>Pilih "Daftar Ujian"</li>
                        <li>Isi form yang tersedia dengan data diri Anda</li>
                        <li>Klik tombol "Daftar Ujian"</li>
                        <li>Pastikan semua data yang diisi sudah benar</li>
                        <li>Klik tombol "Simpan"</li>
                        <li>Bayar biaya pendaftaran"</li>
                        <li>Berikan bukti pembayaran ke admin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection