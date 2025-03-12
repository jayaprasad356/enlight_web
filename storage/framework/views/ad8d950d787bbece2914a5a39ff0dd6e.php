

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('My Inactive Customers List')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('My Inactive Customers List')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <!-- Row to align buttons on the left and balance on the right -->
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <!-- Buttons (Left Aligned) -->
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-info recharge-now-btn" onclick="showImage()">
                            <?php echo e(__('Recharge Now')); ?>

                        </button>

                        <button type="button" class="btn btn-warning upload-screenshot-btn" 
                            onclick="window.location.href='<?php echo e(route('payment_screenshots.create')); ?>'">
                            <?php echo e(__('Upload Screenshot')); ?>

                        </button>
                    </div>

                    <!-- Balance (Right Aligned) -->
                    <div class="recharge-balance p-2" style="font-size: 16px; background-color: #f1f1f1; padding: 5px 10px; border-radius: 5px;">
                        <strong><?php echo e(__('Membership Activation Balance: Rs')); ?> <?php echo e($recharge); ?></strong>
                    </div>
                </div>

                <br>
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th><?php echo e(__('ID')); ?></th>
                                <th><?php echo e(__('Customer Name')); ?></th>
                                <th><?php echo e(__('Mobile')); ?></th>
                                <th><?php echo e(__('DateTime')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($user['id']); ?></td>
                                    <td><?php echo e($user['name'] ?? 'N/A'); ?></td>
                                    <td><?php echo e($user['mobile'] ?? 'N/A'); ?></td>
                                    <td><?php echo e($user['registered_datetime'] ?? 'N/A'); ?></td>
                                    <td>
                                        <!-- Button to trigger modal -->
                                        <button type="button" class="btn btn-success btn-sm activate-user-btn" 
                                            data-id="<?php echo e($user['id']); ?>" 
                                            data-name="<?php echo e($user['name'] ?? 'N/A'); ?>" 
                                            data-mobile="<?php echo e($user['mobile'] ?? 'N/A'); ?>">
                                            <?php echo e(__('Click To Activate')); ?>

                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Bootstrap Modal -->
                <div class="modal fade" id="userActivationModal" tabindex="-1" aria-labelledby="userActivationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="userActivationModalLabel"><?php echo e(__('Customer Details')); ?></h5>
                                <!-- Button to close modal -->
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong><?php echo e(__('Customer ID:')); ?></strong> <span id="modalUserId"></span> | <strong><?php echo e(__('Name:')); ?></strong> <span id="modalUserName"></span> | <strong><?php echo e(__('Mobile:')); ?></strong> <span id="modalUserMobile"></span></p>

                                <!-- Level-specific activation buttons -->
                                <div class="mt-3">
                                    <center><button type="button" class="btn btn-primary w-50 mb-2" id="level1Btn"><?php echo e(__('Level 1')); ?></button></center>
                                    <center><button type="button" class="btn btn-secondary w-50 mb-2" id="level2Btn"><?php echo e(__('Level 2')); ?></button></center>
                                    <center><button type="button" class="btn btn-warning w-50 mb-2" id="level3Btn"><?php echo e(__('Level 3')); ?></button></center>
                                    <center><button type="button" class="btn btn-danger w-50 mb-2" id="level4Btn"><?php echo e(__('Level 4')); ?></button></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4><?php echo e(__('Customers List')); ?></h4>
                <form method="GET" action="<?php echo e(route('inactive_users.index')); ?>" class="d-flex justify-content-end mb-3">
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
                            <th><?php echo e(__('Action')); ?></th>
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
                                    <td>
                                        <?php if(isset($customer['status']) && $customer['status'] == 0): ?>
                                            <!-- Show "Click To Activate" button only if status is 0 -->
                                            <button type="button" class="btn btn-success btn-sm activate-user-btn" 
                                                data-id="<?php echo e($customer['id']); ?>" 
                                                data-name="<?php echo e($customer['name'] ?? 'N/A'); ?>" 
                                                data-mobile="<?php echo e($customer['mobile'] ?? 'N/A'); ?>">
                                                <?php echo e(__('Click To enable')); ?>

                                            </button>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?php echo e(__('Already Activated')); ?></span>
                                        <?php endif; ?>
                                    </td>
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




<div id="qrCodeModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Scan QR Code for Subscription')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                    <?php if(isset($news) && $news->qr_image): ?>
                        <img id="qrImage" src="<?php echo e(asset('admin/storage/app/public/' . $news->qr_image)); ?>" alt="QR Code" class="img-fluid" />
                    <?php else: ?>
                        <p><?php echo e(__('No QR code available')); ?></p>
                    <?php endif; ?>

                <p class="mt-3"><?php echo e(__('Scan this QR code to complete your subscription.')); ?></p>
            </div>
        </div>
<?php $__env->stopSection(); ?>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Ensure jQuery is loaded -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->

<script>
  $(document).ready(function () {
    // When "Activate User" button is clicked
    $(".activate-user-btn").on("click", function () {
        let userId = $(this).data("id");
        let userName = $(this).data("name");
        let userMobile = $(this).data("mobile");
        let buttonText = $(this).text().trim();

        // Update modal content with the selected user's info
        $("#modalUserId").text(userId);
        $("#modalUserName").text(userName);
        $("#modalUserMobile").text(userMobile);

        // Set data attributes for level-specific buttons
        $("#level1Btn, #level2Btn, #level3Btn, #level4Btn").each(function (index, btn) {
            $(btn).data("userId", userId)
                .data("userName", userName)
                .data("userMobile", userMobile)
                .data("level", index + 1);
        });

        // Enable all level buttons if "Click To Activate" is clicked
        if (buttonText === "Click To Activate") {
            $("#level1Btn, #level2Btn, #level3Btn, #level4Btn").prop("disabled", false);
        }
        // Disable Level 2, 3, and 4 if "Click To Enable" is clicked
        else if (buttonText === "Click To enable") {
            $("#level2Btn, #level3Btn, #level4Btn").prop("disabled", true);
            $("#level1Btn").prop("disabled", false);
        }

        // Open the modal
        $("#userActivationModal").modal("show");
    });

    // Handle level-specific activation buttons
    $("#level1Btn, #level2Btn, #level3Btn, #level4Btn").on("click", function () {
        let userId = $(this).data("userId");
        let userName = $(this).data("userName");
        let userMobile = $(this).data("userMobile");
        let level = $(this).data("level");

        // Redirect to activation route
        window.location.href = "<?php echo e(route('inactive_users.activate')); ?>" +
            "?id=" + userId +
            "&name=" + userName +
            "&mobile=" + userMobile +
            "&level=" + level;
    });
});


</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>

<script>
function showImage() {
    // Open the modal
    $('#qrCodeModal').modal('show');
    
}

$(document).ready(function() {
    // Close the modal when clicking the close button
    $('.close').click(function() {
        $('#qrCodeModal').modal('hide');
    });

    // Also close when clicking outside the modal content
    $(document).click(function(event) {
        if ($(event.target).closest("#qrCodeModal .modal-content").length === 0) {
            $('#qrCodeModal').modal('hide');
        }
    });
});
</script>
<script>
$(document).ready(function () {
    $("#customerSearch").on("keyup", function () {
        let value = $(this).val().toLowerCase();
        $("#customers-table tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
</script>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/inactive_users/index.blade.php ENDPATH**/ ?>