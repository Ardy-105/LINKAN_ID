<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Linkan - Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
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
    gap: 20px; /* Tambahan opsional untuk jarak antar elemen */
}


        .main-content {
            flex: 1;
            padding: 20px;
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

    

        .settings-icon {
            color: #666;
            cursor: pointer;
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
        }

        .drag-handle {
            color: #666;
            cursor: move;
        }

        .block-icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FF9040;
        }

        .block-title {
            flex-grow: 1;
            color: #333;
        }

        .block-actions {
            color: #666;
            cursor: pointer;
        }

        /* Preview Section */
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

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            backdrop-filter: blur(5px);
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

        /* Blur effect when modal is open */
        body.modal-open .container {
            filter: blur(5px);
            pointer-events: none;
            transition: filter 0.3s ease;
        }

        body.modal-open {
            overflow: hidden;
        }

        /* Coming Soon Block */
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
            <div class="header">
                <h1>My Linkan</h1>
                <div class="notification-icon">
                    <i class="fas fa-bell"></i>
                </div>
            </div>

            <div class="my-linkan-header">
                <div class="my-linkan-url">
                    My Linkan: <a href="https://Linkan.id/{{ Auth::user()->username }}" style="color: #FF9040;">
                    https://Linkan.id/{{ Auth::user()->username }}
                </a>
                </div>
                <button class="share-button">
                    <i class="fas fa-share-alt"></i>
                </button>
            </div>

            <button class="home-button">Home</button>

            <button class="add-block-button" onclick="showAddBlockModal()">
                <i class="fas fa-plus"></i>
                Add new block
            </button>
                        @if($digitalProducts->count())
                <div class="block-list">
                    <h3 style="margin-bottom: 10px; color: #333;">Produk Digital Terbaru</h3>
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

    <!-- Modal untuk Add New Block -->
    <div id="addBlockModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add new block</h2>
                <button class="close-button" onclick="closeModal()">×</button>
            </div>
            <div class="modal-body">
                <div class="block-option" onclick="selectBlockType('digital')">
                    <div class="block-icon">
                        <img src="{{ asset('images/productdigital.png') }}" alt="Digital Product">
                    </div>
                    <div class="block-info">
                        <h3>Digital Product</h3>
                        <p>Sell Digital Products</p>
                    </div>
                </div>

                <div class="block-option" onclick="selectBlockType('donation')">
                    <div class="block-icon">
                        <img src="{{ asset('images/donasi.png') }}" alt="Donation">
                    </div>
                    <div class="block-info">
                        <h3>Donation</h3>
                        <p>Accept Donation from your followers</p>
                    </div>
                </div>

                <div class="block-option" onclick="selectBlockType('course')">
                    <div class="block-icon">
                        <img src="{{ asset('images/e-course.png') }}" alt="E-Course">
                    </div>
                    <div class="block-info">
                        <h3>E-Course</h3>
                        <p>Share your skills and knowledge</p>
                    </div>
                </div>

                <div class="block-option coming-soon">
                    <div class="block-icon">
                        <i class="fas fa-question" style="color: #FF9040; font-size: 24px;"></i>
                    </div>
                    <div class="block-info">
                        <h3>COMMING SOON</h3>
                        <p>Let's see</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="actionModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Action</h2>
            <button class="close-button" onclick="closeActionModal()">×</button>
        </div>
        <div class="modal-body">
            <!-- Tombol Edit -->
            <a href="#" id="editButton" class="add-block-button" style="background-color: #FF9040; margin-bottom: 10px; text-decoration: none; text-align: center;">Edit</a>
            <!-- Tombol Delete -->
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="button" class="add-block-button" style="background-color: #e3342f;" onclick="confirmDelete()">Delete</button>
            </form>
        </div>
    </div>
</div>


<div id="confirmDeleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Konfirmasi Hapus</h2>
            <button class="close-button" onclick="closeConfirmDeleteModal()">×</button>
        </div>
        <div class="modal-body">
            <p id="deleteMessage" style="margin-bottom: 20px;"></p>
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button onclick="closeConfirmDeleteModal()" class="add-block-button" style="background-color: gray;">No</button>
                <form id="finalDeleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="add-block-button" style="background-color: #e3342f;">Yes</button>
                </form>
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

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                closeModal();
            }
        }

        function selectBlockType(type) {
            switch(type) {
                case 'digital':
                    window.location.href = "{{ route('digital-product.create') }}";
                    break;
                case 'donation':
                    // Akan ditambahkan nanti
                    break;
                case 'course':
                    // Akan ditambahkan nanti
                    break;
            }
        }

        function showActionModal(productId, productTitle) {
            // Simpan ID dan judul produk untuk keperluan penghapusan
            window.currentDeleteId = productId;
            window.currentDeleteTitle = productTitle;

            // Set action tombol Delete untuk modal
            document.getElementById('deleteForm').action = `/digital-product/${productId}`;
            
            // Set URL tombol Edit
            document.getElementById('editButton').href = `/digital-product/${productId}/edit`;

            // Tampilkan modal
            document.getElementById('actionModal').style.display = 'block';
            document.body.classList.add('modal-open');
        }

        function closeActionModal() {
            // Menutup modal
            document.getElementById('actionModal').style.display = 'none';
            document.body.classList.remove('modal-open');
        }

        function confirmDelete() {
            // Menampilkan pesan konfirmasi
            const title = window.currentDeleteTitle;
            const productId = window.currentDeleteId;

            document.getElementById('deleteMessage').innerText = `Apakah kamu yakin ingin menghapus produk "${title}"?`;
            document.getElementById('finalDeleteForm').action = `/digital-product/${productId}`;

            // Menutup modal sebelumnya dan menampilkan konfirmasi hapus
            closeActionModal();
            document.getElementById('confirmDeleteModal').style.display = 'block';
            document.body.classList.add('modal-open');
        }

        function closeConfirmDeleteModal() {
            document.getElementById('confirmDeleteModal').style.display = 'none';
            document.body.classList.remove('modal-open');
        }
    </script>
</body>
</html>
