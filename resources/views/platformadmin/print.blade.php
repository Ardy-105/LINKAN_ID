<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .print-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .print-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .print-content {
            margin-bottom: 20px;
        }
        .print-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="print-container">
        <div class="print-header">
            <h1>Platform Admin Report</h1>
            <p>Generated on: {{ date('Y-m-d H:i:s') }}</p>
        </div>

        <div class="print-content">
            @if(isset($data) && !empty($data))
                @foreach($data as $key => $value)
                    <div class="data-row">
                        <strong>{{ ucfirst($key) }}:</strong> {{ $value }}
                    </div>
                @endforeach
            @else
                <p>No data available to print.</p>
            @endif
        </div>

        <div class="print-footer">
            <p>© {{ date('Y') }} Linkan.ID - Platform Admin</p>
        </div>

        <div class="no-print" style="text-align: center; margin-top: 20px;">
            <button onclick="window.print()">Print</button>
            <button onclick="window.close()">Close</button>
        </div>
    </div>
</body>
</html>
