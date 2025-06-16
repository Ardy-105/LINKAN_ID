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

    // Function untuk mencetak data
    public function print(Request $request)
    {
        // Ambil data yang akan dicetak dari request
        $data = $request->all();

        // Return view untuk print dengan data
        return view('platformadmin.print', compact('data'));
    }
}
