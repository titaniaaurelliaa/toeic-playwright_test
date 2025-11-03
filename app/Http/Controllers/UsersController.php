<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar users',
            'list' => ['Home', 'users'],
        ];

        $page = (object) [
            'title' => 'Daftar users yang terdaftar dalam sistem',
        ];

        $activeMenu = 'users';

        return view('users.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'page' => $page]);
    }
}
