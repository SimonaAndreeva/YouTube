<!-- resources/views/components/card.blade.php -->
<div class="card {{ $attributes->get('class') }}">
    <!-- Render figure slot (if provided) -->
    <div class="figure">
        {{ $figure ?? '' }}
    </div>

    <!-- Render the default slot content -->
    {{ $slot }}
</div>