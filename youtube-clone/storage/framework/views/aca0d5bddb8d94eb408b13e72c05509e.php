<div x-data="{ playing: false }">
    <div class="col-span-4">
        <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['class' => 'shadow-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'shadow-lg']); ?>
            <!-- Video Section -->
             <?php $__env->slot('figure', null, []); ?> 
                <video
                    x-ref="player"
                    @mouseenter="playing = true; $refs.player.play()"
                    @mouseleave="playing = false; $refs.player.pause(); $refs.player.currentTime = 0"
                    id="player"
                    muted
                    loop
                    preload="metadata"
                    class="rounded-lg w-full"
                    poster="<?php echo e(asset('storage/' . $video->thumbnail_path)); ?>"
                    data-poster="<?php echo e(asset('storage/' . $video->thumbnail_path)); ?>">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $video->formats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $format): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <source src="<?php echo e(asset('storage/' . $format->file_path)); ?>" type="video/mp4" size="<?php echo e($format->quality); ?>" />
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </video>
             <?php $__env->endSlot(); ?>

            <!-- Content Section -->
            <div class="space-y-2 p-4">
                <!-- Profile Picture and Metadata -->
                <div class="flex items-center justify-between">
                    <!-- Profile -->
                    <div class="flex items-center space-x-3">
                        <a href="#" wire:navigate>
                            <img
                                src="<?php echo e($video->user->profile_photo_url); ?>"
                                alt="User Profile"
                                class="rounded-full w-10 h-10" />
                        </a>
                        <div>
                            <p class="text-sm font-medium text-gray-800"><?php echo e($video->user->name); ?></p>
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="flex items-center space-x-3 text-gray-500 text-sm">
                        <span>12k</span>
                        <span class="border-l h-4 border-gray-300"></span>
                        <time datetime="<?php echo e($video->created_at); ?>" title="<?php echo e($video->created_at); ?>">
                            <?php echo e($video->created_at->diffForHumans()); ?>

                        </time>
                    </div>
                </div>

                <!-- Video Title -->
                <h2 class="text-lg font-semibold text-gray-900 truncate"><?php echo e($video->title); ?></h2>
            </div>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
    </div>
</div><?php /**PATH /var/www/html/resources/views/livewire/video-card.blade.php ENDPATH**/ ?>