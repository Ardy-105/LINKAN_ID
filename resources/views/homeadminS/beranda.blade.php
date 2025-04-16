<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linkan Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f5f6fa;
        }

        .container {
            display: flex;
        }

        .marketing-tools {
            margin-top: 30px;
        }

        .marketing-tools h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
        }

        .notification-icon {
            background-color: #e4e4e4;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Account Section */
        .account-section {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .profile {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .profile-info a {
            color: #ff4500;
            text-decoration: none;
            font-size: 14px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .action-buttons button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            background-color: #e0e7ff;
            cursor: pointer;
            font-size: 14px;
        }

        /* Earnings Section */
        .earnings-section {
            background: #ff4500;
            border-radius: 10px;
            padding: 20px;
            color: white;
            margin-bottom: 20px;
        }

        .earnings-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .earnings-amount {
            font-size: 24px;
            font-weight: 600;
            margin-top: 10px;
        }

        /* Stats Section */
        .stats-section {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .stats-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .date-selector {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: white;
        }

        .stats-chart {
            height: 200px;
            margin-top: 20px;
        }

        /* Summary Cards */
        .summary-section {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .summary-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .summary-card i {
            font-size: 24px;
            color: #ff4500;
            margin-bottom: 10px;
        }

        .summary-card .number {
            font-size: 24px;
            font-weight: 600;
            margin: 10px 0;
        }

        .summary-card .label {
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        @include('homeadminS.sidebar.sidebar')
        
        <div class="main-content">
            <div class="header">
                <h1>HOME</h1>
                <div class="notification-icon">
                    <i class="fas fa-bell"></i>
                </div>
            </div>

            <div class="account-section">
                <div class="profile">
                    <img src="https://via.placeholder.com/50" alt="Profile">
                    <div class="profile-info">
                        <h3>Budi</h3>
                        <a href="https://Linkan.id/Budi">https://Linkan.id/Budi</a>
                    </div>
                </div>
                <div class="start-creating">START CREATING NOW...!</div>
                <div class="action-buttons">
                    <button><i class="fas fa-qrcode"></i> QR Linkan</button>
                    <button><i class="fas fa-box"></i> Digital Product</button>
                    <button><i class="fas fa-headset"></i> Support</button>
                </div>
            </div>

            <div class="earnings-section">
                <div class="earnings-header">
                    <span>Earnings</span>
                    <i class="fas fa-cog"></i>
                </div>
                <div class="earnings-amount">IDR --- --- ---</div>
            </div>

            <div class="stats-section">
                <div class="stats-header">
                    <h3>Total Click & Views</h3>
                    <button class="date-selector">
                        <i class="fas fa-calendar"></i> Select Date..
                    </button>
                </div>
                <div class="stats-numbers">
                    <span>Views: 5</span>
                    <span>Clicks: 3</span>
                </div>
                <div class="stats-chart">
                    <!-- Chart will be added here -->
                </div>
            </div>

            <div class="summary-section">
                <div class="summary-card">
                    <i class="fas fa-shopping-cart"></i>
                    <div class="label">Lifetime Orders</div>
                    <div class="number">1</div>
                </div>
                <div class="summary-card">
                    <i class="fas fa-users"></i>
                    <div class="label">Affiliate Product</div>
                    <div class="number">0</div>
                </div>
                <div class="summary-card">
                    <i class="fas fa-chart-line"></i>
                    <div class="label">Lifetime sales (IDR)</div>
                    <div class="number">0</div>
                </div>
                <div class="summary-card">
                    <i class="fas fa-box"></i>
                    <div class="label">My Blocks</div>
                    <div class="number">1</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Untuk menambahkan grafik, kita bisa menggunakan Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Inisialisasi grafik jika diperlukan
        const ctx = document.createElement('canvas');
        document.querySelector('.stats-chart').appendChild(ctx);
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['21 Mar', '22 Mar', '23 Mar', '24 Mar', '25 Mar'],
                datasets: [{
                    label: 'Views',
                    data: [0, 0, 5, 0, 0],
                    backgroundColor: '#ff4500',
                }, {
                    label: 'Clicks',
                    data: [0, 0, 3, 0, 0],
                    backgroundColor: '#4a90e2',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>