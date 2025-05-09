<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $appearance->name ?? $user->name }} | Linkan.id</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            padding: 30px;
            min-height: 100vh;
            margin: 0;
        }

        .content-wrapper {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background-image: url('{{ $appearance && $appearance->background_color ? asset('images/background/' . $appearance->background_color) : '' }}');
            background-size: cover;
            background-position: center;
        }

        .preview-banner {
            width: 100%;
            height: 120px;
            background: #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .preview-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-profile {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #ddd;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .preview-profile img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            text-align: center;
            color: {{ $appearance->theme_color ?? '#FF9040' }};
        }

        .preview-bio {
            font-size: 14px;
            color: {{ $appearance->theme_color ?? '#FF9040' }};
            text-align: center;
            margin-bottom: 15px;
            padding: 0 20px;
            line-height: 1.4;
        }

        .preview-social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .preview-social-links a {
            color: {{ $appearance->theme_color ?? '#FF9040' }};
            font-size: 20px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .preview-social-links a:hover {
            opacity: 0.8;
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
            overflow: hidden;
            flex-shrink: 0;
        }

        .preview-product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
            background: {{ $appearance->theme_color ?? '#FF9040' }};
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            border: none;
            cursor: pointer;
            flex-shrink: 0;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        @if($appearance->banner)
            <div class="preview-banner">
                <img src="{{ asset('storage/' . $appearance->banner) }}" alt="Banner">
            </div>
        @endif

        <div class="preview-profile">
            @if($appearance->profile_image)
                <img src="{{ asset('storage/' . $appearance->profile_image) }}" alt="Profile Image">
            @else
                <i class="fas fa-user"></i>
            @endif
        </div>

        <div class="preview-name">{{ $appearance->name ?? $user->name }}</div>
        <div class="preview-bio">{{ $appearance->bio }}</div>

        <div class="preview-social-links">
            @if($appearance->instagram)
                <a href="{{ $appearance->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
            @endif
            @if($appearance->tiktok)
                <a href="{{ $appearance->tiktok }}" target="_blank"><i class="fab fa-tiktok"></i></a>
            @endif
            @if($appearance->whatsapp)
                <a href="https://wa.me/{{ $appearance->whatsapp }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
            @endif
        </div>

        @if($products && $products->count() > 0)
            <div class="preview-products">
                @foreach($products as $product)
                    <div class="preview-product-item">
                        <div class="preview-product-image">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}">
                            @else
                                <i class="fas fa-file-alt"></i>
                            @endif
                        </div>
                        <div class="preview-product-title">{{ $product->title }}</div>
                        <a href="{{ $product->platform_url ?? '#' }}" class="preview-product-button" target="_blank">
                            {{ $product->button_text ?? 'Beli' }}
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
