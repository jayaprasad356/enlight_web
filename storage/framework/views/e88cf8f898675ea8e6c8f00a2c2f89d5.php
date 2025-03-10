

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
        <button onclick="loadZohoChat()" class="btn btn-success d-block w-50 mb-2">
            <?php echo e(__('Chat With Us')); ?>

        </button>

    </div>
</div>

<script>
    function loadZohoChat() {
        if (!document.getElementById('zsiqscript')) {
            window.$zoho = window.$zoho || {};
            $zoho.salesiq = $zoho.salesiq || {ready: function(){}};

            let script = document.createElement('script');
            script.id = "zsiqscript";
            script.src = "https://salesiq.zohopublic.in/widget?wc=siqb9948ef51cb6689eed89e1c5a558a1a4cc64b9992892718da9c37636c8a62250";
            script.defer = true;
            document.body.appendChild(script);
        }
        document.head.appendChild(style);
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/invite_friends/index.blade.php ENDPATH**/ ?>