<?php

namespace App\Http\Controllers\PlatformAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        // Contoh data dummy
        $verifikasi = [
            [
                'id' => 1,
                'username' => 'Budi',
                'title' => 'Pembelajaran',
                'image' => 'https://via.placeholder.com/80x50.png?text=Pembelajaran',
                'date' => '15 Aug 2025',
                'status' => 'completed',
                'action' => 'accepted',
            ],
            [
                'id' => 2,
                'username' => 'Fajar',
                'title' => 'Shopee Affiliate',
                'image' => 'https://via.placeholder.com/80x50.png?text=Shopee',
                'date' => '17 Aug 2025',
                'status' => 'pending',
                'action' => 'accept',
            ],
        ];

        return view('platformadmin.verifikasi', compact('verifikasi'));
    }
}
