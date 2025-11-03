<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdiModel;
use Yajra\DataTables\Facades\DataTables;

class ProdiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Program Studi',
            'list' => ['Home', 'Program Studi'],
        ];

        $page = (object) [
            'title' => 'Halaman Program Studi',
        ];
        $activeMenu = 'prodi';

        return view('admin.prodi.index', compact('breadcrumb', 'activeMenu', 'page'));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = ProdiModel::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $editUrl = url('admin/prodi/edit_ajax/' . $row->id);
                    $deleteUrl = url('admin/prodi/delete_ajax/' . $row->id);
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
        return view('admin.prodi.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        $request->validate([
            'prodi_kode' => 'required|unique:prodi,prodi_kode',
            'prodi_nama' => 'required'
        ]);

        ProdiModel::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan'
        ]);
    }

    public function edit_ajax($id)
    {
        $data = ProdiModel::findOrFail($id);
        return view('admin.prodi.edit_ajax', compact('data'));
    }

    public function update_ajax(Request $request, $id)
    {
        $request->validate([
            'prodi_kode' => 'required|unique:prodi,prodi_kode,' . $id,
            'prodi_nama' => 'required'
        ]);

        $prodi = ProdiModel::findOrFail($id);
        $prodi->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui'
        ]);
    }

    public function delete_ajax($id)
    {
        $prodi = ProdiModel::findOrFail($id);
        $prodi->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
