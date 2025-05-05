<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Shortlink</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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


        form input, form button {
            font-size: 14px;
        }
        input[type="text"], input[type="url"] {
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            border: 1px solid #ddd;
            background: #f9f9f9;
            margin-top: 5px;
        }
        label {
            font-weight: bold;
            font-size: 14px;
        }
        button {
            padding: 12px;
            background-color: hsl(25, 100%, 63%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }
        .success-message {
            color: green;
            font-weight: 500;
            margin-bottom: 15px;
        }
        .error-message {
            color: red;
            font-size: 12px;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
     <div class="container">
        @include('homeadminS.sidebar.sidebar')

        <div class="main-content">
            <div class="header">
                <h1>Buat Shortlink</h1>
                <div class="notification-icon">
                    <i class="fas fa-bell"></i>
                </div>
            </div>

            <div class="account-section" style="margin-top: 30px;">
                @if(session('success'))
                @php
                    $shortUrl = explode(': ', session('success'))[1] ?? '';
                @endphp
                <div class="success-message">
                    Shortlink berhasil dibuat:
                    <div style="display: flex; margin-top: 10px; max-width: 100%;">
                        <input id="shortlinkInput" type="text" value="{{ $shortUrl }}" readonly
                            style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 8px 0 0 8px; font-size: 14px;">
                        <button onclick="copyToClipboard()" style="padding: 10px 20px; background: hsl(25, 100%, 63%); color: white; border: none; border-radius: 0 8px 8px 0; cursor: pointer;">
                            Copy URL
                        </button>
                    </div>
                    <div style="margin-top: 5px;">
                        Long URL: <strong>{{ old('destination') }}</strong>
                    </div>
                </div>
            @endif
            

                <form action="{{ url('/shorten') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="slug">Nama Shortlink</label>
                        <input type="text" name="slug" id="slug" required placeholder="Contoh: fajar">
                        @error('slug')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="destination">Tujuan URL</label>
                        <input type="url" name="destination" id="destination" required placeholder="Contoh: https://youtube.com/...">
                        @error('destination')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit">🔗 Buat Shortlink</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function copyToClipboard() {
            const input = document.getElementById("shortlinkInput");
            input.select();
            input.setSelectionRange(0, 99999); // For mobile
            document.execCommand("copy");
    
            alert("Shortlink berhasil disalin ke clipboard!");
        }
    </script>
    
</body>
</html>
