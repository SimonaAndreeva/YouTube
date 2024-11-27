@props(['icon' => '', 'title' => '', 'link' => null]) <!-- Set link to null by default -->

@if($link)
    <!-- Render an <a> tag if a link is provided -->
    <a href="{{ $link }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
        @if($icon)
            <i class="{{ $icon }} mr-2"></i> <!-- Render FontAwesome icon -->
        @endif
        {{ $title }}
    </a>
@else
    <!-- Render a <button> if no link is provided -->
    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
        @if($icon)
            <i class="{{ $icon }} mr-2"></i> <!-- Render FontAwesome icon -->
        @endif
        {{ $title }}
    </button>
@endif
