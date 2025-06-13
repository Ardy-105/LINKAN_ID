<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payout History</title>
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

        .header a {
            color: black !important;
            text-decoration: none;
        }

        .history-table {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .history-table h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .history-table table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .history-table th,
        .history-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .history-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #555;
        }

        .history-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .history-table .status-completed {
            color: #28a745; /* Green */
            font-weight: bold;
        }

        .history-table .status-pending {
            color: #ffc107; /* Yellow */
            font-weight: bold;
        }

        .history-table .status-failed {
            color: #dc3545; /* Red */
            font-weight: bold;
        }

        .no-records {
            text-align: center;
            padding: 30px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php echo $__env->make('homeadminS.sidebar.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="main-content">
            <div class="header">
                <h1><a href="<?php echo e(route('payout.index')); ?>">Payout Settings</a> &gt; <span>Payout History</h1>
            </div>

            <div class="history-table">
                <h2>Payout History</h2>

                <?php if($history->isEmpty()): ?>
                    <p class="no-records">No payout records found.</p>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($record['id']); ?></td>
                                    <td><?php echo e($record['date']); ?></td>
                                    <td>IDR <?php echo e(number_format($record['amount'], 0, ',', '.')); ?></td>
                                    <td><?php echo e($record['method']); ?></td>
                                    <td>
                                        <span class="status-<?php echo e(strtolower($record['status'])); ?>">
                                            <?php echo e($record['status']); ?>

                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html> <?php /**PATH C:\LINKAN_ID\resources\views/homeadminS/payout_history.blade.php ENDPATH**/ ?>