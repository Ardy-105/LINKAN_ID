<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payout Setting</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon.png')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        * { 
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f6fa;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .header {
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
        }

        .payout-section {
            display: flex;
            gap: 20px;
        }

        .earnings-card, .payment-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex: 1;
        }

        .earnings-card {
            background: #FF9040;
            color: white;
            position: relative;
        }

        .earnings-card h2 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .earnings-card p {
            font-size: 16px;
            margin: 5px 0;
        }

        .earnings-card p:last-of-type {
            font-style: italic;
            color: #f0f0f0;
        }

        .earnings-card .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: #FF9040;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            border: 2px solid #FF9040;
            cursor: pointer;
        }

        .earnings-card .btn:hover {
            background: #f0f0f0;
        }

        .earnings-card .btn-withdraw {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .earnings-card .btn-history {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .payment-card {
            text-align: center;
        }

        .payment-card h2 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .payment-card p {
            font-size: 14px;
            color: #666;
        }

        .payment-card .bank-info {
            margin-top: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .payment-card .bank-info strong {
            font-size: 16px;
            color: #333;
        }

        .payment-card .bank-info img {
            width: 40px;
            height: 40px;
        }
        .header a {
            color: black !important;
            text-decoration: none; /* kalau mau hilangkan garis bawah juga */
        }

    </style>
</head>
<body>
    <div class="container">
        <?php echo $__env->make('homeadminS.sidebar.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="main-content">
            <div class="header">
                <h1><a href="<?php echo e(route('settings')); ?>">Settings</a> &gt; <span>Payout Settings</h1>
            </div>

            <?php if(session('success')): ?>
                <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="payout-section">
                <!-- Earnings Card -->
                <div class="earnings-card">
                    <h2>My Earnings</h2>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Pendapatan</h5>
                                <h3 class="text-primary">Rp <?php echo e(number_format((float)$myEarnings, 0, ',', '.')); ?></h3>
                                <p class="text-muted">Total pendapatan dari semua transaksi yang berhasil</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Penarikan Terakhir</h5>
                                <h3 class="text-success">Rp <?php echo e(number_format((float)$lastWithdraw, 0, ',', '.')); ?></h3>
                                <p class="text-muted">Jumlah penarikan terakhir yang berhasil</p>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo e(route('payout.showWithdrawForm')); ?>" class="btn btn-withdraw">
                        <i class="fas fa-paper-plane"></i> Withdraw
                    </a>
                    <a href="<?php echo e(route('payout.showPayoutHistory')); ?>" class="btn btn-history">
                        <i class="fas fa-history"></i> History
                    </a>
                </div>

                <!-- Payment Card -->
                <div class="payment-card">
                    <h2>Get Paid With</h2>
                    <p>Your money will be transferred to</p>
                    <?php if($payoutDetail): ?>
                    <div class="bank-info">
                        <?php if($payoutDetail->method_type === 'Bank'): ?>
                            <img src="/images/creditcard.png" alt="Bank">
                        <?php elseif($payoutDetail->method_type === 'DANA'): ?>
                            <img src="/images/dana.png" alt="DANA">
                        <?php elseif($payoutDetail->method_type === 'ShopeePay'): ?>
                            <img src="/images/shopeepay.png" alt="ShopeePay">
                        <?php else: ?>
                            <i class="fas fa-wallet" style="font-size: 40px; color: #666;"></i>
                        <?php endif; ?>
                        <div>
                            <strong><?php echo e($payoutDetail->account_name); ?></strong><br>
                            <?php echo e($payoutDetail->method_type); ?> - <?php echo e($payoutDetail->account_number); ?>

                            <?php if($payoutDetail->method_type === 'Bank' && $payoutDetail->bank_name): ?>
                                <br><?php echo e($payoutDetail->bank_name); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                    <?php else: ?>
                    <div style="padding: 20px; color: #666;">
                        <p>Belum ada metode pembayaran yang diatur.</p>
                    </div>
                    <?php endif; ?>
                    <a href="<?php echo e(route('payout.showMethodForm')); ?>" class="btn" style="margin-top: 20px; display: inline-block; background: #FF9040; color: white;">
                        <i class="fas fa-cog"></i> <?php echo e($payoutDetail ? 'Edit Payout Method' : 'Set Payout Method'); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // Auto refresh data setiap 30 detik
    function refreshData() {
        fetch(window.location.href)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                
                // Update earnings dengan format yang benar
                const newEarnings = doc.querySelector('.earnings-card p:nth-child(2)').textContent;
                const earningsElement = document.querySelector('.earnings-card p:nth-child(2)');
                if (earningsElement) {
                    earningsElement.textContent = newEarnings;
                }
                
                // Update last withdraw
                const newLastWithdraw = doc.querySelector('.earnings-card p:nth-child(4)').textContent;
                const lastWithdrawElement = document.querySelector('.earnings-card p:nth-child(4)');
                if (lastWithdrawElement) {
                    lastWithdrawElement.textContent = newLastWithdraw;
                }
            })
            .catch(error => console.error('Error refreshing data:', error));
    }

    // Refresh data setiap 30 detik
    setInterval(refreshData, 30000);

    // Tambahkan event listener untuk memastikan data diperbarui saat halaman difokuskan
    document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'visible') {
            refreshData();
        }
    });

    // Refresh data saat halaman dimuat
    document.addEventListener('DOMContentLoaded', refreshData);
</script>
</html><?php /**PATH C:\LINKAN_ID\resources\views/homeadminS/payout.blade.php ENDPATH**/ ?>