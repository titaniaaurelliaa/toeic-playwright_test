<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class Profile_ADMController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Profile Admin',
            'list' => ['Home', 'Profile Admin'],
        ];

        $page = (object) [
            'title' => 'Halaman Profile Admin',
        ];
        $activeMenu = 'profile';

        return view('admin.profile.index', compact('breadcrumb', 'activeMenu', 'page'));
    }

    public function showProfile()
    {
        $user = auth()->user();

        $admin = $user->admin;

        return view('admin.profile', [
            'admin' => $admin
        ]);
    }

    public function update(Request $request)
    {
        \Log::info('Profile update request:', $request->all());

        try {
            $user = auth()->user();
            $admin = $user->admin;

            if (!$admin) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data admin tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|max:255|unique:admin,email,' . $admin->id . ',id',
                'phone' => 'sometimes|string|max:20',
                'alamat' => 'sometimes|string|max:255',
                'username' => 'sometimes|string|max:255|unique:users,username,' . $user->id . ',id',
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

            // Update admin data
            $fields = [
                'name' => 'admin_nama',
                'email' => 'email',
                'phone' => 'no_telp',
                'alamat' => 'alamat',
                'foto_profil' => 'foto_profil'
            ];

            $updated = false;
            foreach ($fields as $requestField => $dbField) {
                if ($request->has($requestField)) {
                    $admin->{$dbField} = $request->{$requestField};
                    $updated = true;
                }
            }

            if ($updated) {
                $admin->save();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Profil berhasil diperbarui',
                'data' => [
                    'user' => $user->only(['username']),
                    'admin' => $admin->only(['admin_nama', 'email', 'no_telp', 'alamat'])
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
            $admin = $user->admin;

            if (!$admin) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data admin tidak ditemukan'
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
            if ($admin->foto_profil) {
                $oldImagePath = public_path('storage/profile_pictures/' . $admin->foto_profil);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload foto baru dengan nama berdasarkan user ID
            $image = $request->file('foto_profil');
            $extension = $image->getClientOriginalExtension();
            $imageName = 'foto_user_' . $user->id . '.' . $extension;
            $image->storeAs('public/profile_pictures', $imageName);

            $admin->foto_profil = $imageName;
            $admin->save();

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
}
