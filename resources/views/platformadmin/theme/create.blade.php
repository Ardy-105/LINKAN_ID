<!DOCTYPE html>
<html>
<head>
    <title>Tambah Theme - Admin Platform</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f9f9f9;
        }
        .content {
            flex: 1;
            padding: 40px;
            min-height: 100vh;
        }
        form {
            background: #fff;
            border-radius: 20px;
            padding: 40px 32px 32px 32px;
            box-shadow: 0 6px 32px rgba(80, 80, 120, 0.10), 0 1.5px 6px rgba(80,80,120,0.06);
            max-width: 600px;
            margin: 0 auto;
            transition: box-shadow 0.3s;
        }
        h2 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 32px;
            letter-spacing: -1px;
            color: #222;
            text-align: center;
        }
        .btn { border-radius: 8px; }
        .form-label {
            font-size: 0.95rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #444;
            margin-bottom: 6px;
        }
        .form-control {
            border-radius: 10px;
            border: 1.5px solid #e0e7fd;
            padding: 12px 14px;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            margin-bottom: 18px;
        }
        .form-control:focus {
            border-color: #6c63ff;
            box-shadow: 0 0 0 2px #e0e7fd;
            outline: none;
        }
        .btn-primary {
            background: linear-gradient(90deg, #ff9040 0%, #ff7f2a 100%);
            border: none;
            color: #fff;
            font-weight: 700;
            font-size: 1.08rem;
            padding: 12px 32px;
            border-radius: 10px;
            margin-right: 10px;
            margin-top: 10px;
            box-shadow: 0 2px 8px rgba(255, 127, 42, 0.08);
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #ff7f2a 0%, #ff9040 100%);
            box-shadow: 0 4px 16px rgba(255, 127, 42, 0.13);
            transform: translateY(-2px) scale(1.03);
        }
        .btn-secondary {
            background: #fff6ef;
            color: #ff7f2a;
            font-weight: 600;
            border: none;
            font-size: 1.08rem;
            padding: 12px 28px;
            border-radius: 10px;
            margin-top: 10px;
            transition: background 0.2s, color 0.2s, transform 0.1s;
        }
        .btn-secondary:hover {
            background: #ffe0c2;
            color: #222;
            transform: translateY(-1px) scale(1.02);
        }
        .mb-3 {
            margin-bottom: 22px !important;
        }
        @media (max-width: 700px) {
            .content { padding: 10px; margin-left: 0; }
            form { padding: 16px 6px; }
            h2 { font-size: 1.2rem; }
        }
    </style>
</head>
<body>
    @include('platformadmin.sidebar.sidebarplatform')
    <div class="content">
        <h2>Tambah Theme</h2>
        <form action="{{ route('platformadmin.theme.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Theme</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="preview_image" class="form-label">Preview Image</label>
                <input type="file" name="preview_image" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="background_image" class="form-label">Background Image</label>
                <input type="file" name="background_image" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('platformadmin.theme.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html> 