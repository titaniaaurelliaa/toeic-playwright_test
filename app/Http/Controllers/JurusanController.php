<?php

namespace App\Http\Controllers;

use App\Models\JurusanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JurusanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Jurusan',
            'list' => ['Home', 'Jurusan'],
        ];

        $page = (object) [
            'title' => 'Halaman Jurusan',
        ];
        $activeMenu = 'jurusan';

        return view('admin.jurusan.index', compact('breadcrumb', 'activeMenu', 'page'));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = JurusanModel::select(['id', 'jurusan_kode', 'jurusan_nama']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function($row) {
                    $editUrl = url('admin/jurusan/edit_ajax/' . $row->id);
                    $deleteUrl = url('admin/jurusan/delete_ajax/' . $row->id);
                    return '
                        <button onclick="modalAction(`' . $editUrl . '`)" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</button>
                        <button onclick="deleteConfirm(`' . $deleteUrl . '`)" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                    ';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    public function create_ajax()
    {
        return view('admin.jurusan.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        $request->validate([
            'jurusan_kode' => 'required|string|max:100|unique:jurusan,jurusan_kode',
            'jurusan_nama' => 'required|string|max:255',
        ]);
    
        try {
            JurusanModel::create([
                'jurusan_kode' => $request->jurusan_kode,
                'jurusan_nama' => $request->jurusan_nama,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Data jurusan berhasil disimpan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }
    

    public function edit_ajax($id)
    {
        $jurusan = JurusanModel::findOrFail($id);
        return view('admin.jurusan.edit_ajax', compact('jurusan'));
    }

    public function update_ajax(Request $request, $id)
    {
        $request->validate([
            'jurusan_kode' => 'required',
            'jurusan_nama' => 'required',
        ]);
    
        $jurusan = JurusanModel::findOrFail($id);
        $jurusan->update([
            'jurusan_kode' => $request->jurusan_kode,
            'jurusan_nama' => $request->jurusan_nama,
        ]);
    
        return response()->json([
            'status' => true,
            'message' => 'Data jurusan berhasil diperbarui',
        ]);
    }
    

    public function delete_ajax($id)
    {
        try {
            $jurusan = JurusanModel::findOrFail($id);
            $jurusan->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data jurusan berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage(),
            ]);
        }
    }
}
