<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f8f9fc;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .order-header {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .link-share {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
        }

        .linkan-url {
            background: #f5f5f5;
            padding: 8px 15px;
            border-radius: 5px;
            flex-grow: 1;
            color: #666;
            font-weight: 600;
            font-size: 16px;
            border: 1px solid #e0e0e0;
        }

        .btn-share {
            background-color: #FFA86A;
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            color: #fff;
            font-size: 15px;
            box-shadow: 0 2px 6px rgba(255,168,106,0.08);
        }

        .order-content {
            display: flex;
            gap: 30px;
        }

        .product-orders {
            flex: 1.2;
            background-color: #fff;
            border-radius: 12px;
            padding: 25px 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            min-width: 350px;
        }

        .order-details {
            flex: 1;
            background-color: #bdbdbd;
            border-radius: 12px;
            padding: 40px 20px;
            text-align: center;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .order-details .icon-detail {
            font-size: 54px;
            margin-bottom: 18px;
            color: #666;
        }

        .order-details p {
            color: #444;
            font-size: 17px;
        }

        .order-details strong {
            color: #222;
        }

        .product-orders h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .filter-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .btn-download {
            background-color: #FFA86A;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            font-size: 18px;
        }

        select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #e0e0e0;
            margin-bottom: 10px;
        }

        .search-bar {
            margin-bottom: 10px;
            display: flex;
            gap: 5px;
        }

        .search-bar input {
            flex: 1;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #e0e0e0;
        }

        .order-item {
            display: flex;
            align-items: center;
            background-color: #f7f7f7;
            padding: 12px 16px;
            border-radius: 8px;
            margin-top: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
            gap: 10px;
        }

        .order-item .icon {
            font-size: 22px;
            color: #FFA86A;
            margin-right: 8px;
        }

        .order-item .title {
            font-size: 16px;
            font-weight: 600;
            color: #444;
            flex: 1;
        }

        .order-item .dots {
            font-size: 22px;
            color: #bbb;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container">
        @include('homeadminS.sidebar.sidebar')
        <div class="main-content">
            <div class="header">
                <h2 class="order-header">Order History</h2>
            </div>

            <div class="link-share">
                <div class="linkan-url">
                    <a href="{{ url('/linkan.id/' . Auth::user()->username) }}" style="color: #FF9040;">
                        {{ url('/linkan.id/' . Auth::user()->username) }}
                    </a>
                </div>
                <button class="btn-share">Share</button>
            </div>
            <div class="order-content">
                <div class="product-orders">
                    <h3>Product Orders</h3>
                    <div class="filter-bar">
                        <input type="date">
                        <button class="btn-download">⬇</button>
                    </div>
                    <select>
                        <option>All Transaction</option>
                    </select>
                    <div class="search-bar">
                        <input type="text" placeholder="Product Title">
                        <input type="text" placeholder="Select date range and keyword type for search">
                    </div>
                    <div class="order-item">
                        <div class="icon"><i class="fas fa-box"></i></div>
                        <div class="title">Coming Soon</div>
                        <div class="dots"><i class="fas fa-ellipsis-v"></i></div>
                    </div>
                    <div class="order-item">
                        <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                        <div class="title">Coming Soon</div>
                        <div class="dots"><i class="fas fa-ellipsis-v"></i></div>
                    </div>
                </div>
                <div class="order-details">
                    <div class="icon-detail">📋</div>
                    <p>Your transaction detail will appear here.<br>
                    Click <strong>Detail</strong> button on the left side</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>