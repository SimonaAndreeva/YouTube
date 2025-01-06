<div>
    <!-- Use dynamic $id for the label's 'for' and input's 'id' and 'name' attributes -->
    <label for="<?php echo e($id); ?>" class="block text-sm font-medium text-gray-700"><?php echo e($label); ?></label>
    <input
        type="text"
        id="<?php echo e($id); ?>"
        name="<?php echo e($id); ?>"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        value="<?php echo e(old($id, $slot)); ?>"
        placeholder="Enter a tag"
        <?php echo e($attributes); ?> />
</div><?php /**PATH /var/www/html/resources/views/components/tags.blade.php ENDPATH**/ ?>