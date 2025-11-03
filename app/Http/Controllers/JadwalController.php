<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Jadwal TOEIC',
            'list' => ['Home', 'Jadwal'],
        ];

        $page = (object) [
            'title' => 'Halaman Jadwal',
        ];
        $activeMenu = 'jadwal';
        return view('admin.jadwal.index', compact('breadcrumb', 'activeMenu', 'page'));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $jadwal = JadwalModel::select(
                'id',
                DB::raw("DATE(tanggal) as tanggal_pelaksanaan"),
                DB::raw("TIME(tanggal) as jam_pelaksanaan"),
                'kuota',
                DB::raw("kuota - (
                    SELECT COUNT(*) 
                    FROM pendaftaran 
                    WHERE pendaftaran.jadwal_id = jadwal.id 
                    AND pendaftaran.status_id = 2
                ) as kuota_tersisa")
            );

            return DataTables::of($jadwal)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_ajax()
    {
        return view('admin.jadwal.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kuota' => 'required|integer|min:1'
        ]);

        try {
            JadwalModel::create($request->only(['tanggal', 'kuota']));

            return response()->json([
                'status' => true,
                'message' => 'Jadwal berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menambahkan jadwal'
            ]);
        }
    }

    public function edit_ajax($id)
    {
        $jadwal = JadwalModel::findOrFail($id);
        return view('admin.jadwal.edit_ajax', compact('jadwal'));
    }

    public function update_ajax(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kuota' => 'required|integer|min:1'
        ]);

        try {
            $jadwal = JadwalModel::findOrFail($id);
            $jadwal->update([
                'tanggal' => $request->tanggal,
                'kuota' => $request->kuota
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diperbarui'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal update: '.$e->getMessage()
            ], 500);
        }
    }

    public function delete_ajax($id)
    {
        try {
            // Cek apakah ada relasi sebelum menghapus
            $count = DB::table('pendaftaran')
                    ->where('jadwal_id', $id)
                    ->count();

            if ($count > 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak bisa menghapus, jadwal sudah digunakan'
                ], 422);
            }

            $jadwal = JadwalModel::findOrFail($id);
            $jadwal->delete();

            return response()->json([
                'status' => true,
                'message' => 'Jadwal berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus: ' . $e->getMessage()
            ], 500);
        }
    }
}