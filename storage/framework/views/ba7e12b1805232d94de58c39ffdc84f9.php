<?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td>
        <input type="radio" name="lead" class="get-call-data"  value="<?php echo e($lead->id); ?>">
    </td>
    <td><?php echo e($lead->id); ?></td>
    <td>
        <?php if($lead->leadLatest): ?>
            <?php if($lead->leadLatest->price && $lead->leadLatest->price->models): ?>
                <?php echo e($lead->leadLatest->price->models->name); ?>

            <?php endif; ?>
        <?php else: ?> -
        <?php endif; ?>
    </td>
    <td>
        <?php if($lead->leadLatest): ?>
            <?php if($lead->leadLatest->price && $lead->leadLatest->price->services): ?>
                <?php echo e($lead->leadLatest->price->services->name); ?>

            <?php endif; ?>
        <?php else: ?>
        <?php endif; ?>
    </td>
    <td>
        <?php echo e(date("D, d M Y H:i a", strtotime($lead->created_at))); ?>

    </td>
    <td><?php echo e($lead->last_quoted); ?></td>
    <td><?php echo e($lead->notes); ?></td>
    <td>
        <?php if($lead->callLog): ?>
            <?php echo e($lead->callLog->status); ?>

        <?php else: ?>
            -
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><input type="radio" name="lead"></td>
    <td class="text-center" colspan="7">None of these, this a new lead.</td>
</tr>
<?php /**PATH C:\xampp\htdocs\upwork\monties\resources\views/tenant/quotes/ajax/records.blade.php ENDPATH**/ ?>