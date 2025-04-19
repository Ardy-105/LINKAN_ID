<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function beranda()
    {
        return view('homeadminS.beranda');
    }

    public function myLinkan()
    {
        return view('homeadminS.mylinkan');
    }

    public function digitalProduct()
    {
        return view('homeadminS.digital-product');
    }
}
