<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->title }} - Detail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Global Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background: #f9f9f9;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        /* Product Wrapper */
        .product-wrapper {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            min-height: 100vh;
            overflow: hidden; /* Prevents overflow */
        }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .header a {
            text-decoration: none;
            color: orange;
            font-size: 24px;
        }
        .username {
            font-weight: bold;
            color: orange;
            font-size: 18px;
        }

        /* Product Image */
        .product-image {
            width: 100%;
            height: 220px;
            background: #eee;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 15px;
        }
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Product Title and Price */
        .title-price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .product-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
        .product-price {
            font-size: 16px;
            font-weight: bold;
            color: orange;
        }

        /* Description */
        .description-label {
            font-size: 10px;
            font-weight: bold;
            color: #888;
            margin-bottom: 4px;
        }
        .product-description {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        /* Buy Button */
        .buy-button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: orange;
            color: white;
            text-align: center;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            text-decoration: none;
            margin-top: 20px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<div class="product-wrapper">
    <div class="header">
        <a href="{{ route('public.profile', ['username' => $user->username]) }}">
            <i class="fa fa-arrow-left"></i> <!-- Ganti dengan kode ini -->
        </a>
        <div class="username">{{ $user->username }}</div>
    </div>

    <div class="product-image">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}">
        @else
            <img src="https://via.placeholder.com/400x200?text=No+Image" alt="No image">
        @endif
    </div>

    <div class="title-price">
        <div class="product-title">{{ $product->title }}</div>
        <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
    </div>

    <div class="description-label">DESCRIPTION :</div>
    <div class="product-description">{{ $product->description }}</div>

    <a href="{{ $product->platform_url ?? '#' }}" class="buy-button" target="_blank">
        {{ $product->button_text ?? 'Beli' }}
    </a>
</div>

<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" crossorigin="anonymous"></script>

</body>
</html>
