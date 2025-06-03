<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\DigitalProduct;

class DashboardController extends Controller
{
    public function beranda()
    {
        $user = Auth::user();

        // Ambil data produk digital milik user
        $digitalProducts = DigitalProduct::where('user_id', $user->id)->get();
        $totalProducts = $digitalProducts->count();

        // Ambil data views dan clicks berdasarkan link_id (username)
        $totalViews = DB::table('link_views')
            ->where('link_id', $user->username)
            ->count();

        $totalClicks = DB::table('link_clicks')
            ->where('link_id', $user->username)
            ->count();

        // Ambil data orders dan sales
       $lifetimeOrders = DB::table('transactions')
    ->join('digital_products', 'transactions.product_id', '=', 'digital_products.id')
    ->where('digital_products.user_id', $user->id)
    ->sum('transactions.qty');


        $lifetimeSales = DB::table('orders')
            ->where('seller_id', $user->id)
            ->where('status', 'completed')
            ->sum('total_amount');

        // ✅ Tambahkan total earnings dari tabel transactions
        $totalEarnings = DB::table('transactions')
            ->join('digital_products', 'transactions.product_id', '=', 'digital_products.id')
            ->where('digital_products.user_id', $user->id)
            ->sum('transactions.total_price');

        // Kirim semua data ke view
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
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $user = Auth::user();

        if (!$startDate || !$endDate) {
            $endDate = Carbon::now();
            $startDate = Carbon::now()->subDays(6);
        } else {
            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate);
        }

        $daysDiff = $startDate->diffInDays($endDate);

        if ($daysDiff > 30) {
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
}
