<textarea {{ $attributes->merge([
    'class' => 'bg-white text-gray-700 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
]) }}>
{{ $slot }}
</textarea>