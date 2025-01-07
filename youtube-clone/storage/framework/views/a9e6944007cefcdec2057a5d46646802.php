<!-- resources/views/components/card.blade.php -->
<div class="card <?php echo e($attributes->get('class')); ?>">
    <!-- Render figure slot (if provided) -->
    <div class="figure">
        <?php echo e($figure ?? ''); ?>

    </div>

    <!-- Render the default slot content -->
    <?php echo e($slot); ?>

</div><?php /**PATH /var/www/html/resources/views/components/card.blade.php ENDPATH**/ ?>