

<?php $__env->startSection('title', 'Products Management'); ?>
<?php $__env->startSection('content-header', 'Products Management'); ?>
<?php $__env->startSection('content-actions'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .stars {
        color:#6fd943;
        font-size: 25px;
    }
    .discount {
        color: #6fd943;
        font-weight: bold;
    }
    .original-price {
        text-decoration: line-through;
        color: grey;
    }
    .final-price {
        font-weight: bold;
        font-size: 18px;
     
    }
    .free-delivery {
        color: blue;
        font-weight: bold;
    }
    .price-container {
        display: flex;
        gap: 10px;
        align-items: center;
    }
</style>

<h3>My Products</h3>
<div class="recharge-balance" style="position: absolute; top: 10px; right: 10px; font-size: 16px; background-color: #f1f1f1; padding: 5px 10px; border-radius: 5px;">
    <strong><?php echo e(__('Available Recharge Balance: Rs')); ?> <?php echo e($recharge); ?></strong>
</div>
<br>
<div class="row">
  
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-3">
        <div class="card">
            <img src="<?php echo e(asset('admin/storage/app/public/' . $product->image)); ?>" class="card-img-top" alt="<?php echo e($product->name); ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo e($product->name); ?></h5>
                <p class="card-text"><?php echo e($product->description); ?></p>
                <p class="stars">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
                <div class="price-container">
                    <p class="discount">&#x2193; <?php echo e(round((($product->amount - $product->offer) / $product->amount) * 100)); ?>% OFF</p>
                    <p class="original-price">₹<?php echo e($product->amount); ?></p>
                    <p class="final-price">₹<?php echo e($product->offer); ?></p>
                </div>
                <p class="free-delivery">🚚 Free Delivery</p>
                <a href="#" class="btn btn-primary purchase-btn">Purchase</a>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<?php $__env->stopSection(); ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.purchase-btn').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent any default behavior
            alert("You are allowed to purchase products only on earning your monthly salary");
        });
    });
});
</script>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/my_products/index.blade.php ENDPATH**/ ?>