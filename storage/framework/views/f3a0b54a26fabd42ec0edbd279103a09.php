

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Enlight Health')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row justify-content-center">

        <!-- Menu Section -->
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <h4 class="mb-0 fw-bold"><?php echo e(__('Enlight Health Menu')); ?></h4>
                </div>

                <div class="card-body p-4">
                    <ul class="list-group list-group-flush">

                        <!-- Products -->
                        <li class="list-group-item p-3 menu-item d-flex align-items-center">
                            <a href="<?php echo e(route('products.index')); ?>" class="w-100 d-flex align-items-center text-decoration-none text-dark">
                                <i class="ti ti-package text-success me-3 fs-3"></i>
                                <span class="fw-bold"><?php echo e(__('Products')); ?></span>
                            </a>
                        </li>

                        <!-- Inactive Users -->
                        <li class="list-group-item p-3 menu-item d-flex align-items-center">
                            <a href="<?php echo e(route('inactive_users.index')); ?>" class="w-100 d-flex align-items-center text-decoration-none text-dark">
                                <i class="ti ti-users text-danger me-3 fs-3"></i>
                                <span class="fw-bold"><?php echo e(__('My Inactive Customers')); ?></span>
                            </a>
                        </li>

                        <!-- Earning Opportunities -->
                        <li class="list-group-item p-3 menu-item d-flex align-items-center">
                            <a href="<?php echo e(route('add_earnings.index')); ?>" class="w-100 d-flex align-items-center text-decoration-none text-dark">
                                <i class="ti ti-moneybag text-warning me-3 fs-3"></i>
                                <span class="fw-bold"><?php echo e(__('Earning Opportunities')); ?></span>
                            </a>
                        </li>

                        <!-- Customer Levels with Collapse -->
                        <li class="list-group-item p-3 menu-item">
                            <a href="#" class="w-100 d-flex align-items-center text-decoration-none text-dark" id="levels-toggle">
                                <i class="ti ti-building text-primary me-3 fs-3"></i>
                                <span class="fw-bold"><?php echo e(__('Customer Levels')); ?></span>
                                <i class="ti ti-chevron-down ms-auto" id="toggle-icon"></i>
                            </a>
                            <ul class="list-unstyled ps-4 mt-2 collapse" id="levels-menu">
                                <li class="mt-2"><a href="<?php echo e(route('level_1.index')); ?>" class="text-decoration-none text-muted"><?php echo e(__('Customer Level 1')); ?></a></li>
                                <li class="mt-2"><a href="<?php echo e(route('level_2.index')); ?>" class="text-decoration-none text-muted"><?php echo e(__('Customer Level 2')); ?></a></li>
                                <li class="mt-2"><a href="<?php echo e(route('level_3.index')); ?>" class="text-decoration-none text-muted"><?php echo e(__('Customer Level 3')); ?></a></li>
                                <li class="mt-2"><a href="<?php echo e(route('level_4.index')); ?>" class="text-decoration-none text-muted"><?php echo e(__('Customer Level 4')); ?></a></li>
                            </ul>
                        </li>

                        <!-- Extra Bonus -->
                        <li class="list-group-item p-3 menu-item d-flex align-items-center">
                            <a href="<?php echo e(route('extra_bonus.index')); ?>" class="w-100 d-flex align-items-center text-decoration-none text-dark">
                                <i class="ti ti-trophy text-info me-3 fs-3"></i>
                                <span class="fw-bold"><?php echo e(__('Extra Bonus')); ?></span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<!-- Scripts -->
<?php $__env->startPush('scripts'); ?>
<script>
    // Toggle customer levels menu
    const levelsToggle = document.getElementById('levels-toggle');
    const levelsMenu = document.getElementById('levels-menu');
    const toggleIcon = document.getElementById('toggle-icon');

    levelsToggle.addEventListener('click', () => {
        levelsMenu.classList.toggle('show');
        toggleIcon.classList.toggle('ti-chevron-up');
        toggleIcon.classList.toggle('ti-chevron-down');
    });

    // Hover effect for menu items
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        item.addEventListener('mouseover', () => {
            item.style.background = 'rgba(0, 123, 255, 0.1)';
            item.style.transition = 'background 0.3s, transform 0.3s';
            item.style.transform = 'translateY(-5px)';
            item.style.boxShadow = '0 8px 16px rgba(0, 0, 0, 0.2)';
        });

        item.addEventListener('mouseout', () => {
            item.style.background = 'transparent';
            item.style.transform = 'translateY(0)';
            item.style.boxShadow = 'none';
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/enlight_health/index.blade.php ENDPATH**/ ?>