

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body">
        <h3 class="text-center"><?php echo e(__('Set New Password')); ?></h3>

        <form id="reset-password-form">
            <?php echo csrf_field(); ?>
            <input type="hidden" id="mobile" name="mobile" value="<?php echo e(request()->query('mobile')); ?>">
            <input type="hidden" id="otp" name="otp" value="<?php echo e(request()->query('otp')); ?>">

            <div class="form-group mb-3">
                <label><?php echo e(__('New Password')); ?></label>
                <div class="input-group">
                    <input type="password" id="new-password" name="password" class="form-control" required>
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#new-password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="form-group mb-3">
                <label><?php echo e(__('Confirm Password')); ?></label>
                <div class="input-group">
                    <input type="password" id="confirm-password" name="password_confirmation" class="form-control" required>
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#confirm-password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="d-grid">
                <button type="button" id="updatePasswordButton" class="btn btn-success"><?php echo e(__('Update Password')); ?></button>
            </div>
        </form>
    </div>
</div>

<!-- Include Bootstrap, FontAwesome, and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

<script>
$(document).ready(function() {
    // Toggle Password Visibility
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

    // Update Password
    $("#updatePasswordButton").click(function() {
        var newPassword = $("#new-password").val().trim();
        var confirmPassword = $("#confirm-password").val().trim();
        var mobile = $("#mobile").val();
        var otp = $("#otp").val();

        if (newPassword.length < 6) {
            alert("Password must be at least 6 characters long.");
            return;
        }

        if (newPassword !== confirmPassword) {
            alert("Passwords do not match.");
            return;
        }

        $.post("<?php echo e(route('password.update')); ?>", {
            _token: "<?php echo e(csrf_token()); ?>",
            mobile: mobile,
            otp: otp,
            password: newPassword,
            password_confirmation: confirmPassword
        }, function(updateResponse) {
            alert(updateResponse.success);
            window.location.href = "<?php echo e(route('mobile.login')); ?>"; // Redirect to login page
        }).fail(function(updateError) {
            alert(updateError.responseJSON.error);
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/auth/passwords/reset_password.blade.php ENDPATH**/ ?>