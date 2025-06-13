<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Assuming user authentication
use Illuminate\Support\Facades\DB;   // For database operations
use App\Models\DigitalProduct; // Diperlukan untuk join di perhitungan total earnings
use App\Models\UserPayoutDetail; // Import model UserPayoutDetail

class PayoutController extends Controller
{
    /**
     * Menampilkan halaman Payout Setting.
     */
    public function index()
    {
        $user = Auth::user();

        // Debug: Log user ID
        \Log::info('Payout - Calculating earnings for user ID: ' . $user->id);

        // Ambil semua transaksi untuk debugging
        $allTransactions = DB::table('transactions')
            ->join('digital_products', 'transactions.product_id', '=', 'digital_products.id')
            ->where('digital_products.user_id', $user->id)
            ->select('transactions.*', 'digital_products.title')
            ->get();

        // Log semua transaksi (termasuk yang tidak success)
        \Log::info('Payout - All transactions for user:');
        foreach ($allTransactions as $transaction) {
            \Log::info("Transaction ID: {$transaction->id}, Status: {$transaction->status}, Amount: {$transaction->total_price}, Product: {$transaction->title}, Created: {$transaction->created_at}");
        }

        // Ambil semua transaksi yang berhasil
        $successTransactions = DB::table('transactions')
            ->join('digital_products', 'transactions.product_id', '=', 'digital_products.id')
            ->where('digital_products.user_id', $user->id)
            ->where('transactions.status', 'success')
            ->select('transactions.*', 'digital_products.title')
            ->get();

        // Log transaksi yang berhasil
        \Log::info('Payout - Successful transactions:');
        foreach ($successTransactions as $transaction) {
            \Log::info("Success Transaction ID: {$transaction->id}, Amount: {$transaction->total_price}, Product: {$transaction->title}, Created: {$transaction->created_at}");
        }

        // Hitung total pendapatan dari transaksi yang berhasil
        $myEarnings = (float)DB::table('transactions')
            ->join('digital_products', 'transactions.product_id', '=', 'digital_products.id')
            ->where('digital_products.user_id', $user->id)
            ->where('transactions.status', 'success')
            ->sum('transactions.total_price');

        // Debug: Log hasil perhitungan
        \Log::info('Payout - Total Earnings Calculation: ' . $myEarnings);
        \Log::info('Payout - Raw SQL Query: ' . DB::table('transactions')
            ->join('digital_products', 'transactions.product_id', '=', 'digital_products.id')
            ->where('digital_products.user_id', $user->id)
            ->where('transactions.status', 'success')
            ->toSql());
        \Log::info('Payout - Query Bindings: ' . json_encode([
            'user_id' => $user->id,
            'status' => 'success'
        ]));

        // Ambil data penarikan terakhir dari database
        $lastWithdraw = (float)(DB::table('payout_transactions')
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->latest()
            ->value('amount') ?? 0);

        // Ambil detail pembayaran user dari tabel user_payout_details
        $payoutDetail = UserPayoutDetail::where('user_id', $user->id)->first();

        // Update balance di tabel users jika berbeda dengan total pendapatan
        $currentBalance = (float)(DB::table('users')->where('id', $user->id)->value('balance') ?? 0);
        if ($currentBalance != $myEarnings) {
            \Log::info("Payout - Updating balance from {$currentBalance} to {$myEarnings}");
            DB::table('users')
                ->where('id', $user->id)
                ->update(['balance' => $myEarnings]);
        }

        // Debug: Log final values
        \Log::info('Payout - Final Values:');
        \Log::info('myEarnings: ' . $myEarnings);
        \Log::info('currentBalance: ' . $currentBalance);
        \Log::info('lastWithdraw: ' . $lastWithdraw);
        
        return view('homeadminS.payout', compact('myEarnings', 'lastWithdraw', 'payoutDetail'));
    }

    /**
     * Menampilkan form input jumlah penarikan.
     */
    public function showWithdrawForm()
    {
        $user = Auth::user();

        // Ambil saldo saat ini dari kolom 'balance' untuk validasi
        $currentEarnings = $user->balance ?? 0; // Menggunakan kolom 'balance' yang baru

        // Ambil detail pembayaran user yang sudah disimpan
        $payoutDetail = UserPayoutDetail::where('user_id', $user->id)->first();

        return view('homeadminS.withdraw_form', compact('currentEarnings', 'payoutDetail'));
    }

    /**
     * Menampilkan form untuk mengatur metode pembayaran.
     */
    public function showPayoutMethodForm()
    {
        $user = Auth::user();
        $payoutDetail = UserPayoutDetail::where('user_id', $user->id)->first();

        return view('homeadminS.payout_method_form', compact('payoutDetail'));
    }

    /**
     * Menyimpan atau memperbarui metode pembayaran user.
     */
    public function savePayoutMethod(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'method_type' => 'required|string|in:Bank,DANA,ShopeePay',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'bank_name' => 'nullable|string|max:255', // Nullable karena tidak semua metode punya bank_name
        ]);

        // Cek apakah user sudah punya detail pembayaran
        $payoutDetail = UserPayoutDetail::where('user_id', $user->id)->first();

        if ($payoutDetail) {
            // Update detail yang sudah ada
            $payoutDetail->update([
                'method_type' => $request->method_type,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'bank_name' => ($request->method_type === 'Bank') ? $request->bank_name : null,
            ]);
            $message = 'Pengaturan metode pembayaran berhasil diperbarui!';
        } else {
            // Buat detail baru
            UserPayoutDetail::create([
                'user_id' => $user->id,
                'method_type' => $request->method_type,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'bank_name' => ($request->method_type === 'Bank') ? $request->bank_name : null,
            ]);
            $message = 'Pengaturan metode pembayaran berhasil disimpan!';
        }

        return redirect()->route('payout.index')->with('success', $message);
    }

    /**
     * Memproses permintaan penarikan dana.
     */
    public function processWithdrawal(Request $request)
    {
        $user = Auth::user();

        // Ambil saldo saat ini dari kolom 'balance' untuk validasi
        $currentEarnings = $user->balance ?? 0; // Menggunakan kolom 'balance' yang baru

        $request->validate([
            'amount' => ['required', 'numeric', 'min:10000', 'max:' . $currentEarnings], // Validasi jumlah maksimal
            'method' => 'required|string|in:Bank,DANA,ShopeePay',
            'account_detail' => 'required|string|max:255',
            'account_name' => 'required|string|max:255', // Pastikan account_name juga divalidasi
        ], [
            'amount.max' => 'Jumlah penarikan melebihi saldo yang tersedia.',
            'method.required' => 'Metode penarikan wajib diisi.',
            'method.in' => 'Metode penarikan tidak valid.',
            'account_detail.required' => 'Detail akun/nomor telepon wajib diisi.',
            'account_detail.string' => 'Detail akun/nomor telepon harus berupa teks.',
            'account_detail.max' => 'Detail akun/nomor telepon terlalu panjang.',
            'account_name.required' => 'Nama akun wajib diisi.',
            'account_name.string' => 'Nama akun harus berupa teks.',
            'account_name.max' => 'Nama akun terlalu panjang.',
        ]);

        $amount = $request->input('amount');
        $method = $request->input('method');
        $accountDetail = $request->input('account_detail');
        $accountName = $request->input('account_name'); // Ambil account_name

        // --- Logika Bisnis Penarikan ---

        // 1. Catat transaksi penarikan di database
        DB::table('payout_transactions')->insert([
            'user_id' => $user->id,
            'amount' => $amount,
            'method' => $method,
            'account_detail' => $accountDetail, // Menyimpan detail akun/nomor telepon
            'account_name' => $accountName, // Menyimpan nama akun
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        

        // 2. Kurangi saldo pengguna yang dapat ditarik di database (MENGGUNAKAN KOLOM 'balance')
        $user->decrement('balance', $amount);
        $user->save(); // Simpan perubahan saldo
        
        // 3. Integrasi dengan Gateway Pembayaran Eksternal (Placeholder)
        //    Di sini Anda akan memanggil API dari penyedia pembayaran (misalnya, Midtrans, Xendit, atau API bank)
        //    untuk memulai transfer dana.
        //    Pastikan Anda memiliki detail bank/e-wallet pengguna yang tersimpan dengan aman.
        //    $payoutService->initiatePayout($amount, $user->bank_details);

        return redirect()->route('payout.index')->with('success', 'Permintaan penarikan sebesar Rp ' . number_format($amount, 0, ',', '.') . ' berhasil diajukan melalui ' . $method . '. Status akan diperbarui segera.');
    }

    /**
     * Menampilkan riwayat penarikan dana.
     */
    public function showPayoutHistory()
    {
        $user = Auth::user();

        // Ambil data riwayat penarikan dari database untuk user yang login
        $history = DB::table('payout_transactions')
            ->where('user_id', $user->id)
            ->latest()
            ->get();
        
        return view('homeadminS.payout_history', compact('history'));
    }
} 