<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Appearance;

class AppearanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $appearance = Appearance::where('user_id', $user->id)->first();
        $digitalProducts = \App\Models\DigitalProduct::where('user_id', $user->id)->latest()->get();
        return view('homeadminS.appearance', compact('appearance', 'digitalProducts'));
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'theme_color' => 'required|string|max:7',
            'background_color' => 'nullable|string',
            'instagram' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'whatsapp' => 'nullable|url|max:255',
        ]);

        // Cari atau buat record appearance
        $appearance = Appearance::where('user_id', $user->id)->first();
        if (!$appearance) {
            $appearance = new Appearance();
            $appearance->user_id = $user->id;
        }
          // Cek jika ada request untuk menghapus banner
 if ($request->input('delete_banner') == "1" && $appearance->banner) {
    Storage::delete('public/' . $appearance->banner);
    $appearance->banner = null;
}


        // Update data
        $appearance->name = $request->name;
        $appearance->bio = $request->bio;
        $appearance->theme_color = $request->theme_color;
        $appearance->background_color = $request->background_color;
        $appearance->instagram = $request->instagram;
        $appearance->tiktok = $request->tiktok;
        $appearance->whatsapp = $request->whatsapp;
        $appearance->is_active = true;

        // Handle banner upload
        if ($request->hasFile('banner')) {
            if ($appearance->banner) {
                Storage::delete('public/' . $appearance->banner);
            }
            $bannerPath = $request->file('banner')->store('appearances/banners', 'public');
            $appearance->banner = $bannerPath;
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            if ($appearance->profile_image) {
                Storage::delete('public/' . $appearance->profile_image);
            }
            $profilePath = $request->file('profile_image')->store('appearances/profiles', 'public');
            $appearance->profile_image = $profilePath;
        }

        $appearance->save();

        return redirect()->back()->with('success', 'Appearance updated successfully!');
    }
}
