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
        return view('homeadminS.appearance', compact('appearance'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'theme_color' => 'required|string',
            'font_family' => 'required|string',
            'background_color' => 'required|string'
        ]);

        $user = Auth::user();
        $appearance = Appearance::where('user_id', $user->id)->first();

        if (!$appearance) {
            $appearance = new Appearance();
            $appearance->user_id = $user->id;
        }

        // Handle banner upload
        if ($request->hasFile('banner')) {
            if ($appearance->banner) {
                Storage::disk('public')->delete($appearance->banner);
            }
            $bannerPath = $request->file('banner')->store('banners', 'public');
            $appearance->banner = $bannerPath;
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            if ($appearance->profile_image) {
                Storage::disk('public')->delete($appearance->profile_image);
            }
            $profilePath = $request->file('profile_image')->store('profiles', 'public');
            $appearance->profile_image = $profilePath;
        }

        // Update appearance details
        $appearance->name = $request->name;
        $appearance->bio = $request->bio;
        $appearance->theme_color = $request->theme_color;
        $appearance->font_family = $request->font_family;
        $appearance->background_color = $request->background_color;
        $appearance->save();

        return redirect()->back()->with('success', 'Appearance updated successfully');
    }
}
