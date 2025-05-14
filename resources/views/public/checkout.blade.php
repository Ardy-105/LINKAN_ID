<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        body { font-family: sans-serif; background: #f9f9f9; padding: 20px; }
        .checkout-wrapper { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 10px; }
        .section { margin-bottom: 20px; }
        .section-title { font-size: 18px; font-weight: bold; margin-bottom: 10px; }
        .product { display: flex; gap: 15px; border: 1px solid #ddd; border-radius: 8px; padding: 10px; }
        .product img { width: 60px; height: 60px; object-fit: cover; }
        .form-group { margin-bottom: 10px; }
        input { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        .payment { border-top: 1px solid #eee; padding-top: 10px; }
        .btn-buy { background: #00c194; color: white; border: none; padding: 12px; width: 100%; border-radius: 6px; font-size: 16px; cursor: pointer; }
        .select-method { padding: 10px; border: 1px solid #ccc; border-radius: 4px; background: #f0f0f0; cursor: pointer; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="checkout-wrapper">
        <!-- Product -->
        <div class="section">
            <div class="section-title">Product</div>
            <div class="product">
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
                <div>
                    <div>{{ $product->title }}</div>
                    <div>Qty: <strong>1</strong></div>
                    <div>Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        <!-- Buyer Info -->
        <div class="section">
            <div class="section-title">Buyer Info</div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" required placeholder="Your Email">
            </div>
            <div class="form-group">
                <label>Name *</label>
                <input type="text" required placeholder="Your Name">
            </div>
        </div>

        <!-- Payment Detail -->
        <div class="section payment">
            <div class="section-title">Payment Detail</div>
            <div style="display: flex; justify-content: space-between;">
                <span>Subtotal</span><span>Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span>Total</span><span><strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></span>
            </div>

            <div class="select-method">Select payment method</div>
        </div>

        <button class="btn-buy">BUY NOW - Rp {{ number_format($product->price, 0, ',', '.') }}</button>
    </div>
</body>
</html>
