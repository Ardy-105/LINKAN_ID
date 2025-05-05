<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicPageController extends Controller
{
    public function show($username)
{
    $user = \App\Models\User::where('username', $username)->firstOrFail();

    // Ambil data tampilan (appearance)
    $appearance = \App\Models\Appearance::where('user_id', $user->id)->first();

    // Ambil data produk digital user yang aktif
    $products = \App\Models\DigitalProduct::where('user_id', $user->id)
        ->where('is_active', 1)
        ->get();

    return view('public.profile', compact('user', 'appearance', 'products'));
}

}
