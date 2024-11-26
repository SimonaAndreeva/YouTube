@props(['icon' => '', 'title' => '', 'link' => '#'])  <!-- Default values for fallback -->

<a href="{{ $link }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
    @if($icon)
        <i class="{{ $icon }} mr-2"></i>  <!-- This renders the FontAwesome icon -->
    @endif
    {{ $title }}
</a>
