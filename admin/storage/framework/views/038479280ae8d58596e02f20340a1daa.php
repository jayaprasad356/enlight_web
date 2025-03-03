

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Products')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Products')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <a href="<?php echo e(route('products.create')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create New Products')); ?>" class="btn btn-sm btn-primary">
        <i class="ti ti-plus"></i> <?php echo e(__('Add New Products')); ?>

    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5><?php echo e(__('Products List')); ?></h5>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th><?php echo e(__('ID')); ?></th>
                                <th><?php echo e(__('Product Image')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                                <th><?php echo e(__('Offer')); ?></th>
                                <th width="300px"><?php echo e(__('Actions')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                   <td><?php echo e(ucfirst($product->id)); ?></td>
                                    <td>
                                        <a href="<?php echo e(asset('storage/app/public/' . $product->image)); ?>" data-lightbox="image-<?php echo e($product->id); ?>">
                                            <img class="customer-img img-thumbnail img-fluid" src="<?php echo e(asset('storage/app/public/' . $product->image)); ?>" alt="Image" style="max-width: 100px; max-height: 100px;">
                                        </a>
                                    </td>
                                    <td><?php echo e(ucfirst($product->name)); ?></td>
                                    <td><?php echo e(ucfirst($product->description)); ?></td>
                                    <td><?php echo e(ucfirst($product->amount)); ?></td>
                                    <td><?php echo e(ucfirst($product->offer)); ?></td>
                                    <td class="Action">
                                        <span>
                                            <!-- Edit Button -->
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" data-url="<?php echo e(route('products.edit', $product->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Product')); ?>"
                                                   class="btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                            <!-- Delete Button -->
                                            <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $product->id], 'id' => 'delete-form-' . $product->id]); ?>

                                                <a href="#" class="btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"
                                                onclick="confirmDelete(event, '<?php echo e($product->id); ?>')">
                                                    <i class="ti ti-trash text-white"></i>
                                                </a>
                                            <?php echo Form::close(); ?>


                                            </div>
                                        </span>
                                    </td>
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
    function confirmDelete(event, giftId) {
        event.preventDefault(); // Prevent the default form submission

        // Show a confirmation dialog
        if (confirm("Are you sure you want to delete this gift?")) {
            // If the user clicks "Yes", submit the delete form
            document.getElementById('delete-form-' + giftId).submit();
        }
    }
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\admin\resources\views/products/index.blade.php ENDPATH**/ ?>