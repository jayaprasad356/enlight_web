

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php
    $setting = App\Models\Utility::settings();
?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php if(session('status')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <!-- One Time Subscription Charge -->
        <div class="col-12 mb-3">
            <div class="alert alert-info text-center" role="alert">
            <h5><?php echo e(__('One Time Membership Charges - ₹299')); ?></h5>
            <a href="javascript:void(0);" class="btn btn-primary" onclick="showImage()">
                <?php echo e(__('Recharge Now')); ?>

            </a>
            <a href="<?php echo e(route('payment_screenshots.create')); ?>" class="btn btn-primary ml-2">
                <?php echo e(__('Upload Payment Screenshot')); ?>

            </a>
            <a href="javascript:void(0);" class="btn btn-primary ml-2" onclick="copyShareLink()">
                <?php echo e(__('Share Link')); ?>

            </a>



            </div>
        </div>

        <!-- QR Code Modal -->
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
    </div>
</div>
                

    
  
        <div class="col-xxl-12">
            <div class="row">

                <!-- Total Income Box -->
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-success">
                                            <i class="ti ti-wallet"></i>
                                        </div>
                                        <div class="ms-2">
                                            <small class="text-muted"><?php echo e(__('Monthly')); ?></small>
                                            <h6 class="m-0"><?php echo e(__('Salery')); ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <h4 class="m-0 text-success"><?php echo e(number_format($monthly_salary, 2)); ?></h4>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                            <a href="javascript:void(0);" class="btn btn-success" onclick="addToBalance('monthly_salary', <?php echo e($monthly_salary); ?>)">
                                    <?php echo e(__('Add to Withdrawals')); ?>

                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recharge Value Box -->
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-warning">
                                            <i class="ti ti-receipt"></i>
                                        </div>
                                        <div class="ms-2">
                                            <small class="text-muted"><?php echo e(__('Refer')); ?></small>
                                            <h6 class="m-0"><?php echo e(__('Income')); ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <h4 class="m-0 text-warning"><?php echo e(number_format($refer_income, 2)); ?></h4>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                            <a href="javascript:void(0);" class="btn btn-warning" onclick="addToBalance('refer_income', <?php echo e($refer_income); ?>)">
                                    <?php echo e(__('Add to Withdrawals')); ?>

                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                   <!-- Balance Box -->
                   <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-danger">
                                            <i class="ti ti-credit-card"></i>
                                        </div>
                                        <div class="ms-2">
                                            <small class="text-muted"><?php echo e(__('Whatsapp Status ')); ?></small>
                                            <h6 class="m-0"><?php echo e(__('Income')); ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <h4 class="m-0 text-danger"><?php echo e(number_format($whatsapp_status_income, 2)); ?></h4>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                            <a href="javascript:void(0);" class="btn btn-danger" onclick="addToBalance('whatsapp_status_income', <?php echo e($whatsapp_status_income); ?>)">
                                    <?php echo e(__('Add to Withdrawals')); ?>

                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-secondary">
                                            <i class="ti ti-credit-card"></i>
                                        </div>
                                        <div class="ms-2">
                                            <small class="text-muted"><?php echo e(__('Product Commission ')); ?></small>
                                            <h6 class="m-0"><?php echo e(__('Income')); ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <h4 class="m-0 text-secondary"><?php echo e(number_format($payment_wallet, 2)); ?></h4>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                            <a href="javascript:void(0);" class="btn btn-secondary" onclick="addToBalance('whatsapp_status_income', <?php echo e($whatsapp_status_income); ?>)">
                                    <?php echo e(__('Add to Withdrawals')); ?>

                                </a>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<!-- jQuery (Ensure it's loaded before Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

<script>
function addToBalance(type, amount) {
    $.ajax({
        url: "<?php echo e(route('balance.add')); ?>",
        type: "POST",
        data: {
            _token: "<?php echo e(csrf_token()); ?>",
            type: type,
            amount: amount
        },
        success: function(response) {
            if (response.success) {
                alert(response.message);
                location.reload();
            } else {
                alert(response.message);
            }
        },
        error: function() {
            alert("Something went wrong. Try again!");
        }
    });
}

function subscribe() {
    // Add your subscription logic here
    alert("Subscription logic goes here.");
}
</script>
    <!-- Include QRious.js for QR code generation -->
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
function copyShareLink() {
    var referCode = "<?php echo e(session('refer_code')); ?>"; // Correct way to retrieve session variable

    if (!referCode || referCode === 'null') {
        alert("Referral code not available.");
        return;
    }

    var link = "<?php echo e(route('addusers')); ?>" + "?refer_code=" + referCode; // Append referral code to URL
    var tempInput = document.createElement("input");
    document.body.appendChild(tempInput);
    tempInput.value = link;
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
    alert("Share link copied to clipboard: ");
}

</script>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/dashboard/dashboard.blade.php ENDPATH**/ ?>