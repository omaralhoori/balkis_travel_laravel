@php
    $currentLocale = app()->getLocale();
    $supportedLocales = config('app.supported_locales', ['ar', 'en', 'tr']);

    $localeLabels = [
        'ar' => 'العربية',
        'en' => 'English',
        'tr' => 'Türkçe',
    ];

    $localeFlags = [
        'ar' => '🇸🇦',
        'en' => '🇬🇧',
        'tr' => '🇹🇷',
    ];

    // Build the URL for each locale by replacing the current locale segment
    $currentPath = request()->path();
    $segments = explode('/', $currentPath);

    // The first segment is the locale
    if (in_array($segments[0] ?? '', $supportedLocales)) {
        $pathWithoutLocale = implode('/', array_slice($segments, 1));
    } else {
        $pathWithoutLocale = $currentPath;
    }
    
    $uniqueId = 'lang-switcher-' . uniqid();
@endphp

<div class="relative" id="{{ $uniqueId }}">
    <button
        type="button"
        class="lang-switcher-btn flex items-center gap-2 text-gray-600 hover:text-primary transition-colors text-sm font-medium px-3 py-1.5 border border-gray-300 rounded-md hover:border-primary/50"
    >
        <span>{{ $localeFlags[$currentLocale] ?? '' }}</span>
        <span>{{ $localeLabels[$currentLocale] ?? strtoupper($currentLocale) }}</span>
        <svg class="w-3 h-3 transition-transform lang-switcher-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div
        class="lang-switcher-dropdown absolute top-full mt-2 end-0 w-40 bg-white border border-gray-200 rounded-md shadow-xl z-50 overflow-hidden"
        style="display: none;"
    >
        @foreach ($supportedLocales as $locale)
            <a
                href="/{{ $locale }}/{{ $pathWithoutLocale }}"
                class="flex items-center gap-3 px-4 py-2.5 text-sm transition-colors {{ $locale === $currentLocale ? 'text-primary bg-primary/10' : 'text-gray-600 hover:text-primary hover:bg-gray-50' }}"
            >
                <span>{{ $localeFlags[$locale] ?? '' }}</span>
                <span>{{ $localeLabels[$locale] ?? strtoupper($locale) }}</span>
                @if ($locale === $currentLocale)
                    <svg class="w-4 h-4 ms-auto text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                @endif
            </a>
        @endforeach
    </div>
</div>

<script>
(function() {
    const container = document.getElementById('{{ $uniqueId }}');
    if (!container) return;
    
    const btn = container.querySelector('.lang-switcher-btn');
    const dropdown = container.querySelector('.lang-switcher-dropdown');
    const arrow = container.querySelector('.lang-switcher-arrow');
    
    if (!btn || !dropdown) return;
    
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const isOpen = dropdown.style.display !== 'none';
        dropdown.style.display = isOpen ? 'none' : 'block';
        if (arrow) {
            arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
        }
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!container.contains(e.target)) {
            dropdown.style.display = 'none';
            if (arrow) {
                arrow.style.transform = 'rotate(0deg)';
            }
        }
    });
})();
</script>

