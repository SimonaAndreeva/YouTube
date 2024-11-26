@props(['label' => null, 'disabled' => false])

<div>
    @if ($label)
        <label for="{{ $attributes->get('id') }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif

    <input {{ $disabled ? 'disabled' : '' }} 
        {!! $attributes->merge([
            'class' => 'bg-white text-gray border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
        ]) !!}>
</div>
