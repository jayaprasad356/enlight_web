

<?php $__env->startSection('page-title', __('Mobile Login')); ?>

<?php $__env->startSection('content'); ?>
<div class="card-body">
    <div class="text-center mb-4">
        <img src="<?php echo e(asset('storage/uploads/logo/enlight.jpg')); ?>" alt="Logo" width="100">
    </div>

    <div>
        <center><h2 class="mb-3 f-w-600"><?php echo e(__('Customer Login')); ?></h2></center> 
    </div>

    <div class="custom-login-form">
        <form method="POST" action="<?php echo e(route('mobile.login')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group mb-3">
                <label class="form-label"><?php echo e(__('Mobile Number')); ?></label>
                <input type="text" name="mobile" class="form-control <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter your mobile number" required autofocus>
                <?php $__errorArgs = ['mobile'];
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

            <div class="form-group mb-3">
                <label class="form-label"><?php echo e(__('Password')); ?></label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter password" required>
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#password">
                        <i class="fas fa-eye"></i>
                    </button>
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

            <div class="d-grid">
                <button class="btn btn-primary mt-2" type="submit"><?php echo e(__('Login')); ?></button>
            </div>

            <!-- Forgot Password Link -->
            <div class="text-center mt-2">
                <a href="<?php echo e(route('password.otp')); ?>"><?php echo e(__('Forgot Password?')); ?></a>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Toggle password visibility
        $(".toggle-password").click(function() {
            var target = $(this).data("target");
            var input = $(target);
            var icon = $(this).find("i");

            if (input.attr("type") === "password") {
                input.attr("type", "text");
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                input.attr("type", "password");
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        // Auto Logout after inactivity
        let timeout;
        function resetTimer() {
            clearTimeout(timeout);
            timeout = setTimeout(logoutUser, 10 * 60 * 1000); // 10 minutes inactivity
        }

        function logoutUser() {
            window.location.href = "<?php echo e(route('logout')); ?>"; // Redirect to logout route
        }

        // Detect user activity
        document.onmousemove = resetTimer;
        document.onkeypress = resetTimer;
        document.onclick = resetTimer;
        document.onscroll = resetTimer;

        resetTimer(); // Initialize timer when page loads
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/auth/mobile-login.blade.php ENDPATH**/ ?>