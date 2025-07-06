<style>
.sidebar {
    width: 220px !important;
    background-color: #dbe7fd !important;
    min-height: 100vh !important;
    padding: 20px !important;
    border-top-right-radius: 40px !important;
    display: flex !important;
    flex-direction: column !important;
}

.sidebar .logo {
    width: 120px;
    margin-bottom: 30px;
}

.sidebar a {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #000;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 8px;
    font-weight: 500;
    transition: 0.3s;
}

.sidebar a.active {
    background-color: #FF9040;
    color: white;
    font-weight: 700;
}

.sidebar a:hover {
    background-color: #FF9040;
    color: white;
}

.sidebar a i {
    margin-right: 10px;
    width: 20px;
}

.sidebar hr {
    border: none;
    border-top: 3px solid #000;
    margin: 15px 0;
}

.sidebar a.active i,
.sidebar a:hover i {
    color: white !important;
}
</style>
<div class="sidebar">
    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Linkan Logo" class="logo">
    <a href="<?php echo e(route('beranda.platformadmin')); ?>" class="<?php echo e(request()->routeIs('beranda.platformadmin') ? 'active' : ''); ?>">
        <i class="fas fa-home"></i>Home
    </a>
    <a href="<?php echo e(route('verifikasi.platformadmin')); ?>" class="<?php echo e(request()->routeIs('verifikasi.platformadmin') ? 'active' : ''); ?>">
        <i class="fas fa-check-circle"></i> Verification
    </a>
    <a href="<?php echo e(route('platformadmin.theme.index')); ?>" class="<?php echo e(request()->routeIs('platformadmin.theme.*') ? 'active' : ''); ?>">
        <i class="fas fa-paint-brush"></i> Kelola Theme
    </a>
    <hr>
    <div class="marketing-tools">
        <a href="<?php echo e(route('welcome')); ?>">
            <span style="display: flex; align-items: center;">
                <img src="<?php echo e(asset('images/logout.png')); ?>" alt="Logout" style="width: 20px; height: 20px; margin-right: 10px;">
                LogOut
            </span>
        </a>
    </div>
</div><?php /**PATH C:\LINKAN_ID\resources\views/platformadmin/sidebar/sidebarplatform.blade.php ENDPATH**/ ?>