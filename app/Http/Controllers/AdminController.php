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
        $user = auth()->user();
        $digitalProducts = DigitalProduct::where('user_id', $user->id)->latest()->get();
        $appearance = \App\Models\Appearance::where('user_id', $user->id)->first();

        return view('homeadminS.mylinkan', compact('digitalProducts', 'appearance'));
    }
}
