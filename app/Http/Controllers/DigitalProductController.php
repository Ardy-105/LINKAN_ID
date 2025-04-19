<?php

namespace App\Http\Controllers;

use App\Models\DigitalProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DigitalProductController extends Controller
{
    public function create()
    {
        return view('homeadminS.digital-product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'platform_type' => 'required|in:upload,dropbox,gdrive,other',
            'platform_url' => 'required_unless:platform_type,upload|nullable|url',
            'platform_file' => 'required_if:platform_type,upload|nullable|file|max:10240',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'has_quantity_limit' => 'boolean',
            'quantity' => 'required_if:has_quantity_limit,1|nullable|integer|min:1',
            'button_text' => 'required|string|max:50'
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('product-images', 'public');

        // Handle platform file if uploaded
        $platformFilePath = null;
        if ($request->platform_type === 'upload' && $request->hasFile('platform_file')) {
            $platformFilePath = $request->file('platform_file')->store('product-files', 'public');
        }

        // Create digital product
        DigitalProduct::create([
            'user_id' => Auth::id(),
            'image' => $imagePath,
            'title' => $request->title,
            'description' => $request->description,
            'platform_type' => $request->platform_type,
            'platform_url' => $request->platform_url,
            'platform_file' => $platformFilePath,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'has_quantity_limit' => $request->has_quantity_limit ?? false,
            'quantity' => $request->has_quantity_limit ? $request->quantity : null,
            'button_text' => $request->button_text
        ]);

        return redirect()->route('mylinkan')->with('success', 'Digital product has been added successfully');
    }
}
