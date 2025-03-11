

<?php $__env->startSection('page-title', __('Change Password')); ?>

<?php $__env->startSection('content'); ?>
<div class="card-body">
    <div class="text-center mb-4">
        <h2 class="mb-3"><?php echo e(__('Change Password')); ?></h2>
        <p><?php echo e(__('You need to change your password before proceeding.')); ?></p>
    </div>

    <form method="POST" action="<?php echo e(route('force.change.password.post')); ?>">
        <?php echo csrf_field(); ?>

        <!-- New Password Field -->
        <div class="form-group mb-3">
            <label class="form-label"><?php echo e(__('New Password')); ?></label>
            <div class="input-group">
                <input type="password" id="new_password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePassword('new_password', 'eyeIcon1')" style="cursor: pointer; height: 40px;">
                        <i id="eyeIcon1" class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger"><small><?php echo e($message); ?></small></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Confirm Password Field -->
        <div class="form-group mb-3">
            <label class="form-label"><?php echo e(__('Confirm Password')); ?></label>
            <div class="input-group">
                <input type="password" id="confirm_password" name="password_confirmation" class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePassword('confirm_password', 'eyeIcon2')" style="cursor: pointer; height: 40px;">
                        <i id="eyeIcon2" class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger"><small><?php echo e($message); ?></small></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="d-grid">
            <button class="btn btn-primary" type="submit"><?php echo e(__('Update Password')); ?></button>
        </div>
    </form>
</div>

<script>
    // Function to toggle password visibility
    function togglePassword(inputId, eyeIconId) {
        var passwordField = document.getElementById(inputId);
        var eyeIcon = document.getElementById(eyeIconId);

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/auth/force-change-password.blade.php ENDPATH**/ ?>