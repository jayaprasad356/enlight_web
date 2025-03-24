

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Orders')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Orders')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5><?php echo e(__('Orders List')); ?></h5>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th><?php echo e(__('ID')); ?></th>
                                <th><?php echo e(__('Product Image')); ?></th>
                                <th><?php echo e(__('Product Name')); ?></th>
                                <th><?php echo e(__('Price')); ?></th>
                                <th><?php echo e(__('User Name')); ?></th>
                                <th><?php echo e(__('User Mobile')); ?></th>
                                <th><?php echo e(__('Address')); ?></th>
                                <th><?php echo e(__('Datetime')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                   <td><?php echo e(ucfirst($order->id)); ?></td>
                                   <td>
                                            <a href="<?php echo e(asset('admin/storage/app/public/' . $order->products->image)); ?>" data-lightbox="image-<?php echo e($order->id); ?>">
                                                <img class="customer-img img-thumbnail img-fluid" src="<?php echo e(asset('admin/storage/app/public/' . $order->products->image)); ?>" alt="Image" style="max-width: 100px; max-height: 100px;">
                                            </a>
                                        </td>
                                        <td><?php echo e(ucfirst($order->products->name ?? '')); ?></td>
                                        <td><?php echo e(ucfirst($order->price)); ?></td>
                                   <td><?php echo e(ucfirst($order->users->name ?? '')); ?></td>
                                   <td><?php echo e(ucfirst($order->users->mobile ?? '')); ?></td>
                                        <td><?php echo e(ucfirst($order->address)); ?></td>
                                        <td><?php echo e(ucfirst($order->datetime)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable with default search functionality
        $('#pc-dt-simple').DataTable();
    });

    // Confirmation for delete action
    function confirmDelete(event, avatarId) {
        event.preventDefault(); // Prevent the default form submission

        // Show a confirmation dialog
        if (confirm("Are you sure you want to delete this avatar?")) {
            // If the user clicks "Yes", submit the delete form
            document.getElementById('delete-form-' + avatarId).submit();
        }
    }
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/orders/index.blade.php ENDPATH**/ ?>