<div>
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <input
        type="text"
        id="{{ $id }}"
        name="{{ $id }}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        value="{{ old($id, $slot) }}"
        placeholder="Add tags, separated by commas"
        {{ $attributes }} />
    <!-- You can display any other tag-specific UI here if needed -->
</div>