

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
                                <th><i class="fas fa-qrcode text-primary"></i> <?php echo e(__('Refer Code')); ?></th>
                                <td><?php echo e($user->refer_code); ?></td>
                            </tr>

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

                    <!-- Buttons -->
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-primary mt-3">
                        <i class="fas fa-arrow-left"></i> <?php echo e(__('Back to Dashboard')); ?>

                    </a>

                    <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#updateProfileModal">
                        <i class="fas fa-edit"></i> <?php echo e(__('Update Profile')); ?>

                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Updating Profile -->
    <div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProfileModalLabel"><?php echo e(__('Update Profile')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="<?php echo e(route('profile.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label><?php echo e(__('Name')); ?></label>
                            <input type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>" required>
                        </div>

                        <div class="form-group mb-2">
                            <label><?php echo e(__('Mobile')); ?></label>
                            <input type="text" class="form-control" name="mobile" value="<?php echo e($user->mobile); ?>" required>
                        </div>

                        <div class="form-group mb-2">
                            <label><?php echo e(__('Age')); ?></label>
                            <input type="number" class="form-control" name="age" value="<?php echo e($user->age); ?>" required>
                        </div>

                      
                        <div class="form-group mb-2">
                            <label><?php echo e(__('Pincode')); ?></label>
                            <input type="text" class="form-control" name="pincode" value="<?php echo e($user->pincode); ?>" required>
                        </div>

                        <div class="form-group mb-2">
                            <label><?php echo e(__('Gender')); ?></label>
                            <select class="form-control" name="gender" required>
                                <option value="male" <?php echo e($user->gender == 'male' ? 'selected' : ''); ?>><?php echo e(__('Male')); ?></option>
                                <option value="female" <?php echo e($user->gender == 'female' ? 'selected' : ''); ?>><?php echo e(__('Female')); ?></option>
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label><?php echo e(__('Password')); ?></label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" value="<?php echo e($user->password); ?>">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted"><?php echo e(__('Leave blank to keep current password')); ?></small>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save Changes')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include FontAwesome & Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.querySelector('.toggle-password').addEventListener('click', function() {
            let passwordField = document.getElementById("password");
            let icon = this.querySelector("i");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/profile.blade.php ENDPATH**/ ?>