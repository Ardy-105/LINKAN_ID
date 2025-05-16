<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verification Content</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f9f9f9;
        }

        /* Sidebar Style */
        .sidebar {
            width: 220px;
            background-color: #dbe7fd;
            padding: 20px;
            min-height: 100vh;
            border-top-right-radius: 40px;
            display: flex;
            flex-direction: column;
        }

        .menu-title {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px;
            text-decoration: none;
            color: #000;
            font-weight: 500;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .sidebar a.active {
            background-color: white;
            font-weight: 700;
        }

        .sidebar a:hover {
            background-color: #e1ecfa;
        }

        .content {
            flex: 1;
            padding: 40px;
        }

        .header {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .tabs {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .tab {
            border: none;
            background: none;
            font-weight: 600;
            cursor: pointer;
            padding: 8px 0;
            position: relative;
        }

        .tab::after {
            content: '';
            height: 3px;
            background: #000;
            width: 0;
            position: absolute;
            left: 0;
            bottom: -5px;
            transition: width 0.3s;
        }

        .tab.active::after {
            width: 100%;
        }

        .date-filter {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .date-input {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            background-color: #e4e4e4;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            font-weight: 600;
        }

        tr:not(:last-child) {
            border-bottom: 1px solid #eee;
        }

        .content-preview {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .content-preview img {
            width: 80px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.2);
        }

        .status-completed {
            color: green;
            font-weight: 600;
        }

        .status-pending {
            color: red;
            font-weight: 600;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn.accepted {
            background-color: #555;
            color: white;
        }

        .btn.accept {
            background-color: #ff6600;
            color: white;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    @include('platformadmin.sidebar.sidebarplatform')

    {{-- Main Content --}}
    <div class="content">
        <div class="header">Verification Content</div>

        {{-- Tabs --}}
        <div class="tabs">
            <button class="tab active">All Request</button>
            <button class="tab">Pending</button>
            <button class="tab">Completed</button>
        </div>

        {{-- Date Filter --}}
        <div class="date-filter">
            <input type="date" class="date-input">
        </div>

        {{-- Table --}}
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Content</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.</td>
                        <td>Budi</td>
                        <td>
                            <div class="content-preview">
                                <img src="https://via.placeholder.com/80x50.png?text=Pembelajaran" alt="Pembelajaran">
                                <span>Pembelajaran</span>
                            </div>
                        </td>
                        <td>15 Aug 2025</td>
                        <td><span class="status-completed">● Completed</span></td>
                        <td><button class="btn accepted">Accepted</button></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Fajar</td>
                        <td>
                            <div class="content-preview">
                                <img src="https://via.placeholder.com/80x50.png?text=Shopee" alt="Shopee">
                                <span>Shopee Affiliate</span>
                            </div>
                        </td>
                        <td>17 Aug 2025</td>
                        <td><span class="status-pending">● Pending</span></td>
                        <td><button class="btn accept">Accept</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
