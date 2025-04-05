<div>
    @if (isset($logo))
        <div class="logo">
            {{ $logo }}
        </div>
    @endif

    {{ $slot }}
</div>
