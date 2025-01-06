<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['icon' => '', 'title' => '', 'link' => null]));

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

foreach (array_filter((['icon' => '', 'title' => '', 'link' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?> <!-- Set link to null by default -->

<!--[if BLOCK]><![endif]--><?php if($link): ?>
    <!-- Render an <a> tag if a link is provided -->
    <a href="<?php echo e($link); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
        <!--[if BLOCK]><![endif]--><?php if($icon): ?>
            <i class="<?php echo e($icon); ?> mr-2"></i> <!-- Render FontAwesome icon -->
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <?php echo e($title); ?>

    </a>
<?php else: ?>
    <!-- Render a <button> if no link is provided -->
    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
        <!--[if BLOCK]><![endif]--><?php if($icon): ?>
            <i class="<?php echo e($icon); ?> mr-2"></i> <!-- Render FontAwesome icon -->
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <?php echo e($title); ?>

    </button>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
<?php /**PATH /var/www/html/resources/views/components/menu-item.blade.php ENDPATH**/ ?>