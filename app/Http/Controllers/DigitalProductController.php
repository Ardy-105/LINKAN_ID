<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DigitalProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DigitalProductController extends Controller
{
    public function create()
    {
        return view('homeadminS.digital-product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'platform_type' => 'required|string|in:upload,dropbox,gdrive,other',
            'platform_url' => 'nullable|url|required_if:platform_type,dropbox,gdrive,other',
            'platform_file' => 'nullable|file|mimes:pdf,zip,rar|required_if:platform_type,upload',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'has_quantity_limit' => 'nullable|boolean',
            'quantity' => 'nullable|integer|required_if:has_quantity_limit,1',
            'button_text' => 'required|string',
        ]);

        $data = $request->only([
            'title', 'description', 'platform_type', 'platform_url',
            'price', 'sale_price', 'has_quantity_limit', 'quantity', 'button_text'
        ]);

        $data['user_id'] = Auth::id(); // ID user yang sedang login

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $data['image'] = $imagePath;
        }

        if ($request->platform_type === 'upload' && $request->hasFile('platform_file')) {
            $filePath = $request->file('platform_file')->store('digital_products', 'public');
            $data['platform_file'] = $filePath;
        }

        $data['has_quantity_limit'] = $request->has('has_quantity_limit');

        DigitalProduct::create($data);

        return redirect()->route('mylinkan')->with('success', 'Digital product added successfully!');
    }

    public function edit($id)
    {
        $product = DigitalProduct::findOrFail($id);
        return view('homeadminS.digital-product', compact('product'));
    }
    
    public function update(Request $request, $id)
    {
        $product = DigitalProduct::findOrFail($id);
    
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'platform_type' => 'required|string',
            'platform_url' => 'nullable|string',
            'price' => 'nullable|numeric',
            'currency' => 'required|string',
            'sale_price' => 'nullable|numeric',
            'pay_what_want' => 'nullable|boolean',
            'has_quantity_limit' => 'nullable|boolean',
            'quantity' => 'nullable|integer',
            'button_text' => 'nullable|string',
            'image' => 'nullable|image',
            'platform_file' => 'nullable|file',
        ]);
    
        // Upload baru jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('product_images', 'public');
        }
    
        if ($request->hasFile('platform_file')) {
            $data['platform_file'] = $request->file('platform_file')->store('platform_files', 'public');
        }
    
        $product->update($data);
    
        return redirect()->route('mylinkan.index')->with('success', 'Product updated successfully!');
    }
    

    public function destroy($id)
    {
        $product = DigitalProduct::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }
}
