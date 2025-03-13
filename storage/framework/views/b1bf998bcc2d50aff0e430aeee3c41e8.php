

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Activate Customers')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('inactive_users.activate')); ?>"><?php echo e(__('Activate Customers')); ?></a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <!-- Display Available Recharge Balance -->
                <div class="d-flex flex-wrap align-items-center justify-content-between flex-md-row flex-column">
                    <!-- Recharge Balance (Right Side on Desktop, Top on Mobile) -->
                    <div class="recharge-balance p-2 order-1 order-md-2 mt-2 mt-md-0 text-break"
                        style="font-size: 14px; background-color: #f1f1f1; padding: 5px 10px; border-radius: 5px; word-wrap: break-word; text-align: center;">
                        <strong><?php echo e(__('Membership Activation Balance : Rs')); ?> <?php echo e($recharge); ?></strong>
                    </div>

                    <!-- Customer Details (Left Side on Desktop, Below Recharge on Mobile) -->
                    <p class="customer-details order-2 order-md-1 mt-2 mt-md-0 text-md-start text-start text-break"
                        style="font-size: 13px; white-space: normal; word-wrap: break-word;">
                        <strong><?php echo e(__('Customer ID:')); ?></strong> <?php echo e($id); ?> 
                        <strong><?php echo e(__('Name:')); ?></strong> <?php echo e($userName); ?> 
                        <strong><?php echo e(__('Mobile:')); ?></strong> <?php echo e($userMobile); ?>

                    </p>
                </div>



                <!-- Display the level-specific activation button -->
                <div class="mt-4">
                    <h5><?php echo e(__('Activate for Level ')); ?> <?php echo e($level); ?></h5>

                    <?php if(request()->query('level') > 1): ?>
                        <div class="mt-4" id="userDropdownContainer">
                            <select class="form-select" id="userDropdown" style="width: 50%;"> 
                                <?php if(request()->query('level') == 2): ?>
                                    <option value=""><?php echo e(__('Choose Your Level 2 Customers')); ?></option>
                                <?php elseif(request()->query('level') == 3): ?>
                                    <option value=""><?php echo e(__('Choose Your Level 3 Customers')); ?></option>
                                <?php elseif(request()->query('level') == 4): ?>
                                    <option value=""><?php echo e(__('Choose Your Level 4 Customers')); ?></option>
                                <?php endif; ?>
                            </select>
                        </div>
                    <?php elseif(request()->query('level') == 1): ?>
                       
                    <?php endif; ?>

                    <br>
                    <button type="button" class="btn btn-success" id="activateUserBtn"><?php echo e(__('Click to Activate')); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    var userId = "<?php echo e(Session::get('user_id')); ?>"; // Get user_id from the session
    var level = "<?php echo e($level); ?>"; // Get the level from the Blade variable
    var droplevel = Number(level) - 1;
    // Hide the dropdown for level 1 and show custom message instead
    if (level == 1) {
        $('#userDropdownContainer').hide(); // Hide the dropdown
        $('#activateLevelBtn').prop('disabled', true); // Disable the button since no activation can happen for level 1
    }

    function fetchUsersForLevel() {
    if (level > 1) {
        $.ajax({
            url: "<?php echo e(route('inactive_users.getLevelUsers')); ?>",
            type: 'GET',
            data: {
                user_id: userId,
                level: droplevel
            },
            success: function(response) {
                if (response.data) {
                    var userDropdown = $('#userDropdown');
                    userDropdown.empty();
                    
                    $.each(response.data, function(index, user) {
                        userDropdown.append('<option value="' + user.id + '" data-name="' + user.name + '" data-mobile="' + user.mobile + '">' + user.id + ' - ' + user.name + ' - ' + user.mobile + '</option>');
                    });
                } else {
                    alert('No Customers found for the selected level.');
                }
                },
                error: function(xhr, status, error) {
                    alert('No Customers found for the selected level.');
                }
            });
        }
    }
    if (level > 1) {
        fetchUsersForLevel();
    }

});
</script>
<script>
    $(document).ready(function() {
  $('#activateUserBtn').click(function () {
    function getQueryParam(param) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    var selectedLevel = getQueryParam("level");
    var selectedUserId = getQueryParam("id");
    var selectedUserName = getQueryParam("name");
    var selectedUserMobile = getQueryParam("mobile");
    var selectedLevelUserId = null;

    if (selectedLevel > 1) {
        selectedLevelUserId = $("#userDropdown").val();
        selectedUserName = $("#userDropdown option:selected").data('name');
        selectedUserMobile = $("#userDropdown option:selected").data('mobile');

        if (!selectedLevelUserId) {
            alert("Please select a user from the dropdown.");
            return;
        }
    }

    if (!selectedUserId) {
        alert("No user selected for activation.");
        return;
    }

    $.ajax({
    url: "<?php echo e(route('inactive_users.activateusers')); ?>",
    type: 'GET',
    data: {
        id: selectedUserId,
        name: selectedUserName,
        mobile: selectedUserMobile,
        level: selectedLevel,
        level_user_id: selectedLevelUserId 
    },
    success: function (response) {
        if (response.success) {
            alert('User activated successfully!');
            window.location.href = "<?php echo e(route('inactive_users.index')); ?>";
        } else {
            alert('Failed to activate user. ' + response.message);
        }
    },
    error: function (xhr) {
        var errorMessage = 'Error activating user.';
        
        if (xhr.responseJSON && xhr.responseJSON.message) {
            errorMessage = xhr.responseJSON.message;
        }
        
        alert(errorMessage);
    }
});

});

});
</script>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/inactive_users/activate.blade.php ENDPATH**/ ?>