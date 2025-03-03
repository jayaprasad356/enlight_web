<?php echo e(Form::model($products, ['route' => ['products.update', $products->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">
    <div class="row">
        <!-- Avatar Image Upload -->
        <div class="form-group col-md-12">
            <?php echo e(Form::label('image', __('Product Image'), ['class' => 'form-label'])); ?>

            <div class="mb-2">
                <img src="<?php echo e(asset('storage/app/public/' . $products->image)); ?>" class="img-thumbnail" width="100" alt="Gift Icon">
            </div>
            <input type="file" name="image" class="form-control">
        </div>
        <!-- Name -->
        <div class="form-group col-md-12">
            <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'required'])); ?>

        </div>
        <!-- Description -->
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'required'])); ?>

        </div>
        <!-- Amount -->
        <div class="form-group col-md-12">
            <?php echo e(Form::label('amount', __('Amount'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('amount', null, ['class' => 'form-control', 'required'])); ?>

        </div>
        <!-- Offer -->
        <div class="form-group col-md-12">
            <?php echo e(Form::label('offer', __('Offer'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('offer', null, ['class' => 'form-control', 'required'])); ?>

        </div>
      
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update Products')); ?>" class="btn btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\enlight_web\admin\resources\views/products/edit.blade.php ENDPATH**/ ?>