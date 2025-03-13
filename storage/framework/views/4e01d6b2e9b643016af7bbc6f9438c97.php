

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Level 4 List')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Level 4 List')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                       
                            <thead>
                                <tr>
                                <th><?php echo e(__('ID')); ?></th>
                                    <th><?php echo e(__('Customer Name')); ?></th>
                                    <th><?php echo e(__('Mobile')); ?></th>
                                    <th><?php echo e(__('Level 1 Refer')); ?></th>
                                    <th><?php echo e(__('Level 2 Refer')); ?></th>
                                    <th><?php echo e(__('Level 3 Refer')); ?></th>
                                    <th><?php echo e(__('Level 4 Refer')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($user['id']); ?></td>
                                        <td><?php echo e($user['name'] ?? 'N/A'); ?></td>
                                        <td><?php echo e($user['mobile'] ?? 'N/A'); ?></td>
                                        <td><?php echo e($user['level_1_referrer_name'] ?? 'N/A'); ?></td>
                                        <td><?php echo e($user['level_2_referrer_name'] ?? 'N/A'); ?></td>
                                        <td><?php echo e($user['level_3_referrer_name'] ?? 'N/A'); ?></td>
                                        <td><?php echo e($user['level_4_referrer_name'] ?? 'N/A'); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/level_4/index.blade.php ENDPATH**/ ?>