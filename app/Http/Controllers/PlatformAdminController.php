<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Jika tidak ada data dari request, ambil data default
        if (empty($data)) {
            $data = [
                'total_earnings' => 'IDR 242.200',
                'commission_details' => [
                    [
                        'name' => 'Budi',
                        'email' => 'Budi@gmail.com',
                        'date' => '17 Apr 2025',
                        'amount' => 'Rp 153.800'
                    ],
                    [
                        'name' => 'Fajar',
                        'email' => 'Fajar@gmail.com',
                        'date' => '17 Apr 2025',
                        'amount' => 'Rp 88.400'
                    ]
                ]
            ];
        }

        // Return view untuk print dengan data
        return view('platformadmin.print', compact('data'));
    }
}
