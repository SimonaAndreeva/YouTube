<label for="<?php echo e($attributes['id'] ?? 'datetime'); ?>" class="block text-sm font-medium text-gray-700">
    <?php echo e($label ?? 'Date and Time'); ?>

</label>
<input
    type="datetime-local"
    id="<?php echo e($attributes['id'] ?? 'datetime'); ?>"
    name="<?php echo e($attributes['name'] ?? 'datetime'); ?>"
    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
    value="<?php echo e($value ?? old($attributes['name'] ?? 'datetime')); ?>"><?php /**PATH /var/www/html/resources/views/components/datetime.blade.php ENDPATH**/ ?>