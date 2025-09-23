<?php
    // Default color jika tidak ada appearance
    $themeColor = $appearance->theme_color ?? '#FF9040';
?>
<div class="preview-section">
    <div class="preview-header">
        <h2>Preview</h2>
    </div>
    <div class="phone-preview">
        <div class="phone-content" id="previewScreen" style="width: 100%; height: 100%; background: #f8f9fa; border-radius: 30px; padding: 20px; display: flex; flex-direction: column; align-items: center; overflow-y: auto; background-image: url('<?php echo e($appearance && $appearance->background_color ? asset('storage/themes/backgrounds/' . $appearance->background_color) . '?v=' . time() : ''); ?>'); background-size: cover; background-position: center;">
            <?php if($appearance && $appearance->banner): ?>
                <div class="banner-preview" style="width: 100%; height: 120px; background: #ddd; border-radius: 10px; margin-bottom: 20px; overflow: hidden;">
                    <img src="<?php echo e(asset('storage/' . $appearance->banner)); ?>" alt="Banner" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            <?php endif; ?>
            <div class="profile-circle" style="width: 80px; height: 80px; border-radius: 50%; background: #ddd; margin-bottom: 15px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                <?php if($appearance && $appearance->profile_image): ?>
                    <img src="<?php echo e(asset('storage/' . $appearance->profile_image)); ?>" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                <?php else: ?>
                    <i class="fas fa-user"></i>
                <?php endif; ?>
            </div>
            <div class="preview-name" style="font-size: 18px; font-weight: 600; margin-bottom: 10px; text-align: center; color: <?php echo e($themeColor); ?>;">
                <?php echo e($appearance->name ?? ($user->name ?? '')); ?>

            </div>
            <?php if($appearance && $appearance->bio): ?>
                <div class="preview-bio" style="font-size: 14px; color: <?php echo e($themeColor); ?>; text-align: center; margin-bottom: 15px; padding: 0 20px; line-height: 1.4;"><?php echo $appearance->bio; ?></div>
            <?php endif; ?>
            <div class="social-links" style="display: flex; gap: 15px; margin-bottom: 20px;">
                <?php if($appearance && $appearance->instagram): ?>
                    <a href="<?php echo e($appearance->instagram); ?>" target="_blank"><i class="fab fa-instagram" style="color: <?php echo e($themeColor); ?>"></i></a>
                <?php endif; ?>
                <?php if($appearance && $appearance->tiktok): ?>
                    <a href="<?php echo e($appearance->tiktok); ?>" target="_blank"><i class="fab fa-tiktok" style="color: <?php echo e($themeColor); ?>"></i></a>
                <?php endif; ?>
                <?php if($appearance && $appearance->whatsapp): ?>
                    <a href="<?php echo e($appearance->whatsapp); ?>" target="_blank"><i class="fab fa-whatsapp" style="color: <?php echo e($themeColor); ?>"></i></a>
                <?php endif; ?>
            </div>
            <?php if($appearance && $appearance->description): ?>
                <div class="preview-bio" style="color: <?php echo e($themeColor); ?>"><?php echo e($appearance->description); ?></div>
            <?php endif; ?>
            <?php if($appearance && $appearance->link): ?>
                <a href="<?php echo e($appearance->link); ?>" class="preview-product-button" style="background-color: <?php echo e($themeColor); ?>"><?php echo e($appearance->button_text ?? 'Beli'); ?></a>
            <?php endif; ?>
            <?php if($digitalProducts && $digitalProducts->count() > 0): ?>
                <div class="preview-products" style="width: 100%; padding: 10px; display: flex; flex-direction: column; gap: 10px;">
                    <?php $__currentLoopData = $digitalProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="preview-product-item" style="background: white; border-radius: 8px; padding: 10px; display: flex; align-items: center; gap: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: transform 0.2s ease;">
                            <div class="preview-product-image" style="width: 40px; height: 40px; background: #FFE5D3; border-radius: 6px; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0;">
                                <?php if($product->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->title); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <i class="fas fa-file-alt"></i>
                                <?php endif; ?>
                            </div>
                            <div class="preview-product-info" style="flex: 1; min-width: 0;">
                                <div class="preview-product-title" style="font-size: 14px; color: #333; margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo e($product->title); ?></div>
                            </div>
                            <?php if($product->verification_status == 'approved'): ?>
                                <a href="<?php echo e(route('track.click', ['link_id' => ($user->username ?? Auth::user()->username), 'target' => $product->platform_url ?? '#'])); ?>" class="preview-product-button" style="background-color: <?php echo e($themeColor); ?>; color: white; padding: 4px 12px; border-radius: 4px; font-size: 12px; border: none; cursor: pointer; transition: background-color 0.3s ease; flex-shrink: 0; min-width: 100px; text-align: center; height: 28px; display: flex; align-items: center; justify-content: center; text-decoration: none;" target="_blank"><?php echo e(str_replace('_', ' ', $product->button_text ?? 'Beli')); ?></a>
                            <?php else: ?>
                                <button class="preview-product-button" disabled style="background-color: #e9ecef; color: #6c757d; cursor: not-allowed; opacity: 1;">
                                    <?php if($product->verification_status == 'pending'): ?>
                                        <span class="status pending">Menunggu Verifikasi</span>
                                    <?php else: ?>
                                        <span class="status rejected">Ditolak</span>
                                    <?php endif; ?>
                                </button>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div> <?php /**PATH C:\LINKAN_ID\resources\views/homeadmins/preview.blade.php ENDPATH**/ ?>