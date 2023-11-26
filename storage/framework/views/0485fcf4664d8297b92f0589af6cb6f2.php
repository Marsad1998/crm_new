<option value="">Select option</option>
<?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($model->id); ?>"><?php echo e($model->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\upwork\monties\resources\views/tenant/makenmodel/ajax/model-option.blade.php ENDPATH**/ ?>