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
        
        // Ambil data produk digital
        $digitalProducts = DigitalProduct::where('user_id', $user->id)->get();
        $totalProducts = $digitalProducts->count();
        
        // Data dummy untuk sementara (bisa diganti dengan data real)
        $totalViews = 0;
        $totalClicks = 0;
        $lifetimeOrders = 0;
        $lifetimeSales = 0;

        return view('homeadminS.beranda', compact(
            'totalViews',
            'totalClicks',
            'lifetimeOrders',
            'lifetimeSales',
            'totalProducts'
        ));
    }

    public function getChartData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        // Jika tidak ada tanggal yang dipilih, gunakan 7 hari terakhir
        if (!$startDate || !$endDate) {
            $endDate = Carbon::now();
            $startDate = Carbon::now()->subDays(6);
        } else {
            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate);
        }

        // Hitung selisih hari
        $daysDiff = $startDate->diffInDays($endDate);
        
        // Batasi maksimal 30 hari
        if ($daysDiff > 30) {
            $endDate = $startDate->copy()->addDays(30);
        }

        $dates = [];
        $views = [];
        $clicks = [];

        // Generate data untuk setiap hari dalam rentang
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $dates[] = $currentDate->format('d M');
            
            // Ambil data views untuk tanggal tersebut
            $viewCount = DB::table('link_views')
                ->where('user_id', Auth::id())
                ->whereDate('created_at', $currentDate)
                ->count();
            
            // Ambil data clicks untuk tanggal tersebut
            $clickCount = DB::table('link_clicks')
                ->where('user_id', Auth::id())
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