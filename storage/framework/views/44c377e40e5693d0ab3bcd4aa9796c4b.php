<!DOCTYPE html>
<html>
<head>
    <title>Kelola Theme - Admin Platform</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon.png')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
        .main {
            flex: 1;
            padding: 40px;
            max-width: 1100px;
            margin: 0 auto;
            min-height: 100vh;
        }
        .table-responsive {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            background: #fff;
        }
        table {
            margin-bottom: 0;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 14px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
            font-weight: 700;
            font-size: 1rem;
        }
        tr:not(:last-child) {
            border-bottom: 1px solid #eee;
        }
        tr:hover {
            background-color: #f7f7fa;
        }
        .btn { border-radius: 8px; }
        @media (max-width: 700px) {
            .main { padding: 10px; margin-left: 0; }
            th, td { padding: 8px; font-size: 0.95rem; }
        }
    </style>
</head>
<body>

    <?php echo $__env->make('platformadmin.sidebar.sidebarplatform', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="main">
        <div class="header">Kelola Theme</div>
        <a href="<?php echo e(route('platformadmin.theme.create')); ?>" class="btn btn-primary mb-3" style="background:#FF9040; border:none; color:#fff; font-weight:600; transition:background 0.2s;">
            Tambah Theme
        </a>
        <style>
        .btn-primary.mb-3[style] {
            background: #FF9040 !important;
            border: none !important;
            color: #fff !important;
            font-weight: 600;
            transition: background 0.2s;
        }
        .btn-primary.mb-3[style]:hover, .btn-primary.mb-3[style]:focus {
            background: #ff7f2a !important;
            color: #fff !important;
        }
        </style>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Preview</th>
                        <th>Background</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($theme->name); ?></td>
                        <td>
                            <?php if($theme->preview_image): ?>
                                <img src="<?php echo e(asset('storage/' . $theme->preview_image)); ?>" width="100" style="object-fit:cover;">
                            <?php else: ?>
                                <span class="text-muted">Tidak ada</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($theme->background_image): ?>
                                <img src="<?php echo e(asset('storage/' . $theme->background_image)); ?>" width="100" style="object-fit:cover;">
                            <?php else: ?>
                                <span class="text-muted">Tidak ada</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('platformadmin.theme.edit', $theme->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form action="<?php echo e(route('platformadmin.theme.destroy', $theme->id)); ?>" method="POST" style="display:inline-block;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus theme?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada theme.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html> <?php /**PATH C:\LINKAN_ID\resources\views/platformadmin/theme/index.blade.php ENDPATH**/ ?>