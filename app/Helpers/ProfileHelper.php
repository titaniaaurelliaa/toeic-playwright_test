<?php
if (!function_exists('profile_picture_url')) {
    function profile_picture_url($user)
    {
        if ($user->admin->foto_profil) {
            $extension = pathinfo($user->admin->foto_profil, PATHINFO_EXTENSION);
            return asset('storage/profile_pictures/foto_user_' . $user->id . '.' . $extension);
        } elseif ($user->mahasiswa->foto_profil) {
            $extension = pathinfo($user->mahasiswa->foto_profil, PATHINFO_EXTENSION);
            return asset('storage/profile_pictures/foto_user_' . $user->id . '.' . $extension);
        }
        return asset('landingpage/img/team-1.jpg');
    }
}
