<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\MahasiswaModel;

class MahasiswaController extends Controller
{
    //
    public function dashboard()
    {
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['Home', 'Dashboard'],
        ];

        $page = (object) [
            'title' => 'Dashboard',
        ];

        $activeMenu = 'dashboard'; // Should match your sidebar menu item

        // Ambil data mahasiswa yang sedang login
        $mahasiswa = MahasiswaModel::where('users_id', auth()->user()->id)->first();

        return view('mahasiswa.dashboard_mahasiswa', compact('breadcrumb', 'activeMenu', 'page', 'mahasiswa'));
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

        return view('mahasiswa.help', compact('breadcrumb', 'activeMenu', 'page'));
    }
} 