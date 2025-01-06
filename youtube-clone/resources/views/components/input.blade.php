@props(['label' => null, 'disabled' => false])

<div>
    <!-- Check if a label should be displayed -->
    @if ($label)
    <!-- Make sure the 'for' attribute is linked to the input's id -->
    <label for="{{ $attributes->get('id') }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif

    <!-- Input field -->
    <input
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge([ 'class' => 'bg-white text-gray border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm', ]) !!}
    >
</div>