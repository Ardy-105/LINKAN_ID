<!DOCTYPE html>

@php
    $savedQty = session("cart.qty.{$product->id}", 1); // default 1 jika tidak ada di session
@endphp

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
        .select-method { padding: 10px; border: 1px solid #ccc; border-radius: 4px; background: #f0f0f0; cursor: pointer; margin-top: 10px; text-align: center; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('SB-Mid-client-LDeBzOGR_X-yS9q1') }}"></script>
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
               <div>Qty: <strong>{{ $savedQty }}</strong></div>
                <div>Rp {{ number_format($product->price, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <!-- Buyer Info + Payment Section -->
    <form id="checkout-form">
        <div class="section">
            <div class="section-title">Buyer Info</div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" required placeholder="Your Email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label>Name *</label>
                <input type="text" name="name" required placeholder="Your Name" value="{{ old('name') }}">
            </div>
            <input type="hidden" name="qty" value="1"><input type="hidden" name="qty" value="{{ $savedQty }}">

        </div>

        <div class="section payment">
            <div class="section-title">Payment Detail</div>
            <div style="display: flex; justify-content: space-between;">
                <span>Subtotal</span><span>Rp {{ number_format($product->price *  $savedQty, 0, ',', '.') }}</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span>Total</span><span><strong>Rp {{ number_format($product->price *  $savedQty, 0, ',', '.') }}</strong></span>
            </div>
            <div class="select-method" id="select-method">Select payment method</div>
            <button id="pay-button" class="btn-buy" style="margin-top: 10px;" type="button">BUY NOW - Rp {{ number_format($product->price *  $savedQty, 0, ',', '.') }}</button>
        </div>
    </form>
</div>

<script>
    let paymentSelected = false;
    let transactionResult = null;

    const payButton = document.getElementById('pay-button');
    const emailInput = document.querySelector('input[name="email"]');
    const nameInput = document.querySelector('input[name="name"]');

    document.getElementById('select-method').addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                Swal.fire('Sukses', 'Pembayaran berhasil!', 'success');
                paymentSelected = true;
                transactionResult = result;
            },
            onPending: function(result) {
                Swal.fire('Menunggu', 'Pembayaran sedang diproses...', 'info');
                paymentSelected = true;
                transactionResult = result;
            },
            onError: function(result) {
                Swal.fire('Gagal', 'Terjadi kesalahan dalam pembayaran.', 'error');
                console.log(result);
            },
            onClose: function() {
                Swal.fire('Perhatian', 'Kamu belum memilih metode pembayaran.', 'warning');
            }
        });
    });

    payButton.addEventListener('click', function (e) {
        e.preventDefault();

        const email = emailInput.value.trim();
        const name = nameInput.value.trim();

        if (email === '') {
            Swal.fire('Oops!', 'Email tidak boleh kosong.', 'warning');
            emailInput.focus();
            return;
        }

        if (name === '') {
            Swal.fire('Oops!', 'Nama tidak boleh kosong.', 'warning');
            nameInput.focus();
            return;
        }

        if (!paymentSelected) {
            Swal.fire('Oops!', 'Silakan pilih metode pembayaran terlebih dahulu.', 'warning');
            return;
        }

        Swal.fire('Diproses', 'Pembayaran sedang diproses...', 'success');
        console.log(transactionResult);
    });
</script>
</body>
</html>
