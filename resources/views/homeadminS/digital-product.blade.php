<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Digital Product - Linkan</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/shared.css') }}">
    <style>
        body {
            background-color: #F8F9FE;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .page-header {
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .page-title {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .options-button {
            background: #FF9040;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .content-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: Arial, sans-serif;
        }

        textarea.form-control {
            font-family: Arial, sans-serif;
            font-size: 14px;
            resize: vertical;
            min-height: 100px;
            line-height: 1.5;
        }

        .image-upload {
            width: 100px;
            height: 100px;
            border: 1px dashed #ddd;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background: #fff;
        }

        .image-upload i {
            font-size: 24px;
            color: #666;
            margin-bottom: 5px;
        }

        .image-upload span {
            font-size: 12px;
            color: #666;
        }

        .format-info {
            font-size: 12px;
            color: #666;
            margin-top: 8px;
        }

        .platform-options {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .platform-button {
            padding: 8px 20px;
            border: none;
            border-radius: 20px;
            background: white;
            color: #FF9040;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            border: 1px solid #FF9040;
        }

        .platform-button.active {
            background: #FF9040;
            color: white;
        }

        .platform-container {
            background: #F8F9FE;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: #FF9040;
        }

        input:checked + .toggle-slider:before {
            transform: translateX(20px);
        }

        .price-group {
            display: flex;
            gap: 20px;
        }

        .price-input {
            flex: 1;
        }

        .currency-input {
            width: 100px;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .cancel-button {
            padding: 10px 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: white;
            cursor: pointer;
        }

        .add-product-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background: #FF9040;
            color: white;
            cursor: pointer;
        }

        .select-dropdown {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: white;
            cursor: pointer;
        }

        .select-file-button {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 15px;
            background: white;
            display: none;
            text-align: center;
            cursor: pointer;
            color: #FF9040;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .select-file-button i {
            margin-right: 8px;
            color: #FF9040;
        }

        #selected-file-name {
            display: inline-block;
            max-width: calc(100% - 30px);
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: middle;
            color: #FF9040;
        }
    </style>
</head>
<body>
    <div class="container">
        @include('homeadminS.sidebar.sidebar')

        <div class="main-content">
            <div class="page-header">
                <h1 class="page-title">Add Digital Product</h1>
            </div>

            <!-- ✅ Alert messages -->
            @if (session('success'))
                <div class="alert alert-success" style="background: #e0ffe0; padding: 10px; border-radius: 5px; margin-bottom: 20px; color: #007500;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" style="background: #ffe3e3; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                    <ul style="margin: 0; padding-left: 20px; color: #b30000;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            
            <form id="digitalProductForm"
      action="{{ isset($product) ? route('digital-product.update', $product->id) : route('digital-product.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if (isset($product))
        @method('PUT')
    @endif

                @csrf
                <div class="content-card">
                    <h2 class="card-title">Details</h2>

                    <div class="form-group">
                        <label>Image</label>
                        <div class="image-upload" onclick="document.getElementById('productImage').click()">
                            <i class="fas fa-image"></i>
                            <span>Add Image</span>
                        </div>
                        <div class="format-info">Format: PNG, JPEG, JPG</div>
                        <input type="file" id="productImage" name="image" accept=".png,.jpg,.jpeg" style="display: none">
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Title" value="{{ old('title') }}">
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Description">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Platform</label>
                        <div class="platform-container">
                            <div class="platform-options">
                                <button type="button" class="platform-button active" data-platform="upload">Upload</button>
                                <button type="button" class="platform-button" data-platform="dropbox">Dropbox</button>
                                <button type="button" class="platform-button" data-platform="gdrive">G-Drive</button>
                                <button type="button" class="platform-button" data-platform="other">Other</button>
                            </div>
                            <input type="hidden" name="platform_type" value="upload">
                            <input type="text" class="form-control platform-input" placeholder="Enter your URL here" name="platform_url" style="display: none;" value="{{ old('platform_url') }}">
                            <div class="select-file-button form-control" onclick="document.getElementById('platform_file').click()" style="text-align: center; cursor: pointer;">
                                <i class="fas fa-paperclip"></i> <span id="selected-file-name">Select File</span>
                            </div>
                            <input type="file" id="platform_file" name="platform_file" style="display: none;">
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <h2 class="card-title">Pricing</h2>

                    <div class="form-group">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <label style="margin: 0;">Allow Customer to pay what they want</label>
                            <!-- ✅ Hidden input + checkbox -->
                            <input type="hidden" name="pay_what_want" value="0">
                            <label class="toggle-switch">
                                <input type="checkbox" name="pay_what_want" value="1" {{ old('pay_what_want') ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="price-group">
                            <div class="price-input">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control" placeholder="0" value="{{ old('price') }}">
                            </div>
                            <div class="currency-input">
                                <label>Currency</label>
                                <input type="text" name="currency" class="form-control" value="IDR" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Sale Price (Optional)</label>
                        <input type="number" name="sale_price" class="form-control" placeholder="Sale Price" value="{{ old('sale_price') }}">
                    </div>

                    <div class="form-group">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <label style="margin: 0;">Item Quantity</label>
                            <!-- ✅ Hidden input + checkbox -->
                            <input type="hidden" name="has_quantity_limit" value="0">
                            <label class="toggle-switch">
                                <input type="checkbox" name="has_quantity_limit" value="1" {{ old('has_quantity_limit') ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div id="quantityStatus" style="color: #666; margin-bottom: 10px;">Unlimited</div>
                        <input type="number" name="quantity" class="form-control" placeholder="Enter maximum quantity" style="display: none;" value="{{ old('quantity') }}">
                    </div>

                    <div class="form-group">
                        <label>Purchase Button</label>
                        <select name="button_text" class="select-dropdown">
                            <option value="buy_now" {{ old('button_text') == 'buy_now' ? 'selected' : '' }}>Buy Now</option>
                            <option value="purchase" {{ old('button_text') == 'purchase' ? 'selected' : '' }}>Purchase</option>
                            <option value="get_now" {{ old('button_text') == 'get_now' ? 'selected' : '' }}>Get Now</option>
                        </select>
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="button" class="cancel-button" onclick="history.back()">Cancel</button>
                    <button type="submit" class="add-product-button">Add Product</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image preview
        document.getElementById('productImage').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageUpload = document.querySelector('.image-upload');
                    imageUpload.innerHTML = `<img src="${e.target.result}" style="max-width: 100%; max-height: 100%; border-radius: 5px;">`;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // Platform file selection
        document.getElementById('platform_file').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Select File';
            document.getElementById('selected-file-name').textContent = fileName;
        });

        // Platform button selection
        document.querySelectorAll('.platform-button').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.platform-button').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const platform = this.getAttribute('data-platform');
                const urlInput = document.querySelector('.platform-input');
                const fileButton = document.querySelector('.select-file-button');

                document.querySelector('input[name="platform_type"]').value = platform;

                if (platform === 'upload') {
                    urlInput.style.display = 'none';
                    fileButton.style.display = 'block';
                } else {
                    urlInput.style.display = 'block';
                    fileButton.style.display = 'none';
                }
            });
        });

        // Toggle quantity input
        const quantityToggle = document.querySelector('input[name="has_quantity_limit"]');
        const quantityInput = document.querySelector('input[name="quantity"]');
        const quantityStatus = document.querySelector('#quantityStatus');

        function toggleQuantityInput() {
            if (quantityToggle.checked) {
                quantityInput.style.display = 'block';
                quantityStatus.style.display = 'none';
            } else {
                quantityInput.style.display = 'none';
                quantityStatus.style.display = 'block';
            }
        }

        toggleQuantityInput(); // run on page load
        quantityToggle.addEventListener('change', toggleQuantityInput);
    </script>
</body>
</html>
