<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['label' => null, 'disabled' => false]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['label' => null, 'disabled' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div>
    <!-- Check if a label should be displayed -->
    <?php if($label): ?>
    <!-- Make sure the 'for' attribute is linked to the input's id -->
    <label for="<?php echo e($attributes->get('id')); ?>" class="block text-sm font-medium text-gray-700"><?php echo e($label); ?></label>
    <?php endif; ?>

    <!-- Input field -->
    <input
        <?php echo e($disabled ? 'disabled' : ''); ?>

        <?php echo $attributes->merge([ 'class' => 'bg-white text-gray border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm', ]); ?>

    >
</div><?php /**PATH /var/www/html/resources/views/components/input.blade.php ENDPATH**/ ?>