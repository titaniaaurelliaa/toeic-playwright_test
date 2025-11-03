<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\PendaftaranModel;
use Illuminate\Support\Facades\Auth;
use App\Models\MahasiswaModel;
use App\Models\JadwalModel;
use App\Models\StatusModel;
use Carbon\Carbon;

class Pendaftaran_MHSController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Pendaftaran',
            'list' => ['Home', 'Pendaftaran'],
        ];

        $page = (object) [
            'title' => 'Pendaftaran',
        ];

        $activeMenu = 'pendaftaran';

        return view('mahasiswa.datapendaftaran.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $mahasiswa_id = Auth::user()->mahasiswa->id;

        $pendaftaran = PendaftaranModel::with(['mahasiswa', 'mahasiswa.prodi', 'jadwal', 'status'])
            ->where('mahasiswa_id', $mahasiswa_id);

        if ($request->jadwal_id) {
            $pendaftaran->where('jadwal_id', $request->jadwal_id);
        }
        if ($request->status_id) {
            $pendaftaran->where('status_id', $request->status_id);
        }

        return DataTables::of($pendaftaran)
            ->addIndexColumn()
            ->addColumn('aksi', function ($dft) {
                $btn = '<button class="btn btn-outline-info btn-sm" onclick="modalAction(\'' . route('mahasiswa.pendaftaran.show_ajax', $dft->id) . '\')"><i class="fas fa-info"></i> Detail</button> ';

                // Edit button based on status
                if (in_array($dft->status_id, [1, 3, 4])) {
                    $btn .= '<button class="btn btn-outline-warning btn-sm" onclick="modalAction(\'' . route('mahasiswa.pendaftaran.edit_ajax', $dft->id) . '\')"><i class="fas fa-edit"></i> Edit</button> ';
                } else {
                    $btn .= '<button class="btn btn-outline-dark btn-sm" disabled title="Tidak bisa edit dengan status ini"><i class="fas fa-edit"></i> Edit</button> ';
                }

                // Delete button based on status
                if (in_array($dft->status_id, [1, 4])) {
                    $btn .= '<button class="btn btn-outline-danger btn-sm" onclick="deleteConfirm(\'' . route('mahasiswa.pendaftaran.delete_ajax', $dft->id) . '\')"><i class="fas fa-trash"></i> Hapus</button> ';
                } else {
                    $btn .= '<button class="btn btn-outline-dark btn-sm" disabled title="Tidak bisa hapus dengan status ini"><i class="fas fa-trash"></i> Hapus</button> ';
                }

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function show_ajax($id)
    {
        $pendaftaran = PendaftaranModel::with(['mahasiswa', 'mahasiswa.prodi', 'jadwal', 'status'])
            ->findOrFail($id);

        if ($pendaftaran->mahasiswa_id != Auth::user()->mahasiswa->id) {
            abort(403, 'Unauthorized');
        }

        return view('mahasiswa.datapendaftaran.show_ajax', compact('pendaftaran'));
    }

    public function create_ajax()
    {
        $mahasiswa = Auth::user()->mahasiswa; // Ambil data mahasiswa yang login
        $jadwal = JadwalModel::where('tanggal', '>=', now())->orderBy('tanggal')->get();
        $status = StatusModel::all();

        return view('mahasiswa.datapendaftaran.create_ajax', [
            'mahasiswa' => $mahasiswa,
            'jadwal' => $jadwal,
            'status' => $status,
        ]);
    }

    public function store_ajax(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        // Validasi dokumen lengkap
        if (!$mahasiswa->file_ktm || !$mahasiswa->file_ktp || !$mahasiswa->file_pas_foto) {
            return response()->json([
                'message' => 'Harap lengkapi semua dokumen (KTM, KTP, Pas Foto) sebelum mendaftar'
            ], 422);
        }

        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'jadwal_id' => 'required|exists:jadwal,id',
            'tanggal_pendaftaran' => 'required|date',
        ]);

        // Cek apakah mahasiswa sudah pernah diterima sebelumnya
        $hasAcceptedRegistration = PendaftaranModel::where('mahasiswa_id', $mahasiswa->id)
            ->where('status_id', 2) // Status Diterima
            ->exists();

        // Set status_id berdasarkan kondisi
        $status_id = $hasAcceptedRegistration ? 4 : 1; // 4 = Menunggu (jika sudah pernah diterima), 1 = Baru (jika belum)

        // Buat data pendaftaran
        $pendaftaran = PendaftaranModel::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'jadwal_id' => $request->jadwal_id,
            'status_id' => $status_id,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
        ]);

        return response()->json([
            'message' => 'Pendaftaran berhasil disimpan',
            'data' => $pendaftaran
        ]);
    }

    public function edit_ajax($id)
    {
        $pendaftaran = PendaftaranModel::findOrFail($id);
        $mahasiswa = Auth::user()->mahasiswa;

        // Authorization check
        if ($pendaftaran->mahasiswa_id != $mahasiswa->id) {
            return response()->json([
                'message' => 'Unauthorized access to this registration'
            ], 403);
        }

        $jadwal = JadwalModel::where('tanggal', '>=', now())->orderBy('tanggal')->get();
        $status = StatusModel::all();

        return response()->json([
            'pendaftaran' => $pendaftaran,
            'jadwal' => $jadwal,
            'status' => $status
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        $pendaftaran = PendaftaranModel::findOrFail($id);
        $mahasiswa = Auth::user()->mahasiswa;

        // Authorization check
        if ($pendaftaran->mahasiswa_id != $mahasiswa->id) {
            return response()->json([
                'message' => 'Unauthorized access to this registration'
            ], 403);
        }

        // Status validation for editing
        if (!in_array($pendaftaran->status_id, [1, 3, 4])) {
            return response()->json([
                'message' => 'Tidak dapat mengedit pendaftaran dengan status ini'
            ], 422);
        }

        $request->validate([
            'jadwal_id' => 'required|exists:jadwal,id',
            'tanggal_pendaftaran' => 'required|date',
        ]);

        $pendaftaran->update([
            'jadwal_id' => $request->jadwal_id,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
        ]);

        return response()->json([
            'message' => 'Pendaftaran berhasil diperbarui',
            'data' => $pendaftaran
        ]);
    }

    public function delete_ajax($id)
    {
        $pendaftaran = PendaftaranModel::findOrFail($id);
        $mahasiswa = Auth::user()->mahasiswa;

        // Authorization check
        if ($pendaftaran->mahasiswa_id != $mahasiswa->id) {
            return response()->json([
                'message' => 'Unauthorized access to this registration'
            ], 403);
        }

        // Status validation for deletion
        if (!in_array($pendaftaran->status_id, [1, 4])) {
            return response()->json([
                'message' => 'Tidak dapat menghapus pendaftaran dengan status ini'
            ], 422);
        }

        $pendaftaran->delete();

        return response()->json([
            'message' => 'Pendaftaran berhasil dihapus'
        ]);
    }

    public function read_formulir()
    {
        $mahasiswa_id = Auth::user()->mahasiswa->id;
        $jadwal = JadwalModel::where('tanggal', '>', now())
            ->where(function ($query) {
                $query->where('kuota', '>', 0)
                    ->orWhereNull('kuota');
            })
            ->orderBy('tanggal', 'asc')
            ->get();
        $pendaftaran = PendaftaranModel::with(['mahasiswa', 'mahasiswa.prodi', 'jadwal', 'status'])
            ->where('mahasiswa_id', $mahasiswa_id)
            ->first();

        if (!$pendaftaran || $pendaftaran->mahasiswa_id != Auth::user()->mahasiswa->id) {
            abort(403, 'Unauthorized');
        }

        $breadcrumb = (object) [
            'title' => 'Formulir Pendaftaran TOIEC',
            'list' => ['Home', 'Pendaftaran'],
        ];

        $page = (object) [
            'title' => 'Pendaftaran',
        ];

        $activeMenu = 'pendaftaran';

        return view('mahasiswa.datapendaftaran.formulir', [
            'pendaftaran' => $pendaftaran,
            'mahasiswa' => $pendaftaran->mahasiswa
        ], compact('pendaftaran', 'jadwal', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function create_formulir()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if ($mahasiswa->pendaftaran()->exists()) {
            return redirect()->route('mahasiswa.pendaftaran.read_formulir')
                ->with('error', 'Anda sudah memiliki pendaftaran aktif');
        }

        $jadwal = JadwalModel::where('tanggal', '>', now())
            ->where('kuota', '>', 0)
            ->orderBy('tanggal')
            ->get();

        $breadcrumb = (object) [
            'title' => 'Formulir Pendaftaran TOIEC',
            'list' => ['Home', 'Pendaftaran'],
        ];

        $page = (object) [
            'title' => 'Pendaftaran',
        ];

        $activeMenu = 'pendaftaran';

        return view('mahasiswa.datapendaftaran.formulir_create', compact('jadwal', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function create_formulir_proses(Request $request)
    {
        try {
            // Validasi
            $request->validate([
                'jadwal_id' => 'required|exists:jadwal,id'
            ]);

            // Cek apakah sudah pernah mendaftar
            if (Auth::user()->mahasiswa->pendaftaran()->exists()) {
                return redirect()
                    ->route('mahasiswa.pendaftaran.read_formulir')
                    ->with('error', 'Anda sudah memiliki pendaftaran aktif');
            }

            // Buat pendaftaran
            PendaftaranModel::create([
                'tanggal_pendaftaran' => now(),
                'mahasiswa_id' => Auth::user()->mahasiswa->id,
                'jadwal_id' => $request->jadwal_id,
                'status_id' => 1 // Status Diproses
            ]);

            return redirect()
                ->route('mahasiswa.pendaftaran.create_formulir')
                ->with('success', 'Pendaftaran TOEIC berhasil dikirim! Status: Diproses');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal menyimpan pendaftaran: ' . $e->getMessage());
        }
    }

    public function edit_formulir($id)
    {
        // Ambil data pendaftaran yang dimiliki oleh mahasiswa yang login dan memiliki status_id 3
        $pendaftaran = PendaftaranModel::where('id', $id)
            ->where('mahasiswa_id', Auth::user()->mahasiswa->id)
            ->where('status_id', 3) // Hanya untuk status_id 3
            ->first();

        // Jika tidak ditemukan atau tidak memenuhi kriteria
        if (!$pendaftaran) {
            return redirect()
                ->route('mahasiswa.pendaftaran.read_formulir')
                ->with('error', 'Pendaftaran tidak ditemukan atau tidak dapat diubah');
        }

        // Ambil jadwal yang tersedia (tanggal setelah sekarang dan kuota > 0)
        $jadwal = JadwalModel::where('tanggal', '>', now())
            ->where('kuota', '>', 0)
            ->orderBy('tanggal')
            ->get();

        $breadcrumb = (object) [
            'title' => 'Edit Formulir Pendaftaran TOIEC',
            'list' => ['Home', 'Pendaftaran', 'Edit'],
        ];

        $page = (object) [
            'title' => 'Edit Pendaftaran',
        ];

        $activeMenu = 'pendaftaran';

        return view('mahasiswa.datapendaftaran.formulir_edit', compact('pendaftaran', 'jadwal', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function edit_formulir_proses(Request $request, $id)
    {
        try {
            // Validasi
            $request->validate([
                'jadwal_id' => 'required|exists:jadwal,id'
            ]);

            // Cari pendaftaran yang akan diupdate
            $pendaftaran = PendaftaranModel::where('id', $id)
                ->where('mahasiswa_id', Auth::user()->mahasiswa->id)
                ->where('status_id', 3) // Hanya untuk status_id 3
                ->first();

            // Jika tidak ditemukan atau tidak memenuhi kriteria
            if (!$pendaftaran) {
                return redirect()
                    ->route('mahasiswa.pendaftaran.read_formulir')
                    ->with('error', 'Pendaftaran tidak ditemukan atau tidak dapat diubah');
            }

            // Update data pendaftaran
            $pendaftaran->update([
                'jadwal_id' => $request->jadwal_id,
                'status_id' => 1 // Kembalikan status ke Diproses setelah edit
            ]);

            return redirect()
                ->route('mahasiswa.pendaftaran.read_formulir')
                ->with('success', 'Pendaftaran TOEIC berhasil diperbarui! Status kembali ke Diproses');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui pendaftaran: ' . $e->getMessage());
        }
    }
}
