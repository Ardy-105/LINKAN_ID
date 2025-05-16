<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlatformAdminController extends Controller
{
    // Menampilkan halaman beranda platform admin
    public function beranda()
    {
        return view('platformadmin.berandaplatform');
    }
}
