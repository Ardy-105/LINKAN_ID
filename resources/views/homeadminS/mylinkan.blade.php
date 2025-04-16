<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Linkan - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/shared.css') }}">
    <style>
        .my-linkan-header {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .my-linkan-url {
            background: #f5f5f5;
            padding: 8px 15px;
            border-radius: 5px;
            flex-grow: 1;
            margin-right: 10px;
        }

        .share-button {
            background: #FF9040;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .your-pages {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
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
        }

        .add-block-button {
            background: #FF9040;
            color: white;
            padding: 15px;
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

        .block-list h3 {
            margin-bottom: 15px;
        }

        .block-item {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .block-item:hover {
            background: #f8f9fa;
        }

        .block-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .drag-handle {
            color: #666;
            cursor: move;
        }

        .folder-icon {
            color: #FF9040;
        }

        .block-actions {
            color: #666;
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
        }

        .modal.active {
            display: block;
        }

        .modal.active ~ .container {
            filter: blur(5px);
            pointer-events: none;
        }

        body.modal-open {
            overflow: hidden;
        }

        body.modal-open .container {
            filter: blur(5px);
            pointer-events: none;
            transition: filter 0.3s ease;
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
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 18px;
            font-weight: 600;
        }

        .close-button {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #666;
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

        .block-icon {
            width: 40px;
            height: 40px;
            background: #FFE5D3;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            overflow: hidden;
        }

        .block-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 8px;
        }

        .block-info {
            flex: 1;
        }

        .block-info h3 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .block-info p {
            font-size: 14px;
            color: #666;
            margin: 0;
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
                <div class="my-linkan-url">My Linkan: https://Linkan.id/Budi</div>
                <button class="share-button">
                    <i class="fas fa-share-alt"></i>
                    Share
                </button>
            </div>

            <div class="your-pages">
                <h2>Your Pages</h2>
                <i class="fas fa-cog settings-icon"></i>
            </div>

            <a href="#" class="home-button">Home</a>

            <button class="add-block-button">
                <i class="fas fa-plus"></i>
                Add new block
            </button>

            <div class="block-list" style="display: none;">
                <h3>Block List</h3>
                <div id="blockListContainer">
                    <!-- Block items will be added here dynamically -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Add New Block -->
    <div id="addBlockModal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add new block</h2>
                <button class="close-button" onclick="closeModal()">&times;</button>
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
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan modal
        document.querySelector('.add-block-button').addEventListener('click', function() {
            document.getElementById('addBlockModal').style.display = 'block';
            document.body.classList.add('modal-open');
        });

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById('addBlockModal').style.display = 'none';
            document.body.classList.remove('modal-open');
        }

        // Menutup modal jika user mengklik di luar modal
        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                closeModal();
            }
        }

        // Fungsi untuk memilih tipe block
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
    </script>
</body>
</html>
