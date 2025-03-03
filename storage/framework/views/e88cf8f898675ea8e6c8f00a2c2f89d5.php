

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Help & Support List')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Help & Support List')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body text">
        <h5 class="card-title"><?php echo e(__('Help & Support')); ?></h5>
        
        <br>
        
        <!-- Join Telegram Channel -->
        <a href="<?php echo e($telegram_link); ?>" target="_blank" class="btn btn-info d-block w-50 mb-2">
            <?php echo e(__('Join Telegram Channel')); ?>

        </a>

        <!-- Zoho Chat Support -->
        <a href="<?php echo e($zoho_chat_link); ?>" target="_blank" class="btn btn-success d-block w-50 mb-2">
            <?php echo e(__('Chat With Us')); ?>

        </a>

    </div>
</div>

<script>
    function copyInvitationLink() {
        // Create a temporary input field to copy the invitation link
        const tempInput = document.createElement('input');
        document.body.appendChild(tempInput);
        tempInput.value = "<?php echo e($invitation_link); ?>"; // Add the invitation link
        tempInput.select();
        document.execCommand('copy'); // Copy the text to clipboard
        document.body.removeChild(tempInput);

        // Optional: Notify the user that the link has been copied
        alert("Invitation Link copied to clipboard!");
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/invite_friends/index.blade.php ENDPATH**/ ?>