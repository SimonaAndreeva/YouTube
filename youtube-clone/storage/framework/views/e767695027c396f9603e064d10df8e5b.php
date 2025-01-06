<button <?php echo e($attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150'
])); ?> <?php if(isset($attributes['wire:click'])): ?> wire:click="<?php echo e($attributes['wire:click']); ?>" <?php endif; ?>>
    <?php echo e($label ?? $slot); ?> <!-- Use the label if available, otherwise fallback to slot -->
</button><?php /**PATH /var/www/html/resources/views/components/button.blade.php ENDPATH**/ ?>