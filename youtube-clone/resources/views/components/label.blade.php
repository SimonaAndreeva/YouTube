@props(['value', 'id'])

<label {{ $attributes->merge(['for' => $id, 'class' => 'block text-sm font-medium text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>