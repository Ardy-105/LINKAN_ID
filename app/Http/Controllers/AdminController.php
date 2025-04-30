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

        $digitalProducts = DigitalProduct::where('user_id', auth()->id())->latest()->get();

        return view('homeadminS.mylinkan', compact('digitalProducts'));
    }
}
