<?php

namespace App\Http\Controllers;

use App\Models\KampusModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class KampusController extends Controller
{
    public function index()
    {
        $kampus = KampusModel::all();
        $breadcrumb = (object) [
            'title' => 'Kampus',
            'list' => ['Home', 'Kampus'],
        ];

        $page = (object) [
            'title' => 'Halaman Kampus',
        ];
        $activeMenu = 'kampus';
        return view('admin.kampus.index', compact('kampus', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
{
    if ($request->ajax()) {
        $data = KampusModel::select(['id', 'kampus_nama', 'kampus_alamat']);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($row) {
                $editUrl = url('admin/kampus/edit_ajax/' . $row->id);
                $deleteUrl = url('admin/kampus/delete_ajax/' . $row->id);
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
    return view('admin.kampus.create_ajax');
}

    public function store(Request $request)
{
    $validated = $request->validate([
        'kampus_nama' => 'required|string|max:255',
        'kampus_alamat' => 'required|string|max:255',
    ]);

    KampusModel::create($validated);

    return response()->json(['message' => 'Data kampus berhasil ditambahkan.']);
}


public function edit_ajax($id)
{
    $kampus = KampusModel::findOrFail($id);
    return view('admin.kampus.edit_ajax', compact('kampus'));
}

public function update_ajax(Request $request, $id)
{
    $kampus = KampusModel::findOrFail($id);

    $validated = $request->validate([
        'kampus_nama' => 'required|string|max:255',
        'kampus_alamat' => 'required|string|max:255',
    ]);

    $kampus->update($validated);

    return response()->json([
        'status' => true,
        'message' => 'Data kampus berhasil diperbarui.'
    ]);
}

public function delete_ajax($id)
{
    try {
        $kampus = KampusModel::findOrFail($id);
        $kampus->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data kampus berhasil dihapus.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal menghapus data.'
        ]);
    }
}

public function store_ajax(Request $request)
{
    $request->validate([
        'kampus_nama' => 'required|string|max:255',
        'kampus_alamat' => 'required|string|max:255',
    ]);

    try {
        KampusModel::create([
            'kampus_nama' => $request->kampus_nama,
            'kampus_alamat' => $request->kampus_alamat,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data kampus berhasil disimpan'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ]);
    }
}
}
