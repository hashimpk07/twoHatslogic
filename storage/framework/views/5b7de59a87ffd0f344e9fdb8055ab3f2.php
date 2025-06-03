

<?php $__env->startSection('content'); ?>
<h1  style="margin-left:50px;" >Products</h1>

<?php if(session('success')): ?>
    <div style="margin-left:50px;" ><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="margin-left:50px;">
        <h3><?php echo e($product->name); ?></h3>
        <p>Price: ₹<?php echo e(number_format($product->price, 2)); ?></p>
        <p>Available Stock: <?php echo e($product->stock_quantity); ?></p>

        <form method="POST" action="<?php echo e(route('carts.add')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
            <input type="number" name="quantity" value="1" min="1" max="<?php echo e($product->stock_quantity); ?>">
            <button type="submit" <?php if($product->stock_quantity <= 0): ?> disabled <?php endif; ?>>Add to Carts</button>
        </form>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\2Hats\stealthguard-main\resources\views/products/index.blade.php ENDPATH**/ ?>