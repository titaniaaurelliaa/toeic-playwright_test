<?php

namespace App\Http\Controllers;
use App\Models\AdminModel;
use App\Models\PendaftaranModel as Pendaftaran;
use App\Models\StatusModel;

class AdminController extends Controller
{
    public function dashboard()
    {
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['Home', 'Dashboard'],
        ];

        $page = (object) [
            'title' => 'Dashboard',
        ];

        $activeMenu = 'dashboard';

        // Ambil data admin yang sedang login
        $admin = AdminModel::where('users_id', auth()->user()->id)->first();

        // Ambil ID untuk status dari tabel 'status'
        $idDiproses = StatusModel::where('status_nama', 'diproses')->value('id');
        $idDiterima = StatusModel::where('status_nama', 'diterima')->value('id');
        $idDitolak  = StatusModel::where('status_nama', 'ditolak')->value('id');

        // Hitung statistik
        $totalPendaftaran = Pendaftaran::count();
        $totalDiproses = Pendaftaran::where('status_id', $idDiproses)->count();
        $totalDiterima = Pendaftaran::where('status_id', $idDiterima)->count();
        $totalDitolak = Pendaftaran::where('status_id', $idDitolak)->count();

        // Data untuk DataTable: hanya yang status 'diproses'
        $pendaftaranDiproses = Pendaftaran::with(['mahasiswa', 'jadwal', 'status'])
            ->whereHas('status', function($query) {
                $query->where('status_nama', 'Diproses');
            })
            ->get();

        //dd($pendaftaranDiproses);

        return view('admin.dashboard_admin', compact(
            'breadcrumb',
            'activeMenu',
            'page',
            'admin',
            'totalPendaftaran',
            'totalDiproses',
            'totalDiterima',
            'totalDitolak',
            'pendaftaranDiproses'
        ));
    }

    public function help()
    {
        $breadcrumb = (object) [
            'title' => 'Bantuan',
            'list' => ['Home', 'Bantuan'],
        ];

        $page = (object) [
            'title' => 'Halaman Bantuan',
        ];

        $activeMenu = 'bantuan'; // Should match your sidebar menu item

        return view('admin.help', compact('breadcrumb', 'activeMenu', 'page'));
    }
}