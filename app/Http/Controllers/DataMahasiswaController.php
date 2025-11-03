<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\UsersModel;
use App\Models\MahasiswaModel;
use App\Models\ProdiModel;
use App\Models\JurusanModel;
use App\Models\KampusModel;

class DataMahasiswaController extends Controller
{
    public function index()
    {
        $jurusan = JurusanModel::select('id', 'jurusan_nama')->get();
        $prodi = ProdiModel::select('id', 'prodi_nama')->get();
        $kampus = KampusModel::select('id', 'kampus_nama')->get();

        $breadcrumb = (object) [
            'title' => 'Data Mahasiswa',
            'list' => ['Home', 'Data Mahasiswa'],
        ];

        $page = (object) [
            'title' => 'Halaman Data Mahasiswa',
        ];

        $activeMenu = 'mahasiswa'; // Should match your sidebar menu item

        return view('admin.datamahasiswa.index', compact('breadcrumb', 'activeMenu', 'page', 'jurusan', 'prodi', 'kampus'))
            ->with('jurusan', $jurusan)
            ->with('prodi', $prodi)
            ->with('kampus', $kampus);
    }

    public function list(Request $request)
    {
        $mahasiswa = MahasiswaModel::select(
            'id',
            'mahasiswa_nim',
            'mahasiswa_nama',
            'alamat',
            'no_telp',
            'email',
            'file_ktm',
            'file_ktp',
            'file_pas_foto',
            'prodi_id'
        )->with('prodi');

        // Filter berdasarkan kampus
        if ($request->kampus_id) {
            $mahasiswa->whereHas('jurusan', function ($query) use ($request) {
                $query->where('kampus_id', $request->kampus_id);
            });
        }

        // Filter berdasarkan jurusan
        if ($request->jurusan_id) {
            $mahasiswa->whereHas('prodi', function ($query) use ($request) {
                $query->where('jurusan_id', $request->jurusan_id);
            });
        }

        return DataTables::of($mahasiswa)
            // menambahkan kolom index
            ->addIndexColumn()
            ->addColumn('aksi', function ($mhs) {
                $btn = '<button onclick="showDetail(' . $mhs->id . ')" class="btn btn-outline-info btn-sm"><i class="fas fa-info"></i> Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('admin/mahasiswa/edit_ajax/' . $mhs->id) . '\')" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</button> ';
                $btn .= '<button onclick="deleteConfirm(\'' . url('admin/mahasiswa/delete_ajax/' . $mhs->id) . '\')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax()
    {
        $prodi = ProdiModel::select('id', 'prodi_nama')->get();
        return view('admin.datamahasiswa.create_ajax')->with('prodi', $prodi);
    }

    public function edit_ajax($id)
    {
        $mahasiswa = MahasiswaModel::findOrFail($id);
        $prodi = ProdiModel::select('id', 'prodi_nama')->get();
        $jurusan = JurusanModel::select('id', 'jurusan_nama')->get();
        $kampus = KampusModel::select('id', 'kampus_nama')->get();

        return view('admin.datamahasiswa.edit_ajax', compact('mahasiswa', 'prodi', 'jurusan', 'kampus'));
    }

    public function update_ajax(Request $request, $id)
    {
        $mahasiswa = MahasiswaModel::findOrFail($id);

        $rules = [
            'mahasiswa_nim'   => 'required|string|max:10|unique:mahasiswa,mahasiswa_nim,' . $id,
            'mahasiswa_nama'  => 'required|string|max:100',
            'alamat'          => 'required|string',
            'no_telp'         => 'string|max:15',
            'email'           => 'required|email|max:100',
            'file_ktm'        => 'file|mimes:jpg,jpeg,png|max:2048',
            'file_ktp'        => 'file|mimes:jpg,jpeg,png|max:2048',
            'file_pas_foto'   => 'file|mimes:jpg,jpeg,png|max:2048',
            'prodi_id'        => 'integer',
            'jurusan_id'      => 'integer',
            'kampus_id'       => 'integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors(),
            ]);
        }

        $nim = $request->mahasiswa_nim;
        $data = $request->except(['fileKTM', 'fileKTP', 'filePasFoto']);

        // File KTM
        if ($request->hasFile('fileKTM')) {
            $oldPath = public_path('uploads/ktm_mahasiswa/' . $mahasiswa->file_ktm);
            if ($mahasiswa->file_ktm && file_exists($oldPath)) {
                unlink($oldPath);
            }

            $fileKTM = $request->file('fileKTM');
            $fileNameKTM = 'ktm_' . $nim . '.' . $fileKTM->getClientOriginalExtension();
            $fileKTM->move(public_path('uploads/ktm_mahasiswa'), $fileNameKTM);
            $data['file_ktm'] = $fileNameKTM;
        }

        // File KTP
        if ($request->hasFile('fileKTP')) {
            $oldPath = public_path('uploads/ktp_mahasiswa/' . $mahasiswa->file_ktp);
            if ($mahasiswa->file_ktp && file_exists($oldPath)) {
                unlink($oldPath);
            }

            $fileKTP = $request->file('fileKTP');
            $fileNameKTP = 'ktp_' . $nim . '.' . $fileKTP->getClientOriginalExtension();
            $fileKTP->move(public_path('uploads/ktp_mahasiswa'), $fileNameKTP);
            $data['file_ktp'] = $fileNameKTP;
        }

        // File Pas Foto
        if ($request->hasFile('filePasFoto')) {
            $oldPath = public_path('uploads/pas_foto_mahasiswa/' . $mahasiswa->file_pas_foto);
            if ($mahasiswa->file_pas_foto && file_exists($oldPath)) {
                unlink($oldPath);
            }

            $filePasFoto = $request->file('filePasFoto');
            $fileNamePasFoto = 'pas_foto_' . $nim . '.' . $filePasFoto->getClientOriginalExtension();
            $filePasFoto->move(public_path('uploads/pas_foto_mahasiswa'), $fileNamePasFoto);
            $data['file_pas_foto'] = $fileNamePasFoto;
        }

        $mahasiswa->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Data mahasiswa berhasil diperbarui'
        ]);
    }


    public function delete_ajax($id)
    {
        $mahasiswa = MahasiswaModel::findOrFail($id);

        // Hapus file KTM
        $pathKTM = public_path('uploads/ktm_mahasiswa/' . $mahasiswa->file_ktm);
        if ($mahasiswa->file_ktm && file_exists($pathKTM)) {
            unlink($pathKTM);
        }

        // Hapus file KTP
        $pathKTP = public_path('uploads/ktp_mahasiswa/' . $mahasiswa->file_ktp);
        if ($mahasiswa->file_ktp && file_exists($pathKTP)) {
            unlink($pathKTP);
        }

        // Hapus file Pas Foto
        $pathFoto = public_path('uploads/pas_foto_mahasiswa/' . $mahasiswa->file_pas_foto);
        if ($mahasiswa->file_pas_foto && file_exists($pathFoto)) {
            unlink($pathFoto);
        }

        // Hapus data dari database
        $mahasiswa->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data mahasiswa berhasil dihapus'
        ]);
    }


    public function store_ajax(Request $request)
    {
        $rules = [
            'mahasiswa_nim' => 'required|string|max:10|unique:mahasiswa,mahasiswa_nim',
            'mahasiswa_nama' => 'required|string|max:100',
            'alamat'        => 'required|string',
            'no_telp'       => 'string|max:15',
            'email'         => 'required|email|max:100',
            'file_ktm'      => 'file|mimes:jpg,jpeg,png|max:2048',
            'file_ktp'      => 'file|mimes:jpg,jpeg,png|max:2048',
            'file_pas_foto' => 'file|mimes:jpg,jpeg,png|max:2048',
            'prodi_id'      => 'integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors(),
            ]);
        }



        $nim = $request->mahasiswa_nim; // Ambil NIM untuk nama file
        $data = $request->except(['fileKTM', 'fileKTP', 'filePasFoto']);
        $data['users_id'] = auth()->user()->id; // Ambil ID user yang sedang login

        // Simpan file KTM
        if ($request->hasFile('fileKTM')) {
            $fileKTM = $request->file('fileKTM');
            $fileNameKTM = 'ktm_' . $nim . '.' . $fileKTM->getClientOriginalExtension();
            $fileKTM->storeAs('public/ktm_mahasiswa', $fileNameKTM); // Simpan di storage/app/public/ktm_mahasiswa
            $data['file_ktm'] = $fileNameKTM;
        }

        // Simpan file KTP
        if ($request->hasFile('fileKTP')) {
            $fileKTP = $request->file('fileKTP');
            $fileNameKTP = 'ktp_' . $nim . '.' . $fileKTP->getClientOriginalExtension();
            $fileKTP->storeAs('public/ktp_mahasiswa', $fileNameKTP);
            $data['file_ktp'] = $fileNameKTP;
        }

        // Simpan file Pas Foto
        if ($request->hasFile('filePasFoto')) {
            $filePasFoto = $request->file('filePasFoto');
            $fileNamePasFoto = 'pas_foto_' . $nim . '.' . $filePasFoto->getClientOriginalExtension();
            $filePasFoto->storeAs('public/pas_foto_mahasiswa', $fileNamePasFoto);
            $data['file_pas_foto'] = $fileNamePasFoto;
        }

        MahasiswaModel::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data mahasiswa berhasil disimpan'
        ]);
    }
    public function show_ajax($id)
    {
        $mahasiswa = MahasiswaModel::with(['user', 'prodi'])->find($id);

        if (!$mahasiswa) {
            return response()->json([
                'status' => false,
                'message' => 'Data mahasiswa tidak ditemukan'
            ]);
        }

        return view('admin.datamahasiswa.detail', compact('mahasiswa'));
    }

    // Reset Password AJAX
    public function resetPassword($id)
    {
        try {
            $mahasiswa = MahasiswaModel::findOrFail($id);

            // Update password user terkait
            $mahasiswa->user()->update([
                'password' => bcrypt('12345')
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil direset ke 12345'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function import(Request $request)
    {
        $file = $request->file('file'); // pastikan name="file" pada form
        if (!$file) {
            return response()->json(['status' => false, 'message' => 'File tidak ditemukan.']);
        }

        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Lewati baris pertama (header)
        unset($rows[0]);

        foreach ($rows as $row) {
            [$nim, $nama, $alamat, $no_telp, $email, $nik, $foto_profil, $file_ktm, $file_ktp, $file_pas_foto, $prodi_id, $jurusan_id, $kampus_id] = $row;

            // Cek duplikat nim/nik
            if (MahasiswaModel::where('mahasiswa_nim', $nim)->orWhere('nik', $nik)->exists()) {
                continue;
            }

            // Buat user
            $user = UsersModel::create([
                'username' => 'mhs' . $nim,
                'password' => Hash::make('12345'),
                'roles_id' => 2
            ]);

            // Buat mahasiswa
            MahasiswaModel::create([
                'users_id' => $user->id,
                'mahasiswa_nim' => $nim,
                'mahasiswa_nama' => $nama,
                'alamat' => $alamat,
                'no_telp' => $no_telp,
                'email' => $email,
                'nik' => $nik,
                'foto_profil' => $foto_profil ?? '',
                'file_ktm' => $file_ktm ?? '',
                'file_ktp' => $file_ktp ?? '',
                'file_pas_foto' => $file_pas_foto ?? '',
                'prodi_id' => $prodi_id,
                'jurusan_id' => $jurusan_id,
                'kampus_id' => $kampus_id,
            ]);
        }

        return response()->json(['status' => true, 'message' => 'Data berhasil diimport.']);
    }
}
