<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payout History</title>
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
        @include('homeadminS.sidebar.sidebar')

        <div class="main-content">
            <div class="header">
                <h1><a href="{{ route('payout.index') }}">Payout Settings</a> &gt; <span>Payout History</h1>
            </div>

            <div class="history-table">
                <h2>Payout History</h2>

                @if ($history->isEmpty())
                    <p class="no-records">No payout records found.</p>
                @else
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
                            @foreach ($history as $record)
                                <tr>
                                    <td>{{ $record['id'] }}</td>
                                    <td>{{ $record['date'] }}</td>
                                    <td>IDR {{ number_format($record['amount'], 0, ',', '.') }}</td>
                                    <td>{{ $record['method'] }}</td>
                                    <td>
                                        <span class="status-{{ strtolower($record['status']) }}">
                                            {{ $record['status'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</body>
</html> 