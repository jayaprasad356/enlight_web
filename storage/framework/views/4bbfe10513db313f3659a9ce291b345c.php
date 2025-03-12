<?php
    $refer_code = session('refer_code', ''); // Get refer_code from session or empty string if not set
?>



<?php $__env->startSection('page-title', __('Mobile Login')); ?>

<?php $__env->startSection('content'); ?>
<div class="card-body">
    <div class="text-center mb-4">
        <img src="<?php echo e(asset('storage/uploads/logo/enlight.jpg')); ?>" alt="Logo" width="100">
    </div>

    <div>
        <center><h2 class="mb-3 f-w-600"><?php echo e(__('Customer Register')); ?></h2></center> 
    </div>

    <div class="custom-login-form">
        <form action="<?php echo e(route('addusers')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="name"><?php echo e(__('Name')); ?></label>
                <input type="text" class="form-control" id="name" name="name" required value="<?php echo e(old('name')); ?>">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="mobile"><?php echo e(__('Mobile')); ?></label>
                <input type="text" class="form-control" id="mobile" name="mobile" required value="<?php echo e(old('mobile')); ?>">
                <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="age"><?php echo e(__('Age')); ?></label>
                <input type="number" class="form-control" id="age" name="age" required value="<?php echo e(old('age')); ?>">
                <?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="pincode"><?php echo e(__('Pincode')); ?></label>
                <input type="text" class="form-control" id="pincode" name="pincode" required value="<?php echo e(old('pincode')); ?>">
                <?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="gender"><?php echo e(__('Gender')); ?></label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value=""><?php echo e(__('Select Gender')); ?></option>
                    <option value="male" <?php echo e(old('gender') == 'male' ? 'selected' : ''); ?>><?php echo e(__('Male')); ?></option>
                    <option value="female" <?php echo e(old('gender') == 'female' ? 'selected' : ''); ?>><?php echo e(__('Female')); ?></option>
                </select>
                <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="password"><?php echo e(__('Password')); ?></label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="level_1_refer"><?php echo e(__('Level 1 Refer')); ?></label>
                <input type="text" class="form-control" id="level_1_refer" name="level_1_refer" value="<?php echo e($refer_code); ?>" disabled>
                <?php $__errorArgs = ['level_1_refer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group text-end">
                <button type="submit" class="btn btn-primary"><?php echo e(__('Register Customer')); ?></button>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
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
    });
</script>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/auth/addusers.blade.php ENDPATH**/ ?>