

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body">
        <h3 class="text-center"><?php echo e(__('Enter OTP')); ?></h3>
        <p class="text-center">OTP has been sent to your mobile number.</p>

        <form method="POST" action="<?php echo e(route('password.otp.verify')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group mb-3">
                <label><?php echo e(__('Enter OTP')); ?></label>
                <input type="text" name="otp" class="form-control" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-success"><?php echo e(__('Verify OTP')); ?></button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/auth/passwords/verify_otp.blade.php ENDPATH**/ ?>