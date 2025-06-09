<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\DigitalProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Debug: Cek user yang sedang login
        \Log::info('User ID: ' . $user->id);

        $query = Transaction::with(['product'])
            ->whereHas('product', function($query) use ($user) {
                $query->where('user_id', $user->id);
            });

        // Filter berdasarkan status jika ada
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tanggal jika ada
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Filter berdasarkan pencarian jika ada
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('product', function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%");
                })
                ->orWhere('buyer_name', 'like', "%{$search}%");
            });
        }

        // Debug: Log query yang dijalankan
        \Log::info('SQL Query: ' . $query->toSql());
        \Log::info('Query Bindings: ' . json_encode($query->getBindings()));

        $transactions = $query->orderBy('created_at', 'desc')->get();

        // Debug: Log jumlah transaksi yang ditemukan
        \Log::info('Number of transactions found: ' . $transactions->count());

        if ($request->ajax()) {
            return response()->json([
                'transactions' => $transactions,
                'debug' => [
                    'user_id' => $user->id,
                    'query' => $query->toSql(),
                    'bindings' => $query->getBindings(),
                    'count' => $transactions->count(),
                    'filters' => [
                        'status' => $request->status,
                        'date' => $request->date,
                        'search' => $request->search
                    ]
                ]
            ]);
        }

        return view('homeadminS.orders', [
            'transactions' => $transactions
        ]);
    }

    public function getOrderDetail($id)
    {
        $user = Auth::user();
        $transaction = Transaction::with(['product'])
            ->whereHas('product', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('id', $id)
            ->first();

        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found'], 404);
        }

        return response()->json($transaction);
    }
} 