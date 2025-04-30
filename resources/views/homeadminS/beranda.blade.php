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
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 25px 30px;
            background-color: #f5f6fa;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 26px;
            font-weight: bold;
            color: #000;
        }

        .notification-icon {
            background-color: #fff;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .notification-icon i {
            color: #333;
            font-size: 16px;
        }

        /* Account Section */
        .account-section {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .profile {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
        }

        .profile-image {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            margin-right: 15px;
            background-color: #edf1f7;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-image i {
            font-size: 22px;
            color: #666;
        }

        .profile-info h3 {
            font-size: 17px;
            color: #333;
            margin-bottom: 4px;
            font-weight: 500;
        }

        .profile-info a {
            color: #ff4500;
            text-decoration: none;
            font-size: 13px;
        }

        .share-button {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            font-size: 15px;
            cursor: pointer;
            padding: 8px;
        }

        .start-creating {
            font-size: 15px;
            color: #333;
            font-weight: 600;
            margin: 15px 0;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-button {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            background-color: #f5f5f5;
            cursor: pointer;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
            color: #333;
            transition: all 0.2s ease;
            flex: 1;
        }

        .action-button i {
            font-size: 13px;
            color: #666;
        }

        /* Earnings Section */
        .earnings-section {
            background: #FF9040;
            border-radius: 12px;
            padding: 20px;
            color: white;
            margin-bottom: 20px;
            position: relative;
            box-shadow: 0 2px 8px rgba(255,69,0,0.2);
        }

        .earnings-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .earnings-header span {
            font-size: 15px;
            font-weight: 500;
        }

        .earnings-header i {
            font-size: 18px;
            cursor: pointer;
        }

        .earnings-amount {
            font-size: 26px;
            font-weight: 600;
        }

        /* Stats Section */
        .stats-section {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .stats-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .stats-header h3 {
            font-size: 15px;
            color: #333;
            font-weight: 500;
        }

        .date-selector {
            padding: 7px 12px;
            border: 1px solid #eee;
            border-radius: 6px;
            background: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #666;
        }

        .date-selector i {
            font-size: 13px;
        }

        .stats-numbers {
            display: flex;
            gap: 25px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #666;
        }

        .stats-chart {
            height: 200px;
            margin-top: 15px;
        }

        /* Summary Cards */
        .summary-section {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .summary-card {
            background: white;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .summary-card i {
            font-size: 18px;
            color: #666;
            margin-bottom: 12px;
        }

        .summary-card .label {
            font-size: 13px;
            color: #666;
            margin-bottom: 8px;
        }

        .summary-card .number {
            font-size: 22px;
            font-weight: 600;
            color: #333;
        }

        @media (max-width: 1024px) {
            .summary-section {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 20px;
            }
            
            .action-buttons {
                flex-wrap: wrap;
            }
            
            .action-button {
                min-width: calc(50% - 5px);
            }
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
                    <div class="profile-image">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="profile-info">
                        <h3>{{ Auth::user()->name }}</h3>
                        <a href="https://Linkan.id/{{ Auth::user()->username }}">https://Linkan.id/{{ Auth::user()->username }}</a>
                    </div>
                    <button class="share-button" onclick="copyToClipboard('https://Linkan.id/{{ Auth::user()->username }}')">
                        <i class="fas fa-share-alt"></i>
                    </button>
                </div>
                <div class="start-creating">START CREATING NOW...!</div>
                <div class="action-buttons">
                    <button class="action-button">
                        <i class="fas fa-qrcode"></i>
                        add Linkan
                    </button>
                    <button class="action-button">
                        <i class="fas fa-box"></i>
                        Digital Product
                    </button>
                    <button class="action-button">
                        <i class="fas fa-headset"></i>
                        Support
                    </button>
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
                        <i class="fas fa-calendar"></i>
                        Select Date..
                    </button>
                </div>
                <div class="stats-numbers">
                    <span>Views: {{ $totalViews }}</span>
                    <span>Clicks: {{ $totalClicks }}</span>
                </div>
                <div class="stats-chart">
                    <canvas id="statsChart"></canvas>
                </div>
            </div>

            <div class="summary-section">
                <div class="summary-card">
                    <i class="fas fa-shopping-cart"></i>
                    <div class="label">Lifetime Orders</div>
                    <div class="number">{{ $lifetimeOrders }}</div>
                </div>
                <div class="summary-card">
                    <i class="fas fa-users"></i>
                    <div class="label">Affiliate Product</div>
                    <div class="number">{{ $affiliateProducts }}</div>
                </div>
                <div class="summary-card">
                    <i class="fas fa-chart-line"></i>
                    <div class="label">Lifetime sales (IDR)</div>
                    <div class="number">{{ number_format($lifetimeSales, 0, ',', '.') }}</div>
                </div>
                <div class="summary-card">
                    <i class="fas fa-box"></i>
                    <div class="label">My Blocks</div>
                    <div class="number">{{ $totalProducts }}</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('statsChart').getContext('2d');
        let myChart;

        function updateChart(date = null) {
            fetch(`/get-chart-data${date ? '?date=' + date : ''}`)
                .then(response => response.json())
                .then(data => {
                    if (myChart) {
                        myChart.destroy();
                    }

                    myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Views',
                                data: data.views,
                                backgroundColor: '#ff4500',
                                borderRadius: 4,
                                maxBarThickness: 12
                            }, {
                                label: 'Clicks',
                                data: data.clicks,
                                backgroundColor: '#4a90e2',
                                borderRadius: 4,
                                maxBarThickness: 12
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: '#f0f0f0'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'top',
                                    align: 'start',
                                    labels: {
                                        boxWidth: 12,
                                        usePointStyle: true,
                                        pointStyle: 'circle'
                                    }
                                }
                            }
                        }
                    });
                });
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Link copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }

        document.querySelector('.date-selector').addEventListener('click', function() {
            const input = document.createElement('input');
            input.type = 'date';
            input.style.display = 'none';
            document.body.appendChild(input);
            
            input.addEventListener('change', function() {
                updateChart(this.value);
                document.body.removeChild(input);
            });
            
            input.click();
        });

        document.addEventListener('DOMContentLoaded', function() {
            updateChart();
        });
    </script>
</body>
</html>