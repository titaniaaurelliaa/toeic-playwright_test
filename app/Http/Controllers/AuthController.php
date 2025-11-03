<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        try {
            if (Auth::check()) {
                $user = Auth::user();

                if ($user->roles === null) {
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Role tidak ditemukan!');
                }

                if ($user->roles->role_kode === 'ADM') {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->roles->role_kode === 'MHS') {
                    return redirect()->route('mahasiswa.dashboard');
                } else {
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Role tidak valid!');
                }
            }

            return view('auth.login');
        } catch (\Exception $e) {
            Log::error('Login page error: ' . $e->getMessage());
            return redirect()->route('landingpage')->with('error', 'Terjadi kesalahan sistem!');
        }
    }

    public function postlogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     $user = Auth::user()->load('roles');

        //     if (!$user->roles) {
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = \App\Models\UsersModel::with('roles')->find(Auth::id());

            if (!$user || !$user->roles) {
                Auth::logout();
                return back()->with('error', 'User tidak memiliki role');
            }

            return response()->json([
                'status' => true,
                'redirect' => ($user->roles->role_kode === 'ADM')
                    ? route('admin.dashboard')
                    : route('mahasiswa.dashboard')
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Username atau password salah'
        ], 401);
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('landingpage');
        } catch (\Exception $e) {
            Log::error('Logout error: ' . $e->getMessage());
            return redirect()->route('landingpage')->with('error', 'Gagal logout!');
        }
    }
}