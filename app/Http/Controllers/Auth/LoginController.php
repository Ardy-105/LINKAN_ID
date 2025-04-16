<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Coba cari user berdasarkan google_id
        $user = User::where('google_id', $googleUser->id)->first();

        // Kalau tidak ditemukan, cek berdasarkan email
        if (!$user) {
            $user = User::where('email', $googleUser->email)->first();

            // Kalau user sudah ada, update google_id-nya
            if ($user) {
                $user->update([
                    'google_id' => $googleUser->id,
                ]);
            } else {
                // Kalau user belum ada, buat baru
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(Str::random(16)),
                ]);
            }
        }

            Auth::login($user);
            return redirect()->route('beranda.admins');
    }
}
