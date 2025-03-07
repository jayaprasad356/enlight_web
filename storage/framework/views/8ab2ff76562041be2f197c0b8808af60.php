

<?php $__env->startSection('title', 'Extra Bonus Management'); ?>
<?php $__env->startSection('content-header', 'Extra Bonus Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Extra Bonus Levels</h3>
    </div>
    <div class="card-body">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="table-responsive"> <!-- Makes the table scrollable on small screens -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Level</th>
                        <th>Required Refers</th>
                        <th>Refers Done</th>
                        <th>Bonus Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $levels = [
                            ['level' => 1, 'refers' => 10, 'bonus' => 1000],
                            ['level' => 2, 'refers' => 30, 'bonus' => 2000],
                            ['level' => 3, 'refers' => 90, 'bonus' => 3000],
                            ['level' => 4, 'refers' => 270, 'bonus' => 5000],
                        ];
                    ?>
                    <?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $levelNumber = $level['level'];
                            $userReferrals = $referralCounts[$levelNumber] ?? 0;
                            $isEligible = $userReferrals >= $level['refers'];
                        ?>
                        <tr>
                            <td>Level <?php echo e($level['level']); ?></td>
                            <td><?php echo e($level['refers']); ?> Refers</td>
                            <td><?php echo e($userReferrals); ?> Referrals</td>
                            <td>₹<?php echo e(number_format($level['bonus'])); ?></td>
                            <td>
                                <form action="<?php echo e(route('bonus.claim', $level['level'])); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-success" 
                                        <?php echo e($isEligible ? '' : 'disabled'); ?>>
                                        Claim
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div> <!-- End .table-responsive -->
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/extra_bonus/index.blade.php ENDPATH**/ ?>