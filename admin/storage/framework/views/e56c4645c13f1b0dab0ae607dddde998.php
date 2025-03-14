

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Payment Screenshot')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Payment Screenshot')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <!-- Filter by Type Form -->
                <form action="<?php echo e(route('payment_screenshots.index')); ?>" method="GET" class="mb-3">
                    <div class="row align-items-end">
                        <!-- Existing Status Filter -->
                        <div class="col-md-3">
                            <label for="status"><?php echo e(__('Filter by Status')); ?></label>
                            <select name="status" id="status" class="form-control status-filter" onchange="this.form.submit()">
                                <option value=""><?php echo e(__('All')); ?></option>
                                <option value="0" <?php echo e(request()->get('status') == '0' ? 'selected' : ''); ?>><?php echo e(__('Pending')); ?></option>
                                <option value="1" <?php echo e(request()->get('status') == '1' ? 'selected' : ''); ?>><?php echo e(__('Verified')); ?></option>
                                <option value="2" <?php echo e(request()->get('status') == '2' ? 'selected' : ''); ?>><?php echo e(__('Cancelled')); ?></option>
                            </select>
                        </div>


                    </div>
                </form>

              
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                            <th><?php echo e(__('Actions')); ?></th>
                                <th><?php echo e(__('ID')); ?></th>
                                <th><?php echo e(__('User Name')); ?></th>
                                <th><?php echo e(__('User Mobile')); ?></th>
                                <th><?php echo e(__('Screenshot')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                          
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $payment_screenshots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_screenshot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                <td class="Action">
                                        <span>
                                            <!-- Edit Button -->
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" data-url="<?php echo e(route('payment_screenshots.edit', $payment_screenshot->id)); ?>" 
                                                data-ajax-popup="true" data-title="<?php echo e(__('Edit Payment Screenshot')); ?>"
                                                class="btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                        </span>
                                    </td>
                                    <td><?php echo e(ucfirst($payment_screenshot->id)); ?></td>
                                    <td><?php echo e(optional($payment_screenshot->users)->name ?? 'N/A'); ?></td>
                                    <td><?php echo e(optional($payment_screenshot->users)->mobile ?? 'N/A'); ?></td>
                                    <td>
                                    <?php if($payment_screenshot->screenshots): ?>
                                            <a href="<?php echo e(('https://enlightapp.in/storage/app/public/' . $payment_screenshot->screenshots)); ?>" data-lightbox="image-<?php echo e($payment_screenshot->id); ?>">
                                                <img class="user-img img-thumbnail img-fluid" 
                                                    src="<?php echo e(('https://enlightapp.in/storage/app/public/' . $payment_screenshot->screenshots)); ?>" 
                                                    alt="Image" 
                                                    style="max-width: 100px; max-height: 100px;">
                                            </a>
                                        <?php else: ?>
                                            <img class="user-img img-thumbnail img-fluid" 
                                                src="<?php echo e(asset('storage/default.jpg')); ?>" 
                                                alt="Default Image" 
                                                style="max-width: 100px; max-height: 100px;">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                            <?php if($payment_screenshot->status == 0): ?>
                                                <i class="fa fa-clock text-warning"></i> <span class="font-weight-bold"><?php echo e(__('Pending')); ?></span>
                                            <?php elseif($payment_screenshot->status == 1): ?>
                                                <i class="fa fa-check-circle text-success"></i> <span class="font-weight-bold"><?php echo e(__('Verified')); ?></span>
                                            <?php elseif($payment_screenshot->status == 2): ?>
                                                <i class="fa fa-times-circle text-danger"></i> <span class="font-weight-bold"><?php echo e(__('Cancelled')); ?></span>
                                            <?php else: ?>
                                                <i class="fa fa-question-circle text-secondary"></i> <span class="font-weight-bold"><?php echo e(__('Unknown')); ?></span>
                                            <?php endif; ?>
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
    <script src="<?php echo e(asset('plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
        <script>
         $(document).ready(function () {
    // Handle "Select All" checkbox
    $('#select-all').change(function() {
        // Get the state of the "Select All" checkbox
        var isChecked = $(this).prop('checked');

        // Select or deselect all individual checkboxes
        $('input[name="payment_screenshots_ids[]"]').prop('checked', isChecked);
    });

    // Handle individual checkboxes
    $('input[name="payment_screenshots_ids[]"]').change(function() {
        // If any individual checkbox is unchecked, uncheck the "Select All" checkbox
        if ($('input[name="payment_screenshots_ids[]"]:not(:checked)').length > 0) {
            $('#select-all').prop('checked', false); // Uncheck "Select All" checkbox
        } else {
            $('#select-all').prop('checked', true); // Check "Select All" checkbox if all are selected
        }
    });
});

        </script>

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
</script>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\admin\resources\views/payment_screenshots/index.blade.php ENDPATH**/ ?>