<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function beranda()
    {
        // Mengambil data dari database
        $totalClicks = DB::table('link_clicks')
            ->where('user_id', Auth::id())
            ->count();
            
        $totalViews = DB::table('link_views')
            ->where('user_id', Auth::id())
            ->count();
        
        // Mengambil data transaksi
        $lifetimeOrders = DB::table('orders')
            ->where('seller_id', Auth::id())
            ->count();
            
        $lifetimeSales = DB::table('orders')
            ->where('seller_id', Auth::id())
            ->where('status', 'completed')
            ->sum('total_amount');
        
        // Mengambil total produk
        $totalProducts = DB::table('products')
            ->where('seller_id', Auth::id())
            ->count();
        
        // Mengambil data affiliate
        $affiliateProducts = DB::table('affiliate_products')
            ->where('user_id', Auth::id())
            ->count();

        return view('homeadminS.beranda', compact(
            'totalClicks',
            'totalViews',
            'lifetimeOrders',
            'lifetimeSales',
            'totalProducts',
            'affiliateProducts'
        ));
    }

    public function getChartData(Request $request)
    {
        $date = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::now();
        
        // Mengambil data untuk 5 hari (hari yang dipilih dan 4 hari sebelumnya)
        $dates = [];
        $views = [];
        $clicks = [];
        
        for ($i = 4; $i >= 0; $i--) {
            $currentDate = $date->copy()->subDays($i);
            $dates[] = $currentDate->format('d M');
            
            // Mengambil data views
            $viewCount = DB::table('link_views')
                ->where('user_id', Auth::id())
                ->whereDate('created_at', $currentDate)
                ->count();
            
            // Mengambil data clicks
            $clickCount = DB::table('link_clicks')
                ->where('user_id', Auth::id())
                ->whereDate('created_at', $currentDate)
                ->count();
                
            $views[] = $viewCount;
            $clicks[] = $clickCount;
        }
        
        return response()->json([
            'labels' => $dates,
            'views' => $views,
            'clicks' => $clicks
        ]);
    }
} 