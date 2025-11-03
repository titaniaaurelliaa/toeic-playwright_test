<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Profile_ADMController;
use App\Http\Controllers\DataMahasiswaController;
use App\Http\Controllers\Pendaftaran_ADMController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Profile_MHSController;
use App\Http\Controllers\Pendaftaran_MHSController;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\ProdiController;

Route::get('/', [WelcomeController::class, 'index'])->name('landingpage');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postlogin'])->name('postlogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'authorize:ADM'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/help', [AdminController::class, 'help'])->name('admin.help');

    Route::prefix('profile')->group(function () {
        Route::get('/', [Profile_ADMController::class, 'index'])->name('admin.profile.index');
        Route::post('/update', [Profile_ADMController::class, 'update'])->name('admin.profile.update');
        Route::post('/change_password', [Profile_ADMController::class, 'change_password'])->name('admin.profile.change_password');
        Route::post('/update_picture', [Profile_ADMController::class, 'updateProfilePicture'])->name('admin.profile.update_picture');
    });

    Route::prefix('mahasiswa')->group(function () {
        Route::get('/', [DataMahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
        Route::post('/list', [DataMahasiswaController::class, 'list'])->name('admin.mahasiswa.list');
        Route::get('/create_ajax', [DataMahasiswaController::class, 'create_ajax'])->name('admin.mahasiswa.create_ajax');
        Route::post('/store_ajax', [DataMahasiswaController::class, 'store_ajax'])->name('admin.mahasiswa.store_ajax');
        Route::get('/edit_ajax/{id}', [DataMahasiswaController::class, 'edit_ajax'])->name('admin.mahasiswa.edit_ajax');
        Route::post('/update_ajax/{id}', [DataMahasiswaController::class, 'update_ajax'])->name('admin.mahasiswa.update_ajax');
        Route::get('/delete_ajax/{id}', [DataMahasiswaController::class, 'delete_ajax'])->name('admin.mahasiswa.delete_ajax');
        Route::get('/{id}/show_ajax', [DataMahasiswaController::class, 'show_ajax'])->name('admin.mahasiswa.show_ajax');
        Route::post('/{id}/reset_password', [DataMahasiswaController::class, 'resetPassword'])->name('admin.mahasiswa.resetPassword');
        Route::post('/import', [DataMahasiswaController::class, 'import'])->name('admin.mahasiswa.import');
    });

    Route::prefix('pendaftaran')->group(function () {
        Route::get('/', [Pendaftaran_ADMController::class, 'index'])->name('admin.pendaftaran.index');
        Route::post('/list', [Pendaftaran_ADMController::class, 'list'])->name('admin.pendaftaran.list');
        Route::get('/show_ajax/{id}', [Pendaftaran_ADMController::class, 'show_ajax'])->name('admin.pendaftaran.show_ajax');
        Route::get('/edit_ajax/{id}', [Pendaftaran_ADMController::class, 'edit_ajax'])->name('admin.pendaftaran.edit_ajax');
        Route::put('/update_ajax/{id}', [Pendaftaran_ADMController::class, 'update'])->name('admin.pendaftaran.update_ajax');
        Route::get('/delete_ajax/{id}', [Pendaftaran_ADMController::class, 'delete_ajax'])->name('admin.pendaftaran.delete_ajax');
        Route::delete('/destroy_ajax/{id}', [Pendaftaran_ADMController::class, 'destroy'])->name('admin.pendaftaran.destroy_ajax');

        Route::get('/validasi/{id}', [Pendaftaran_ADMController::class, 'validasi'])->name('admin.pendaftaran.validasi');
        Route::post('/validasi/proses/{id}', [Pendaftaran_ADMController::class, 'validasi_proses'])->name('admin.pendaftaran.validasi_proses');
        Route::get('/export', [Pendaftaran_ADMController::class, 'export'])->name('admin.pendaftaran.export');
    });

    Route::prefix('jadwal')->group(function () {
    Route::get('/', [JadwalController::class, 'index'])->name('admin.jadwal.index');
    Route::post('/list', [JadwalController::class, 'list'])->name('admin.jadwal.list');
    Route::get('/create_ajax', [JadwalController::class, 'create_ajax'])->name('admin.jadwal.create_ajax');
    Route::post('/store_ajax', [JadwalController::class, 'store_ajax'])->name('admin.jadwal.store_ajax');
    Route::get('/edit_ajax/{id}', [JadwalController::class, 'edit_ajax'])->name('admin.jadwal.edit_ajax');
    Route::put('/{id}/update_ajax', [JadwalController::class, 'update_ajax'])->name('admin.jadwal.update_ajax');
    Route::delete('/delete_ajax/{id}', [JadwalController::class, 'delete_ajax'])->name('admin.jadwal.delete_ajax');
    });

    Route::prefix('kampus')->group(function () {
        Route::get('/', [KampusController::class, 'index'])->name('admin.kampus.index');
        Route::post('/list', [KampusController::class, 'list'])->name('admin.kampus.list');
        Route::get('/create_ajax', [KampusController::class, 'create_ajax'])->name('admin.kampus.create_ajax');
        Route::post('/store_ajax', [KampusController::class, 'store_ajax'])->name('admin.kampus.store_ajax');
        Route::get('/edit_ajax/{id}', [KampusController::class, 'edit_ajax'])->name('admin.kampus.edit_ajax');
        Route::post('/update_ajax/{id}', [KampusController::class, 'update_ajax'])->name('admin.kampus.update_ajax');
        Route::get('/delete_ajax/{id}', [KampusController::class, 'delete_ajax'])->name('admin.kampus.delete_ajax');
    });

    Route::prefix('jurusan')->group(function () {
        Route::get('/', [JurusanController::class, 'index'])->name('admin.jurusan.index');
        Route::post('/list', [JurusanController::class, 'list'])->name('admin.jurusan.list');
        Route::get('/create_ajax', [JurusanController::class, 'create_ajax'])->name('admin.jurusan.create_ajax');
        Route::post('/store_ajax', [JurusanController::class, 'store_ajax'])->name('admin.jurusan.store_ajax');
        Route::get('/edit_ajax/{id}', [JurusanController::class, 'edit_ajax'])->name('admin.jurusan.edit_ajax');
        Route::post('/update_ajax/{id}', [JurusanController::class, 'update_ajax'])->name('admin.jurusan.update_ajax');
        Route::get('/delete_ajax/{id}', [JurusanController::class, 'delete_ajax'])->name('admin.jurusan.delete_ajax');
    });

    Route::prefix('prodi')->group(function () {
        Route::get('/', [ProdiController::class, 'index'])->name('admin.prodi.index');
        Route::post('/list', [ProdiController::class, 'list'])->name('admin.prodi.list');
        Route::get('/create_ajax', [ProdiController::class, 'create_ajax'])->name('admin.prodi.create_ajax');
        Route::post('/store_ajax', [ProdiController::class, 'store_ajax'])->name('admin.prodi.store_ajax');
        Route::get('/edit_ajax/{id}', [ProdiController::class, 'edit_ajax'])->name('admin.prodi.edit_ajax');
        Route::post('/update_ajax/{id}', [ProdiController::class, 'update_ajax'])->name('admin.prodi.update_ajax');
        Route::get('/delete_ajax/{id}', [ProdiController::class, 'delete_ajax'])->name('admin.prodi.delete_ajax');
    });
});

Route::middleware(['auth', 'authorize:MHS'])->prefix('mahasiswa')->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
    Route::get('/help', [MahasiswaController::class, 'help'])->name('mahasiswa.help');

    Route::prefix('pendaftaran')->group(function () {
        Route::get('/', [Pendaftaran_MHSController::class, 'index'])->name('mahasiswa.pendaftaran.index');
        Route::get('/create_ajax', [Pendaftaran_MHSController::class, 'create_ajax'])->name('mahasiswa.pendaftaran.create_ajax');
        Route::post('/store_ajax', [Pendaftaran_MHSController::class, 'store_ajax'])->name('mahasiswa.pendaftaran.store_ajax');
        Route::post('/list', [Pendaftaran_MHSController::class, 'list'])->name('mahasiswa.pendaftaran.list');
        Route::get('/show_ajax/{id}', [Pendaftaran_MHSController::class, 'show_ajax'])->name('mahasiswa.pendaftaran.show_ajax');
        Route::get('/edit_ajax/{id}', [Pendaftaran_MHSController::class, 'edit_ajax'])->name('mahasiswa.pendaftaran.edit_ajax');
        Route::delete('/delete_ajax/{id}', [Pendaftaran_MHSController::class, 'delete_ajax'])->name('mahasiswa.pendaftaran.delete_ajax');

        Route::get('/read_formulir', [Pendaftaran_MHSController::class, 'read_formulir'])->name('mahasiswa.pendaftaran.read_formulir');
        Route::get('/create_formulir', [Pendaftaran_MHSController::class, 'create_formulir'])->name('mahasiswa.pendaftaran.create_formulir');
        Route::post('/create_formulir_proses', [Pendaftaran_MHSController::class, 'create_formulir_proses'])->name('mahasiswa.pendaftaran.create_formulir_proses');
        Route::get('/edit_formulir/{id}', [Pendaftaran_MHSController::class, 'edit_formulir'])->name('mahasiswa.pendaftaran.edit_formulir');
        Route::put('/edit_formulir_proses/{id}', [Pendaftaran_MHSController::class, 'edit_formulir_proses'])->name('mahasiswa.pendaftaran.edit_formulir_proses');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [Profile_MHSController::class, 'index'])->name('mahasiswa.profile.index');
        Route::post('/update', [Profile_MHSController::class, 'update'])->name('mahasiswa.profile.update');
        Route::get('/change_password', [Profile_MHSController::class, 'change_password'])->name('mahasiswa.profile.change_password');
        Route::post('/change_password', [Profile_MHSController::class, 'change_password'])->name('mahasiswa.profile.change_password');
        Route::post('/update_picture', [Profile_MHSController::class, 'updateProfilePicture'])->name('mahasiswa.profile.update_picture');
        Route::post('/update_dokumen', [Profile_MHSController::class, 'updateDokumen'])->name('mahasiswa.profile.update_dokumen');
    });
});