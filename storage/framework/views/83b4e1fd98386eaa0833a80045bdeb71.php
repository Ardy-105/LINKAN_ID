<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Commission History - Admin Platform</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon.png')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            background: #f9f9f9;
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }
        .header {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
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
        .main {
            flex: 1;
            padding: 40px;
            max-width: 1100px;
            margin: 0 auto;
            min-height: 100vh;
        }
        .menu-title { font-weight: bold; font-size: 12px; margin-bottom: 20px; }
        .sidebar a { display: flex; align-items: center; padding: 10px; text-decoration: none; color: #000; font-weight: 500; border-radius: 8px; margin-bottom: 10px; }
        .sidebar a.active { background-color: white; font-weight: 700; }
        .sidebar a:hover { background-color: #e1ecfa; }
        .card-earning { background: #ff7f2a; color: #fff; border-radius: 16px; padding: 30px 30px 20px 30px; margin-bottom: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.08); position: relative; }
        .card-earning .total { font-size: 1.5em; font-weight: bold; }
        .card-earning .amount { font-size: 2.5em; font-weight: bold; margin: 10px 0 20px 0; }
        .card-earning .actions { position: absolute; top: 30px; right: 30px; display: flex; gap: 10px; }
        .card-earning .actions button { background: #fff; color: #ff7f2a; border: none; border-radius: 8px; padding: 8px 18px; font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 6px; box-shadow: 0 1px 4px rgba(0,0,0,0.04); }
        .card-earning .actions button i { font-size: 1.1em; }
        .card-earning .history { margin-top: 30px; color: #ffd6b3; font-size: 1em; display: flex; align-items: center; gap: 6px; }
        .list-komisi { background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 20px; }
        .komisi-item { display: flex; align-items: center; justify-content: space-between; background: #fff; border-radius: 12px; margin-bottom: 16px; border: 2px solid #fff; box-shadow: 0 1px 4px rgba(0,0,0,0.03); padding: 16px 20px; transition: border 0.2s; }
        .komisi-item.selected { border: 2px solid #1a73e8; }
        .komisi-item .icon { background: orange; color: #fff; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-size: 1.3em; }
        .komisi-item .info { margin-left: 12px; }
        .komisi-item .email { font-size: 0.95em; color: #888; }
        .komisi-item .nama { font-weight: bold; font-size: 1.1em; }
        .komisi-item .tanggal { color: #888; font-size: 0.95em; min-width: 110px; text-align: center; }
        .komisi-item .nominal { font-weight: bold; font-size: 1.1em; min-width: 110px; text-align: right; }
        @media (max-width: 700px) {
            body { flex-direction: column; }
            .main { padding: 10px; margin-left: 0; }
            .komisi-item { flex-direction: column; align-items: flex-start; gap: 8px; padding: 10px; }
            .komisi-item .tanggal,
            .komisi-item .nominal { min-width: unset; text-align: left; }
        }
    </style>
</head>
<body>

    
    <?php echo $__env->make('platformadmin.sidebar.sidebarplatform', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="main">
        <!-- Judul -->
        <div class="header">Commission History</div>

        <!-- Card Total Earnings -->
        <div class="card-earning">
            <div class="total">Total Earnings</div>
            <div class="amount">IDR 0</div>
            <div class="actions">
                <button><i class="fa fa-paper-plane"></i> Withdraw</button>
                <button onclick="printCommissionReport()">
                    <i class="fa fa-print"></i> Print
                </button>
            </div>
            <div class="history"><i class="fa fa-paperclip"></i> History</div>
        </div>

        <!-- List Komisi Seller -->
        <div class="list-komisi"></div>
        <!-- Pagination: dipindah ke bawah list-komisi dan rata tengah -->
        <div style="display: flex; justify-content: center;">
            <div>
                <div id="pagination-info" class="text-center mb-1" style="color: #666; font-size: 14px;"></div>
                <div id="pagination" class="mt-1"></div>
            </div>
        </div>
        <style>
            /* Pagination Style - Mengacu pada orders.blade.php */
            #pagination ul {
                background: none;
                border-radius: 0;
                box-shadow: none;
                padding: 0;
                display: inline-flex;
                align-items: center;
                list-style: none;
                margin: 0;
            }
            #pagination ul li {
                list-style: none;
                margin: 0;
                padding: 0;
            }
            #pagination button {
                transition: all 0.18s;
                font-weight: 600;
                border: none;
                outline: none;
                margin: 0 3px;
                border-radius: 5px;
                min-width: 36px;
                min-height: 36px;
                font-size: 1rem;
                box-shadow: 0 2px 6px rgba(255,168,106,0.08);
                cursor: pointer;
                background: #f5f5f5;
                color: #666;
            }
            #pagination button[disabled], #pagination .opacity-50 {
                background: #f5f5f5 !important;
                color: #bbb !important;
                cursor: not-allowed;
                box-shadow: none;
            }
            #pagination button.bg-orange-500 {
                background: #FF9040 !important;
                color: #fff !important;
                box-shadow: 0 2px 8px rgba(255,144,64,0.13);
            }
            #pagination button.bg-white {
                background: #f5f5f5 !important;
                color: #222 !important;
            }
            #pagination button:hover:not([disabled]):not(.bg-orange-500) {
                background: #FFA86A !important;
                color: #fff !important;
                box-shadow: 0 2px 8px rgba(255,168,106,0.10);
            }
            #pagination span.text-gray-400 {
                color: #e0a16b !important;
                font-weight: bold;
                font-size: 1.1em;
            }
            @media (max-width: 600px) {
                #pagination button { min-width: 28px; min-height: 28px; font-size: 0.95em; }
            }
        </style>
    </div>

    <script>
        let lastFetchedCommissions = [];
        let lastFetchedTotalEarnings = 0;
        let currentPage = 1;
        const perPage = 5; // jumlah komisi per halaman

        function printCommissionReport() {
            // Buat form untuk mengirim data
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?php echo e(route("platformadmin.print.post")); ?>';
            form.target = '_blank';

            // Tambahkan CSRF token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '<?php echo e(csrf_token()); ?>';
            form.appendChild(csrfToken);

            // Siapkan data yang akan dikirim
            const data = {
                total_earnings: 'IDR ' + Number(lastFetchedTotalEarnings).toLocaleString('id-ID'),
                commission_details: lastFetchedCommissions.map(commission => ({
                    name: commission.seller_name,
                    email: commission.seller_email,
                    date: new Date(commission.created_at).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }),
                    amount: 'Rp ' + Number(commission.commission).toLocaleString('id-ID')
                }))
            };

            // Tambahkan data ke form
            const dataInput = document.createElement('input');
            dataInput.type = 'hidden';
            dataInput.name = 'data';
            dataInput.value = JSON.stringify(data);
            form.appendChild(dataInput);

            // Submit form
            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }

        function fetchCommissions() {
            fetch('<?php echo e(route('platformadmin.commissions')); ?>')
                .then(response => response.json())
                .then(data => {
                    lastFetchedCommissions = data.commissions;
                    lastFetchedTotalEarnings = data.total_earnings;
                    const totalEarnings = document.querySelector('.card-earning .amount');
                    totalEarnings.textContent = 'IDR ' + Number(data.total_earnings).toLocaleString('id-ID');
                    renderCommissions();
                });
        }

        function renderCommissions() {
            const list = document.querySelector('.list-komisi');
            list.innerHTML = '';
            const start = (currentPage - 1) * perPage;
            const end = start + perPage;
            const pageData = lastFetchedCommissions.slice(start, end);
            pageData.forEach(commission => {
                const date = new Date(commission.created_at);
                const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                const nominal = 'Rp ' + Number(commission.commission).toLocaleString('id-ID');
                list.innerHTML += `
                    <div class="komisi-item">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="icon"><i class="fa fa-arrow-down"></i></div>
                            <div class="info">
                                <div class="email">${commission.seller_email}</div>
                                <div class="nama">${commission.seller_name}</div>
                            </div>
                        </div>
                        <div class="tanggal">${formattedDate}</div>
                        <div class="nominal">${nominal}</div>
                    </div>
                `;
            });
            renderPagination();
        }

        function renderPagination() {
            const total = Math.ceil(lastFetchedCommissions.length / perPage);
            const totalData = lastFetchedCommissions.length;
            const startData = totalData === 0 ? 0 : (currentPage - 1) * perPage + 1;
            const endData = Math.min(currentPage * perPage, totalData);
            // Info jumlah data
            document.getElementById('pagination-info').innerHTML = `Menampilkan ${startData} - ${endData} dari ${totalData} data`;
            if (total <= 1) {
                document.getElementById('pagination').innerHTML = '';
                return;
            }
            let html = '<ul>';
            // First & Prev
            html += `<li><button class="${currentPage==1?'opacity-50':''}" aria-label="Halaman Pertama" onclick="goToPage(1)" ${currentPage==1?'disabled':''}>&laquo;</button></li>`;
            html += `<li><button class="${currentPage==1?'opacity-50':''}" aria-label="Sebelumnya" onclick="goToPage(${currentPage-1})" ${currentPage==1?'disabled':''}>&lsaquo;</button></li>`;
            // Numbered
            let pageNumbers = [];
            if (total <= 7) {
                for (let i = 1; i <= total; i++) pageNumbers.push(i);
            } else {
                if (currentPage <= 4) {
                    pageNumbers = [1,2,3,4,5,'...',total];
                } else if (currentPage >= total-3) {
                    pageNumbers = [1,'...',total-4,total-3,total-2,total-1,total];
                } else {
                    pageNumbers = [1,'...',currentPage-1,currentPage,currentPage+1,'...',total];
                }
            }
            pageNumbers.forEach(p => {
                if (p === '...') {
                    html += `<li><span class="text-gray-400">...</span></li>`;
                } else {
                    html += `<li><button class="${p==currentPage?'bg-orange-500':'bg-white'}" aria-current="${p==currentPage?'page':'false'}" onclick="goToPage(${p})">${p}</button></li>`;
                }
            });
            // Next & Last
            html += `<li><button class="${currentPage==total?'opacity-50':''}" aria-label="Berikutnya" onclick="goToPage(${currentPage+1})" ${currentPage==total?'disabled':''}>&rsaquo;</button></li>`;
            html += `<li><button class="${currentPage==total?'opacity-50':''}" aria-label="Halaman Terakhir" onclick="goToPage(${total})" ${currentPage==total?'disabled':''}>&raquo;</button></li>`;
            html += '</ul>';
            document.getElementById('pagination').innerHTML = html;
        }

        function goToPage(page) {
            const total = Math.ceil(lastFetchedCommissions.length / perPage);
            if (page < 1 || page > total) return;
            currentPage = page;
            renderCommissions();
        }

        // Panggil pertama kali dan setiap 10 detik
        fetchCommissions();
        setInterval(fetchCommissions, 10000);
    </script>
</body>
</html>
<?php /**PATH C:\LINKAN_ID\resources\views/platformadmin/berandaplatform.blade.php ENDPATH**/ ?>