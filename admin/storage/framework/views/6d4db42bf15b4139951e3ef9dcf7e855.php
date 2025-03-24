<?php echo e(Form::model($order, ['route' => ['orders.update', $order->id], 'method' => 'PUT'])); ?>


<div class="modal-body">
    <div class="row">
       
        <!-- Product -->
        <div class="form-group col-md-12">
            <?php echo e(Form::label('product_id', __('Product'), ['class' => 'form-label'])); ?>

            <select name="product_id" class="form-control" required>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($product->id); ?>" <?php echo e($order->product_id == $product->id ? 'selected' : ''); ?>><?php echo e($product->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Price -->

        <div class="form-group col-md-12">
            <?php echo e(Form::label('price', __('Price'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('price', $order->price, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>

        <!-- User -->

        <div class="form-group col-md-12">
            <?php echo e(Form::label('user_id', __('User'), ['class' => 'form-label'])); ?>

            <select name="user_id" class="form-control" required>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>" <?php echo e($order->user_id == $user->id ? 'selected' : ''); ?>><?php echo e($user->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Address -->

        <div class="form-group col-md-12">
            <?php echo e(Form::label('address', __('Address'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('address', $order->address, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>

        <!-- Status -->
        <div class="form-group col-md-12">
            <?php echo e(Form::label('status', __('Status'), ['class' => 'form-label'])); ?>

            <select name="status" class="form-control" required>
                <option value="0" <?php echo e($order->status == 0 ? 'selected' : ''); ?>><?php echo e(__('Ordered')); ?></option>
                <option value="1" <?php echo e($order->status == 1 ? 'selected' : ''); ?>><?php echo e(__('Dispatched')); ?></option>
                <option value="2" <?php echo e($order->status == 2 ? 'selected' : ''); ?>><?php echo e(__('Delivered')); ?></option>
                <option value="3" <?php echo e($order->status == 3 ? 'selected' : ''); ?>><?php echo e(__('Cancelled')); ?></option>
            </select>
        </div>

        <!-- Live Tracking -->
        <div class="form-group col-md-12">
            <?php echo e(Form::label('live_tracking', __('Live Tracking'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('live_tracking', $order->live_tracking, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>   

    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update  Orders')); ?>" class="btn btn-primary">
</div>

<?php echo e(Form::close()); ?>


<script>
    let logoutTimer;

    function resetTimer() {
        clearTimeout(logoutTimer);
        logoutTimer = setTimeout(() => {
            window.location.href = "<?php echo e(route('login')); ?>";
        }, 300000); // 5 minutes
    }

    document.onload = resetTimer();
    document.onmousemove = resetTimer;
    document.onkeypress = resetTimer;
</script><?php /**PATH C:\xampp\htdocs\enlight_web\admin\resources\views/orders/edit.blade.php ENDPATH**/ ?>