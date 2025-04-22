<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DigitalProduct;

class AdminController extends Controller
{
    public function beranda()
    {
        return view('homeadminS.beranda');
    }

    public function myLinkan()
    {
        // Ambil semua produk (atau bisa dibatasi jika perlu)
        $digitalProducts = DigitalProduct::latest()->get();

        return view('homeadminS.mylinkan', compact('digitalProducts'));
    }
}
