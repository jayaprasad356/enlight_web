

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Add Products')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('products.index')); ?>"><?php echo e(__('Products')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Add Products')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h5><?php echo e(__('Add New Products')); ?></h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('products.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php $__errorArgs = ['gift_icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger">
                            <strong><?php echo e($message); ?></strong>
                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="form-group">
                        <label for="image" class="form-label"><?php echo e(__('Product Image')); ?></label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="name"><?php echo e(__('Name')); ?></label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description"><?php echo e(__('Description')); ?></label>
                        <textarea id="description" name="description" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                        <input type="number" id="amount" name="amount" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="offer"><?php echo e(__('Offer')); ?></label>
                        <input type="text" id="offer" name="offer" class="form-control" required>
                    </div>

                    <div class="form-group mt-4 text-center">
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
                        <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary"><?php echo e(__('Cancel')); ?></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\admin\resources\views/products/create.blade.php ENDPATH**/ ?>