<?php

namespace App\Http\Controllers\PlatformAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
    private function authorizePlatformAdmin()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin_platform') {
            abort(403, 'Unauthorized');
        }
    }

    public function index()
    {
        $this->authorizePlatformAdmin();
        $themes = Theme::all();
        return view('platformadmin.theme.index', compact('themes'));
    }

    public function create()
    {
        $this->authorizePlatformAdmin();
        return view('platformadmin.theme.create');
    }

    public function store(Request $request)
    {
        $this->authorizePlatformAdmin();
        $request->validate([
            'name' => 'required|string|max:255',
            'preview_image' => 'required|image',
            'background_image' => 'required|image',
        ]);

        $previewPath = $request->file('preview_image')->store('themes/previews', 'public');
        $backgroundPath = $request->file('background_image')->store('themes/backgrounds', 'public');

        Theme::create([
            'name' => $request->name,
            'preview_image' => $previewPath,
            'background_image' => $backgroundPath,
        ]);

        return redirect()->route('platformadmin.theme.index')->with('success', 'Theme berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $this->authorizePlatformAdmin();
        $theme = Theme::findOrFail($id);
        return view('platformadmin.theme.edit', compact('theme'));
    }

    public function update(Request $request, $id)
    {
        $this->authorizePlatformAdmin();
        $theme = Theme::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'preview_image' => 'nullable|image',
            'background_image' => 'nullable|image',
        ]);

        $data = ['name' => $request->name];

        if ($request->hasFile('preview_image')) {
            if ($theme->preview_image) Storage::disk('public')->delete($theme->preview_image);
            $data['preview_image'] = $request->file('preview_image')->store('themes/previews', 'public');
        }
        if ($request->hasFile('background_image')) {
            if ($theme->background_image) Storage::disk('public')->delete($theme->background_image);
            $data['background_image'] = $request->file('background_image')->store('themes/backgrounds', 'public');
        }

        $theme->update($data);

        return redirect()->route('platformadmin.theme.index')->with('success', 'Theme berhasil diupdate.');
    }

    public function destroy($id)
    {
        $this->authorizePlatformAdmin();
        $theme = Theme::findOrFail($id);
        if ($theme->preview_image) Storage::disk('public')->delete($theme->preview_image);
        if ($theme->background_image) Storage::disk('public')->delete($theme->background_image);
        $theme->delete();
        return redirect()->route('platformadmin.theme.index')->with('success', 'Theme berhasil dihapus.');
    }
} 