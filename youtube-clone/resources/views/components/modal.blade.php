@props(['id', 'maxWidth', 'title'])

@php
    $id = $id ?? md5($attributes->wire('model'));
    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth ?? '2xl'];
@endphp

<div x-data="{ show: @entangle($attributes->wire('model')) }"
     x-on:close.stop="show = false"
     x-on:keydown.escape.window="show = false"
     x-show="show"
     id="{{ $id }}"
     class="jetstream-modal fixed inset-0 flex justify-center items-center overflow-y-auto px-4 py-6 sm:px-0 z-50">

    <!-- Modal overlay -->
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <!-- Modal content -->
    <div x-show="show" class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto px-10 py-10"
         x-trap.inert.noscroll="show"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

        <!-- Title Section -->
        @if(isset($title))
            <div class="px-6 py-4 text-xl font-bold text-gray-900">
                {{ $title }}
            </div>
        @endif

        <!-- Default slot content -->
        {{ $slot }}

        <!-- If actions slot is passed, render it -->
        @isset($actions)
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-4">
                {{ $actions }}
            </div>
        @endisset
    </div>
</div>
