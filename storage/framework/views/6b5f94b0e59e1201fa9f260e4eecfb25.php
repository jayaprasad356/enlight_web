

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Customers List')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Customers List')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4><?php echo e(__('Customers List')); ?></h4>
                <form method="GET" action="<?php echo e(route('customers.index')); ?>" class="d-flex justify-content-end mb-3">
                        <input type="text" id="customerSearch" name="mobile" value="<?php echo e(request('mobile')); ?>" 
                            placeholder="Search by mobile number" class="form-control me-2" style="width: 200px;">
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Search')); ?></button>
                    </form>
                    <br>
                <div class="table-responsive">
                    <table class="table" id="customers-table">
                        <thead>
                            <tr>
                                <th><?php echo e(__('ID')); ?></th>
                                <th><?php echo e(__('Customer Name')); ?></th>
                                <th><?php echo e(__('Mobile')); ?></th>
                                <th><?php echo e(__('DateTime')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($customers->isEmpty()): ?>
                                <tr>
                                    <td colspan="5" class="text-center">No customers found.</td>
                                </tr>
                            <?php else: ?>
                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($customer['id']); ?></td>
                                        <td><?php echo e($customer['name'] ?? 'N/A'); ?></td>
                                        <td><?php echo e($customer['mobile'] ?? 'N/A'); ?></td>
                                        <td><?php echo e($customer['registered_datetime'] ?? 'N/A'); ?></td>
                                        <td><span class="badge bg-success"><?php echo e(__('Active')); ?></span></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/customers/index.blade.php ENDPATH**/ ?>