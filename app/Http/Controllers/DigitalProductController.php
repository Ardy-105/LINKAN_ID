<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DigitalProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DigitalProductController extends Controller
{


public function show($id)
{
    $product = DigitalProduct::findOrFail($id);
    $user = $product->user; // relasi user() di model DigitalProduct
    $appearance = $user->appearance;

    return view('public.product-detail', compact('product', 'user', 'appearance'));
}


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
        $product = DigitalProduct::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
            
        return view('homeadminS.digital-product', compact('product'));
    }
    
    public function update(Request $request, $id)
    {
        $product = DigitalProduct::findOrFail($id);
        
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'platform_type' => 'required|string|in:upload,dropbox,gdrive,other',
            'platform_url' => 'nullable|url|required_if:platform_type,dropbox,gdrive,other',
            'platform_file' => 'nullable|file|mimes:pdf,zip,rar',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'has_quantity_limit' => 'nullable|boolean',
            'quantity' => 'nullable|integer|min:1',
            'button_text' => 'required|string',
        ]);

        $data = $request->only([
            'title', 'description', 'platform_type', 'platform_url',
            'price', 'sale_price', 'has_quantity_limit', 'quantity', 'button_text'
        ]);

        // Jika has_quantity_limit tidak dicentang, set quantity ke null
        if (!$request->has('has_quantity_limit')) {
            $data['has_quantity_limit'] = false;
            $data['quantity'] = null;
        }

        // Jika platform_type adalah upload dan ada file baru
        if ($request->platform_type === 'upload' && $request->hasFile('platform_file')) {
            // Hapus file lama jika ada
            if ($product->platform_file) {
                Storage::disk('public')->delete($product->platform_file);
            }
            $filePath = $request->file('platform_file')->store('digital_products', 'public');
            $data['platform_file'] = $filePath;
        } else if ($request->platform_type !== 'upload') {
            // Jika platform_type bukan upload, hapus file yang ada
            if ($product->platform_file) {
                Storage::disk('public')->delete($product->platform_file);
                $data['platform_file'] = null;
            }
        }

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('product_images', 'public');
            $data['image'] = $imagePath;
        }

        $product->update($data);

        return redirect()->route('mylinkan')->with('success', 'Produk berhasil diperbarui!');
    }
    

    public function destroy($id)
    {
        $product = DigitalProduct::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }
}
