@php
    $homePage = $homePage ?? \App\Models\HomePage::getCurrent();
    $homePage->loadMissing('welcomePopupForm');

    if (! $homePage->shouldShowWelcomePopup()) {
        return;
    }

    if (request()->routeIs('custom_forms.*')) {
        return;
    }

    $formUrl = $homePage->welcomePopupForm?->publicUrl();
    $whatsappUrl = 'https://wa.me/905060050350';
@endphp

<div
    data-welcome-popup
    class="hidden fixed inset-0 z-[60]"
    role="dialog"
    aria-modal="true"
    aria-labelledby="welcome-popup-title"
>
    <div
        data-welcome-overlay
        class="absolute inset-0 bg-secondary/50 backdrop-blur-sm opacity-0 transition-opacity duration-300"
    ></div>

    <div class="absolute inset-0 flex items-center justify-center p-4 sm:p-6">
        <div
            data-welcome-panel
            class="relative w-full max-w-lg rounded-2xl border border-primary/25 bg-bg-main/95 backdrop-blur-xl shadow-2xl shadow-secondary/20 p-6 sm:p-8 scale-95 opacity-0 transition-all duration-300"
        >
            <button
                type="button"
                data-welcome-dismiss
                class="absolute top-4 end-4 text-gray-400 hover:text-primary transition-colors"
                aria-label="{{ __('Close') }}"
            >
                <span class="material-symbols-outlined">close</span>
            </button>

            <div class="text-center mb-6 pt-2">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-primary/10 text-primary mb-4">
                    <span class="material-symbols-outlined text-3xl">travel_explore</span>
                </div>
                <h2 id="welcome-popup-title" class="text-xl sm:text-2xl font-bold text-secondary font-heading leading-relaxed">
                    {{ $homePage->welcome_popup_message }}
                </h2>
            </div>

            <div class="flex flex-col gap-3">
                @if ($formUrl)
                    <a
                        href="{{ $formUrl }}"
                        class="inline-flex items-center justify-center gap-2 w-full px-5 py-3.5 rounded-xl bg-gold-gradient text-white font-bold text-sm uppercase tracking-wide hover:brightness-110 transition-all"
                    >
                        <span class="material-symbols-outlined text-lg">edit_document</span>
                        {{ __('Fill out the form') }}
                    </a>
                @endif

                <a
                    href="{{ $whatsappUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    data-track-source="Welcome Popup WhatsApp"
                    data-welcome-dismiss
                    class="inline-flex items-center justify-center gap-2 w-full px-5 py-3.5 rounded-xl border-2 border-primary/30 bg-primary/5 text-primary font-bold text-sm hover:bg-primary/10 transition-all"
                >
                    <span class="material-symbols-outlined text-lg">support_agent</span>
                    {{ __('Contact a tourism expert') }}
                </a>

                <button
                    type="button"
                    data-welcome-dismiss
                    class="inline-flex items-center justify-center gap-2 w-full px-5 py-3 text-gray-500 font-medium text-sm hover:text-secondary transition-colors"
                >
                    {{ __('Skip and browse the site') }}
                </button>
            </div>
        </div>
    </div>
</div>
