

<?php $__env->startSection('content'); ?>
<h1 style="margin-left:50px;">Your carts</h1>

<?php if(session('success')): ?>
    <div style="margin-left:50px;" ><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div style="margin-left:50px;" >
        <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li style="color:red"><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<?php if($carts->items->isEmpty()): ?>
    <p style="margin-left:50px;"> Your Carts is empty.</p>
<?php else: ?>
    <table style="margin-left:50px;">
        <thead>
            <tr>
                <th>Product</th><th>Price</th><th>Quantity</th><th>Total</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $grandTotal = 0; ?>
            <?php $__currentLoopData = $carts->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $total = $item->quantity * $item->product->price;
                    $grandTotal += $total;
                ?>
                <tr>
                    <td><?php echo e($item->product->name); ?></td>
                    <td>₹<?php echo e(number_format($item->product->price, 2)); ?></td>
                    <td>
                        <form method="POST" action="<?php echo e(route('carts.update', $item->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" min="1" max="<?php echo e($item->product->stock_quantity); ?>">
                            <button type="submit">Update</button>
                        </form>
                    </td>
                    <td>₹<?php echo e(number_format($total, 2)); ?></td>
                    <td>
                        <form method="POST" action="<?php echo e(route('carts.remove', $item->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="3"><strong>Grand Total</strong></td>
                <td><strong>₹<?php echo e(number_format($grandTotal, 2)); ?></strong></td>
                <td></td>
            </tr>
        </tbody>
    </table>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\2Hats\stealthguard-main\resources\views/carts/show.blade.php ENDPATH**/ ?>