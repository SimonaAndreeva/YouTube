<label for="{{ $attributes['id'] ?? 'datetime' }}" class="block text-sm font-medium text-gray-700">
    {{ $label ?? 'Date and Time' }}
</label>
<input
    type="datetime-local"
    id="{{ $attributes['id'] ?? 'datetime' }}"
    name="{{ $attributes['name'] ?? 'datetime' }}"
    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
    value="{{ $value ?? old($attributes['name'] ?? 'datetime') }}">