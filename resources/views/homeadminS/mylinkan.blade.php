<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Linkan - Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
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
            gap: 20px;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            display: flex;
            gap: 20px;
        }

        .content-left {
            flex: 1;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .my-linkan-header {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .my-linkan-url {
            background: #f5f5f5;
            padding: 8px 15px;
            border-radius: 5px;
            flex-grow: 1;
            color: #666;
        }

        .share-button {
            background: none;
            border: none;
            color: #FF9040;
            cursor: pointer;
            padding: 5px;
        }

        .your-pages {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .your-pages h2 {
            font-size: 18px;
            color: #333;
        }

        .settings-icon {
            color: #666;
            cursor: pointer;
        }

        .search-box {
            position: relative;
            margin-bottom: 15px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding-right: 40px;
        }

        .search-box .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .home-button {
            background: #FF9040;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 15px;
            border: none;
            cursor: pointer;
        }

        .add-block-button {
            background: #FF9040;
            color: white;
            padding: 12px;
            border-radius: 10px;
            border: none;
            width: 100%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .block-list {
            margin-top: 20px;
        }

        .block-item {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .block-item:hover {
            transform: translateY(-2px);
        }

        .drag-handle {
            color: #666;
            cursor: move;
        }

        .block-icon {
            width: 40px;
            height: 40px;
            background: #FFE5D3;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .block-icon i {
            color: #FF9040;
        }

        .block-title {
            flex-grow: 1;
            font-size: 16px;
            color: #333;
        }

        .block-actions {
            color: #666;
        }

        .preview-section {
            background: #eee;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            height: fit-content;
        }

        .preview-header {
            margin-bottom: 15px;
            color: #666;
        }

        .phone-preview {
            background: white;
            border-radius: 40px;
            padding: 20px;
            width: 100%;
            aspect-ratio: 9/19;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .phone-content {
            width: 100%;
            height: 100%;
            background: #f0f0f0;
            border-radius: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 50px;
        }

        .profile-circle {
            width: 80px;
            height: 80px;
            background: #ddd;
            border-radius: 50%;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .profile-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-name {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .preview-products {
            width: 100%;
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .preview-product-item {
            background: white;
            border-radius: 8px;
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .preview-product-image {
            width: 40px;
            height: 40px;
            background: #FFE5D3;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .preview-product-image i {
            color: #FF9040;
            font-size: 20px;
        }

        .preview-product-info {
            flex: 1;
        }

        .preview-product-title {
            font-size: 14px;
            color: #333;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .preview-product-button {
            background: #FF9040;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            border: none;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            width: 400px;
            border-radius: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            overflow: hidden;
        }

        .modal-header {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
        }

        .modal-header h2 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .close-button {
            background: none;
            border: none;
            font-size: 24px;
            color: #666;
            cursor: pointer;
            padding: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-body {
            padding: 20px;
        }

        .block-option {
            display: flex;
            align-items: center;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .block-option:hover {
            background-color: #f5f5f5;
        }

        .block-option .block-icon {
            width: 48px;
            height: 48px;
            background: #FFE5D3;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .block-option .block-icon img {
            width: 24px;
            height: 24px;
            object-fit: contain;
        }

        .block-option .block-info h3 {
            font-size: 16px;
            margin-bottom: 5px;
            color: #333;
        }

        .block-option .block-info p {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        body.modal-open .container {
            filter: blur(5px);
            pointer-events: none;
            transition: filter 0.3s ease;
        }

        body.modal-open {
            overflow: hidden;
        }

        .block-option.coming-soon {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .block-option.coming-soon .block-icon {
            background: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container">
        @include('homeadminS.sidebar.sidebar')

        <div class="main-content">
            <div class="content-left">
                <div class="header">
                    <h1>My Linkan</h1>
                    <div class="notification-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                </div>

                <div class="my-linkan-header">
                    <div class="my-linkan-url">My Linkan: https://Linkan.id/{{ Auth::user()->username }}</div>
                    <button class="share-button" onclick="copyToClipboard('https://Linkan.id/{{ Auth::user()->username }}')">
                        <i class="fas fa-share-alt"></i>
                    </button>
                </div>

                <div class="your-pages">
                    <h2>Your Pages</h2>
                    <i class="fas fa-cog settings-icon"></i>
                </div>

                <div class="search-box">
                    <input type="text" placeholder="Paste Long URL here">
                    <i class="fas fa-search search-icon"></i>
                </div>

                <a href="{{ route('beranda.admins') }}" class="home-button">Home</a>

                <button class="add-block-button" onclick="showAddBlockModal()">
                    <i class="fas fa-plus"></i>
                    Add new block
                </button>

                @if($digitalProducts->count() > 0)
                    <div class="block-list">
                        <h3 style="margin-bottom: 10px; color: #333;">Produk Digital Anda</h3>
                        @foreach($digitalProducts as $product)
                            <div class="block-item" onclick="showActionModal({{ $product->id }}, '{{ $product->title }}')">
                                <i class="fas fa-grip-vertical drag-handle"></i>
                                <div class="block-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="block-title">{{ $product->title }}</div>
                                <div class="block-actions">
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="block-list">
                        <p style="text-align: center; color: #666; margin-top: 20px;">Belum ada produk digital. Tambahkan produk baru dengan menekan tombol "Add new block" di atas.</p>
                    </div>
                @endif
            </div>

            <!-- Preview Section -->
            <div class="preview-section">
                <div class="preview-header">
                    <h3>Page Preview</h3>
                </div>
                <div class="phone-preview">
                    <div class="phone-content">
                        <div class="profile-circle">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile">
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                        </div>
                        <div class="preview-name">{{ Auth::user()->name }}</div>
                        @if(Auth::user()->bio)
                            <p style="color: #666; font-size: 14px; text-align: center;">{{ Auth::user()->bio }}</p>
                        @endif

                        @if($digitalProducts->count() > 0)
                            <div class="preview-products">
                                @foreach($digitalProducts as $product)
                                    <div class="preview-product-item">
                                        <div class="preview-product-image">
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                                            @else
                                                <i class="fas fa-file-alt"></i>
                                            @endif
                                        </div>
                                        <div class="preview-product-info">
                                            <div class="preview-product-title">{{ $product->title }}</div>
                                        </div>
                                        <button class="preview-product-button">{{ $product->button_text ?? 'Beli' }}</button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Add New Block -->
    <div id="addBlockModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add new block</h2>
                <button class="close-button" onclick="closeModal()">×</button>
            </div>
            <div class="modal-body">
                <div class="block-option" onclick="window.location.href='{{ route('digital-product.create') }}'">
                    <div class="block-icon">
                        <img src="{{ asset('images/productdigital.png') }}" alt="Digital Product">
                    </div>
                    <div class="block-info">
                        <h3>Digital Product</h3>
                        <p>Sell Digital Products</p>
                    </div>
                </div>

                <div class="block-option coming-soon">
                    <div class="block-icon">
                        <img src="{{ asset('images/donasi.png') }}" alt="Donation">
                    </div>
                    <div class="block-info">
                        <h3>Donation</h3>
                        <p>Accept Donation from your followers</p>
                    </div>
                </div>

                <div class="block-option coming-soon">
                    <div class="block-icon">
                        <img src="{{ asset('images/e-course.png') }}" alt="E-Course">
                    </div>
                    <div class="block-info">
                        <h3>E-Course</h3>
                        <p>Share your skills and knowledge</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showAddBlockModal() {
            document.getElementById('addBlockModal').style.display = 'block';
            document.body.classList.add('modal-open');
        }

        function closeModal() {
            document.getElementById('addBlockModal').style.display = 'none';
            document.body.classList.remove('modal-open');
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Link berhasil disalin!');
            }).catch(err => {
                console.error('Gagal menyalin link:', err);
            });
        }

        function showActionModal(productId, productTitle) {
            // Implementasi modal untuk aksi produk
            console.log('Product ID:', productId, 'Title:', productTitle);
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('addBlockModal')) {
                closeModal();
            }
        }
    </script>
</body>
</html>
