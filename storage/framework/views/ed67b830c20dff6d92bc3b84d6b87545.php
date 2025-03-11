

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Profile')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Profile')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body text-center">
                    <div class="profile-avatar mb-3">
                        <img src="<?php echo e(asset('storage/uploads/avatar/avatar.png')); ?>" 
                            class="rounded-circle border border-3 shadow-sm"
                            style="width: 120px; height: 120px;" 
                            alt="User Avatar">
                    </div>
                    <h3 class="mb-1"><?php echo e($user->name); ?></h3>
                    <p class="text-muted"><?php echo e(__('User Profile Details')); ?></p>
                    
                    <table class="table table-hover mt-4">
                        <tbody>
                            <tr>
                                <th><i class="fas fa-user text-primary"></i> <?php echo e(__('Name')); ?></th>
                                <td><?php echo e($user->name); ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-phone-alt text-success"></i> <?php echo e(__('Mobile')); ?></th>
                                <td><?php echo e($user->mobile); ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-calendar-alt text-warning"></i> <?php echo e(__('Age')); ?></th>
                                <td><?php echo e($user->age); ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-map-marker-alt text-danger"></i> <?php echo e(__('Pincode')); ?></th>
                                <td><?php echo e($user->pincode); ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-venus-mars text-info"></i> <?php echo e(__('Gender')); ?></th>
                                <td><?php echo e(ucfirst($user->gender)); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-primary mt-3">
                        <i class="fas fa-arrow-left"></i> <?php echo e(__('Back to Dashboard')); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- FontAwesome for Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/profile.blade.php ENDPATH**/ ?>