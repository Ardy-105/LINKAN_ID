<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verification Content</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
    body {
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        background-color: #f9f9f9;
    }

    .sidebar {
        width: 220px;
        background-color: #dbe7fd;
        padding: 20px;
        min-height: 100vh;
        border-top-right-radius: 40px;
        display: flex;
        flex-direction: column;
    }

    .menu-title {
        font-weight: bold;
        font-size: 12px;
        margin-bottom: 20px;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        padding: 10px;
        text-decoration: none;
        color: #000;
        font-weight: 500;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .sidebar a.active {
        background-color: white;
        font-weight: 700;
    }

    .sidebar a:hover {
        background-color: #e1ecfa;
    }

    .content {
        flex: 1;
        padding: 40px;
    }

    .header {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .tabs {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .tab {
        border: none;
        background: none;
        font-weight: 600;
        cursor: pointer;
        padding: 8px 0;
        position: relative;
    }

    .tab::after {
        content: '';
        height: 3px;
        background: #000;
        width: 0;
        position: absolute;
        left: 0;
        bottom: -5px;
        transition: width 0.3s;
    }

    .tab.active::after {
        width: 100%;
    }

    .date-filter {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .date-input {
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        background-color: #e4e4e4;
    }

    .table-container {
        background: white;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #f4f4f4;
        font-weight: 600;
    }

    tr:not(:last-child) {
        border-bottom: 1px solid #eee;
    }

    .content-preview {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .content-preview img {
        width: 80px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.2);
    }

    .status-completed {
        color: green;
        font-weight: 600;
    }

    .status-pending {
        color: red;
        font-weight: 600;
    }

    .btn {
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn.accepted {
        background-color: #555;
        color: white;
    }

    .btn.accept {
        background-color: #ff6600;
        color: white;
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
    width: 500px; /* kecilkan modal utama */
    max-width: 90%;
    border-radius: 20px;
    background-color: white;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
    padding: 20px 24px;
    background-color: #fff;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    }

    .modal-header h2 {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 0;
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
        transition: color 0.3s;
    }

    .close-button:hover {
        color: #333;
    }

    .modal-body {
    padding: 20px 24px;
    display: flex;
    flex-direction: column;
    align-items: stretch;
    text-align: left;
    }

    .modal-footer {
    padding: 16px 24px;
    background-color: #fff;
    border-top: 1px solid #e9ecef;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    }

    .form-group {
        margin-bottom: 20px;
        width: 100%;
        box-sizing: border-box;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        min-height: 100px;
        max-height: 150px;
        padding: 20px;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 14px;
        line-height: 1.6;
        resize: vertical;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
        color: #495057;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #FF9040;
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(255, 144, 64, 0.1);
    }

    .form-control::placeholder {
        color: #adb5bd;
        font-size: 13px;
    }

    .btn.cancel {
        background-color: #e9ecef;
        color: #495057;
    }

    .btn.cancel:hover {
        background-color: #dee2e6;
    }

    .btn.reject {
        background-color: #dc3545;
        color: white;
    }

    .btn.reject:hover {
        background-color: #c82333;
    }
</style>


</head>
<body>

    {{-- Sidebar --}}
    @include('platformadmin.sidebar.sidebarplatform')

    {{-- Main Content --}}
    <div class="content">
        <div class="header">Verification Content</div>

        {{-- Tabs --}}
        <div class="tabs">
            <button class="tab active">All Request</button>
            <button class="tab">Pending</button>
            <button class="tab">Completed</button>
        </div>

        {{-- Date Filter --}}
        <div class="date-filter">
            <input type="date" class="date-input">
        </div>

        {{-- Table --}}
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Content</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}.</td>
                        <td>{{ $product->user->name }}</td>
                        <td>
                            <div class="content-preview">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}">
                                @else
                                    <img src="https://via.placeholder.com/80x50.png?text=No+Image" alt="No Image">
                                @endif
                                <span>{{ $product->title }}</span>
                            </div>
                        </td>
                        <td>{{ $product->created_at->format('d M Y') }}</td>
                        <td>
                            @if($product->verification_status == 'approved')
                                <span class="status-completed">● Approved</span>
                            @elseif($product->verification_status == 'rejected')
                                <span class="status-pending">● Rejected</span>
                            @else
                                <span class="status-pending">● Pending</span>
                            @endif
                        </td>
                        <td>
                            @if($product->verification_status == 'pending')
                                <form action="{{ route('verifikasi.verify', $product->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn accept">Approve</button>
                                </form>
                                <button type="button" class="btn accept" style="background-color: #dc3545;" onclick="showRejectModal({{ $product->id }})">Reject</button>
                            @else
                                <button class="btn accepted" disabled>{{ ucfirst($product->verification_status) }}</button>
                                @if($product->verification_status == 'rejected' && $product->rejection_reason)
                                    <div style="font-size: 12px; color: #666; margin-top: 5px;">
                                        Alasan: {{ $product->rejection_reason }}
                                    </div>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal untuk Reject -->
    <div id="rejectModal" class="modal">
        <div class="modal-content">
        <div class="modal-header">
            <h2>Reject Content</h2>
            <button class="close-button" onclick="closeRejectModal()">×</button>
        </div>

            <form id="rejectForm" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="status" value="rejected">
                    <div class="form-group">
                        <label>Alasan Penolakan</label>
                        <textarea name="rejection_reason" class="form-control" rows="4" required placeholder="Masukkan alasan penolakan produk..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn cancel" onclick="closeRejectModal()">Batal</button>
                    <button type="submit" class="btn reject">Tolak</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function showRejectModal(productId) {
        document.getElementById('rejectForm').action = `/platformadmin/verifikasi/${productId}`;
        document.getElementById('rejectModal').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target.className === 'modal') {
            closeRejectModal();
        }
    }
    </script>

</body>
</html>
