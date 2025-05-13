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

    <!-- Modal Popup -->
<div id="cartModal" style="display: none; position: fixed; z-index: 999; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);">
   <div style="background: white; margin: 10% auto; padding: 20px; border-radius: 10px; width: 90%; max-width: 400px; position: relative;">

        <!-- Tombol X (Close) -->
        <button onclick="closeModal()" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none; font-size: 22px; cursor: pointer;">&times;</button>
        <h3>Cart (1)</h3>
        <div style="display: flex; gap: 10px; align-items: center;">
            <img id="modalImage" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" style="width: 50px; height: 50px; object-fit: cover;">
            <div style="flex: 1;">
                <div id="modalTitle">{{ $product->title }}</div>
                <div>Qty: <span id="modalQty">1</span></div>
                <div>Rp <span id="modalPrice">{{ number_format($product->price, 0, ',', '.') }}</span></div>
                <button id="editButton" style="background: none; color: blue; border: none; cursor: pointer;">Edit</button>
            </div>
        </div>

        <div id="editSection" style="display: none; margin-top: 10px;">
            <label for="qtyInput">Quantity:</label>
            <input type="number" id="qtyInput" value="1" min="1" style="width: 100%; padding: 5px; margin: 5px 0;">
            <div style="display: flex; justify-content: space-between;">
                <button id="cancelEdit" style="padding: 5px 10px; background: #ccc; border: none;">Cancel</button>
                <button id="updateQty" style="padding: 5px 10px; background: orange; border: none; color: white;">Update</button>
            </div>
        </div>

        <hr style="margin: 15px 0;">
        <div style="font-size: 14px;">
            Total (Items): Rp <span id="totalItem">{{ number_format($product->price, 0, ',', '.') }}</span><br>
            Grand Total: <strong>Rp <span id="grandTotal">{{ number_format($product->price, 0, ',', '.') }}</span></strong>
        </div>

        <button onclick="closeModal()" style="margin-top: 15px; width: 100%; padding: 10px; background: orange; color: white; border: none; border-radius: 5px;">Checkout</button>
    </div>
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
<script>
     const buyButton = document.querySelector('.buy-button');
    const cartModal = document.getElementById('cartModal');
    const editButton = document.getElementById('editButton');
    const editSection = document.getElementById('editSection');
    const cancelEdit = document.getElementById('cancelEdit');
    const updateQty = document.getElementById('updateQty');
    const qtyInput = document.getElementById('qtyInput');
    const modalQty = document.getElementById('modalQty');
    const totalItem = document.getElementById('totalItem');
    const grandTotal = document.getElementById('grandTotal');

    const price = {{ $product->price }};

    buyButton.addEventListener('click', function(e) {
        e.preventDefault();
        cartModal.style.display = 'block';
    });

    editButton.addEventListener('click', function() {
        editSection.style.display = 'block';
    });

    cancelEdit.addEventListener('click', function() {
        editSection.style.display = 'none';
    });

    updateQty.addEventListener('click', function() {
        const qty = parseInt(qtyInput.value);
        if (qty > 0) {
            modalQty.textContent = qty;
            const total = price * qty;
            totalItem.textContent = formatRupiah(total);
            grandTotal.textContent = formatRupiah(total);
        }
        editSection.style.display = 'none';
    });

    function closeModal() {
        cartModal.style.display = 'none';
    }

    function formatRupiah(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    </script>

<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" crossorigin="anonymous"></script>

</body>
</html>
