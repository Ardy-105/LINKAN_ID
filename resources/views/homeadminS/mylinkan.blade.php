<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Linkan - Dashboard</title>
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
            margin-left: 20px;
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
        }

        .preview-name {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
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
                <div class="my-linkan-url">My Linkan: https://Linkan.id/Budi</div>
                <button class="share-button">
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

            <button class="home-button">Home</button>

            <button class="add-block-button" onclick="showAddBlockModal()">
                <i class="fas fa-plus"></i>
                Add new block
            </button>

            <div class="block-list">
                <div class="block-item">
                    <i class="fas fa-grip-vertical drag-handle"></i>
                    <div class="block-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="block-title">Pembelajaran</div>
                    <div class="block-actions">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>

                <div class="block-item">
                    <i class="fas fa-grip-vertical drag-handle"></i>
                    <div class="block-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="block-title">Book</div>
                    <div class="block-actions">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview Section -->
        <div class="preview-section">
            <div class="preview-header">
                <h3>Page Preview</h3>
            </div>
            <div class="phone-preview">
                <div class="phone-content">
                    <div class="profile-circle"></div>
                    <div class="preview-name">Budi</div>
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
    </script>
</body>
</html>
