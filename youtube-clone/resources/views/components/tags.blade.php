<div>
    <!-- Use dynamic $id for the label's 'for' and input's 'id' and 'name' attributes -->
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <input
        type="text"
        id="{{ $id }}"
        name="{{ $id }}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        value="{{ old($id, $slot) }}"
        placeholder="Enter a tag"
        {{ $attributes }} />
</div>