<?php echo e(Form::model($payment_screenshot, ['route' => ['payment_screenshots.update', $payment_screenshot->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('payment_screenshot', __('Payment Screenshot'), ['class' => 'form-label'])); ?>

            <a href="<?php echo e(('http://localhost/enlight_web/storage/app/public/' . $payment_screenshot->screenshots)); ?>" data-lightbox="image-<?php echo e($payment_screenshot->id); ?>">
                                                <img class="user-img img-thumbnail img-fluid" 
                                                    src="<?php echo e(('http://localhost/enlight_web/storage/app/public/' . $payment_screenshot->screenshots)); ?>" 
                                                    alt="Image" 
                                                    style="max-width: 100px; max-height: 100px;">
                                            </a>
        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('recharge', __('Recharge'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('recharge', null, ['class' => 'form-control', 'required'])); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('status', __('Status'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::select('status', [0 => 'Pending', 1 => 'Verified', 2 => 'Cancelled'], null, ['class' => 'form-control', 'required'])); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update Payment Screenshot')); ?>" class="btn btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\enlight_web\admin\resources\views/payment_screenshots/edit.blade.php ENDPATH**/ ?>