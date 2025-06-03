<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\DigitalProduct;
use App\Models\User;

class DashboardController extends Controller
{
    public function beranda()
    {
        $user = Auth::user();

        // Ambil produk digital milik user
        $digitalProducts = DigitalProduct::where('user_id', $user->id)->get();
        $totalProducts = $digitalProducts->count();

        // Ambil total views dan clicks berdasarkan link_id (username)
        $totalViews = DB::table('link_views')
            ->where('link_id', $user->username)
            ->count();

        $totalClicks = DB::table('link_clicks')
            ->where('link_id', $user->username)
            ->count();

        // Ambil data lifetime orders dan sales
        $lifetimeOrders = DB::table('transactions')
            ->join('digital_products', 'transactions.product_id', '=', 'digital_products.id')
            ->where('digital_products.user_id', $user->id)
            ->sum('transactions.qty');

        $lifetimeSales = DB::table('orders')
            ->where('seller_id', $user->id)
            ->where('status', 'completed')
            ->sum('total_amount');

        $totalEarnings = DB::table('transactions')
            ->join('digital_products', 'transactions.product_id', '=', 'digital_products.id')
            ->where('digital_products.user_id', $user->id)
            ->sum('transactions.total_price');

        return view('homeadminS.beranda', compact(
            'totalViews',
            'totalClicks',
            'lifetimeOrders',
            'lifetimeSales',
            'totalProducts',
            'totalEarnings'
        ));
    }

    public function getChartData(Request $request)
    {
        $user = Auth::user();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Jika tanggal tidak diberikan, ambil 7 hari terakhir
        try {
            $startDate = $startDate ? Carbon::parse($startDate) : Carbon::now()->subDays(6);
            $endDate = $endDate ? Carbon::parse($endDate) : Carbon::now();
        } catch (\Exception $e) {
            // Jika parsing gagal, set default
            $startDate = Carbon::now()->subDays(6);
            $endDate = Carbon::now();
        }

        // Batasi range maksimal 30 hari
        if ($startDate->diffInDays($endDate) > 30) {
            $endDate = $startDate->copy()->addDays(30);
        }

        $dates = [];
        $views = [];
        $clicks = [];

        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $dates[] = $currentDate->format('d M');

            $viewCount = DB::table('link_views')
                ->where('link_id', $user->username)
                ->whereDate('created_at', $currentDate)
                ->count();

            $clickCount = DB::table('link_clicks')
                ->where('link_id', $user->username)
                ->whereDate('created_at', $currentDate)
                ->count();

            $views[] = $viewCount;
            $clicks[] = $clickCount;

            $currentDate->addDay();
        }

        return response()->json([
            'labels' => $dates,
            'views' => $views,
            'clicks' => $clicks,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d')
        ]);
    }

    public function getDigitalProducts()
    {
        $user = Auth::user();

        $digitalProducts = DigitalProduct::where('user_id', $user->id)
            ->select('id', 'title', 'price', 'created_at')
            ->latest()
            ->get();

        return response()->json([
            'total' => $digitalProducts->count(),
            'products' => $digitalProducts
        ]);
    }

    // Fungsi untuk mencatat CLICK
    public function trackClick(Request $request)
    {
        $linkId = $request->query('link_id');
        $target = $request->query('target');

        // Validasi URL target
        if (!filter_var($target, FILTER_VALIDATE_URL)) {
            abort(400, 'Invalid target URL');
        }

        // Dapatkan user berdasarkan username
        $user = User::where('username', $linkId)->first();
        if (!$user) {
            abort(404, 'User not found');
        }

        // Catat click ke database
        DB::table('link_clicks')->insert([
            'user_id' => $user->id,
            'link_id' => $linkId,
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->to($target);
    }
}
