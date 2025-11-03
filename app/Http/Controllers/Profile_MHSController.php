<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Profile_MHSController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Profile Mahasiswa',
            'list' => ['Home', 'Profile Mahasiswa'],
        ];

        $page = (object) [
            'title' => 'Halaman Profile Mahasiswa',
        ];
        $activeMenu = 'profile';

        return view('Mahasiswa.profile.index', compact('breadcrumb', 'activeMenu', 'page'));
    }

    public function showProfile()
    {
        $user = auth()->user();

        $mahasiswa = $user->mahasiswa;

        return view('mahasiswa.profile', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function update(Request $request)
    {
        \Log::info('Profile update request:', $request->all());

        try {
            $user = auth()->user();
            $mahasiswa = $user->mahasiswa;

            if (!$mahasiswa) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data mahasiswa tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|max:255|unique:mahasiswa,email,' . $mahasiswa->id . ',id',
                'phone' => 'sometimes|string|max:20',
                'alamat' => 'sometimes|string|max:255',
                'nik' => 'sometimes|string|max:20|unique:mahasiswa,nik,' . $mahasiswa->id . ',id',
                'username' => 'sometimes|string|max:255|unique:users,username,' . $user->id . ',id',
                'file_ktm' => 'sometimes|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'file_ktp' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                'file_pas_foto' => 'sometimes|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Update user (username)
            if ($request->has('username')) {
                $user->username = $request->username;
                $user->save();
            }

            // Update mahasiswa data
            $fields = [
                'name' => 'mahasiswa_nama',
                'email' => 'email',
                'phone' => 'no_telp',
                'alamat' => 'alamat',
                'nik' => 'nik',
                'foto_profil' => 'foto_profil',
                'file_ktm' => 'file_ktm',
                'file_ktp' => 'file_ktp',
                'file_pas_foto' => 'file_pas_foto'
            ];

            $updated = false;
            foreach ($fields as $requestField => $dbField) {
                if ($request->has($requestField)) {
                    $mahasiswa->{$dbField} = $request->{$requestField};
                    $updated = true;
                }
            }

            if ($updated) {
                $mahasiswa->save();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Profil berhasil diperbarui',
                'data' => [
                    'user' => $user->only(['username']),
                    'mahasiswa' => $mahasiswa->only(['mahasiswa_nama', 'email', 'no_telp', 'alamat', 'file_ktm', 'file_ktp', 'file_pas_foto'])
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Profile update error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }

    public function change_password(Request $request)
    {
        \Log::info('Password change request received', ['user_id' => auth()->id()]);

        try {
            $user = auth()->user();

            // Validasi input
            $validator = Validator::make($request->all(), [
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:3|different:current_password',
                'confirm_password' => 'required|string|same:new_password',
            ], [
                'current_password.required' => 'Password saat ini wajib diisi',
                'new_password.required' => 'Password baru wajib diisi',
                'new_password.min' => 'Password minimal 3 karakter',
                'new_password.different' => 'Password baru harus berbeda dengan password lama',
                'confirm_password.required' => 'Konfirmasi password wajib diisi',
                'confirm_password.same' => 'Konfirmasi password tidak cocok',
            ]);

            if ($validator->fails()) {
                \Log::warning('Password validation failed', ['errors' => $validator->errors()]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Verifikasi password saat ini
            if (!Hash::check($request->current_password, $user->password)) {
                \Log::warning('Current password mismatch', ['user_id' => $user->id]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Password saat ini tidak sesuai'
                ], 401);
            }

            // Update password
            $user->password = Hash::make($request->new_password);
            $user->save();

            \Log::info('Password changed successfully', ['user_id' => $user->id]);

            return response()->json([
                'status' => 'success',
                'message' => 'Password berhasil diubah'
            ]);
        } catch (\Exception $e) {
            \Log::error('Password change error: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => auth()->id()
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateProfilePicture(Request $request)
    {
        \Log::info('Profile picture update request received');

        try {
            $user = auth()->user();
            $mahasiswa = $user->mahasiswa;

            if (!$mahasiswa) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data mahasiswa tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Hapus foto lama jika ada
            if ($mahasiswa->foto_profil) {
                $oldImagePath = public_path('storage/profile_pictures/' . $mahasiswa->foto_profil);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload foto baru dengan nama berdasarkan user ID
            $image = $request->file('foto_profil');
            $extension = $image->getClientOriginalExtension();
            $imageName = 'foto_user_' . $user->id . '.' . $extension;
            $image->storeAs('public/profile_pictures', $imageName);

            $mahasiswa->foto_profil = $imageName;
            $mahasiswa->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Foto profil berhasil diperbarui',
                'image_url' => asset('storage/profile_pictures/' . $imageName)
            ]);
        } catch (\Exception $e) {
            \Log::error('Profile picture update error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateDokumen(Request $request)
    {
        try {
            $user = auth()->user();
            $mahasiswa = $user->mahasiswa;

            if (!$mahasiswa) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data mahasiswa tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'file_ktm' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                'file_ktp' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                'file_pas_foto' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $responseData = [];

            // Handle KTM
            if ($request->hasFile('file_ktm')) {
                // Hapus file lama jika ada
                if ($mahasiswa->file_ktm) {
                    Storage::delete('public/dokumen/ktm_mahasiswa/' . $mahasiswa->file_ktm);
                }

                $file = $request->file('file_ktm');
                $fileName = 'ktm_' . $user->id . '_' . $mahasiswa->mahasiswa_nim . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/dokumen/ktm_mahasiswa', $fileName);

                $mahasiswa->file_ktm = $fileName;
                $responseData['file_ktm_url'] = asset('storage/dokumen/ktm_mahasiswa/' . $fileName);
            }

            // Handle KTP
            if ($request->hasFile('file_ktp')) {
                // Hapus file lama jika ada
                if ($mahasiswa->file_ktp) {
                    Storage::delete('public/dokumen/ktp_mahasiswa/' . $mahasiswa->file_ktp);
                }

                $file = $request->file('file_ktp');
                $fileName = 'ktp_' . $user->id . '_' . $mahasiswa->mahasiswa_nim . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/dokumen/ktp_mahasiswa', $fileName);

                $mahasiswa->file_ktp = $fileName;
                $responseData['file_ktp_url'] = asset('storage/dokumen/ktp_mahasiswa/' . $fileName);
            }

            // Handle Pas Foto
            if ($request->hasFile('file_pas_foto')) {
                // Hapus file lama jika ada
                if ($mahasiswa->file_pas_foto) {
                    Storage::delete('public/dokumen/pas_foto_mahasiswa/' . $mahasiswa->file_pas_foto);
                }
                $file = $request->file('file_pas_foto');
                $fileName = 'pas_foto_' . $user->id . '_' . $mahasiswa->mahasiswa_nim . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/dokumen/pas_foto_mahasiswa', $fileName);
                $mahasiswa->file_pas_foto = $fileName;
                $responseData['file_pas_foto_url'] = asset('storage/dokumen/pas_foto_mahasiswa/' . $fileName);
            }

            $mahasiswa->save();

            return response()->json(array_merge([
                'status' => 'success',
                'message' => 'Dokumen berhasil diperbarui'
            ], $responseData));
        } catch (\Exception $e) {
            \Log::error('Update dokumen error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }
}
