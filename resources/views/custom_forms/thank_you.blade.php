@extends('layouts.app')

@section('title', $form->thank_you_title ?? __('Thank you'))

@push('styles')
<style>
    .thank-you-page {
        --form-primary: {{ $form->primary_color }};
        --form-button: {{ $form->button_color }};
        --form-text: {{ $form->text_color }};
        min-height: 80vh;
        @if ($form->background_image_path)
        background-image: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.95)), url('{{ asset('storage/'.$form->background_image_path) }}');
        @endif
        background-size: cover;
        background-position: center;
    }
</style>
@endpush

@section('content')
<div class="thank-you-page flex items-center justify-center pt-24 pb-16 px-4">
    <div class="max-w-2xl w-full text-center bg-white/95 rounded-2xl border border-[#C6A264]/25 shadow-xl p-8 sm:p-12">
        @if ($form->logo_path)
            <img src="{{ asset('storage/'.$form->logo_path) }}" alt="{{ $form->title }}" class="h-16 mx-auto mb-6 object-contain">
        @endif

        <div class="text-5xl mb-4" style="color: var(--form-primary);">✓</div>

        <h1 class="text-3xl font-bold mb-4" style="color: var(--form-text);">
            {{ $form->thank_you_title ?? __('Thank you!') }}
        </h1>

        @if ($form->thank_you_message)
            <p class="text-gray-600 mb-8 leading-relaxed">{{ $form->thank_you_message }}</p>
        @endif

        @if ($whatsappUrl)
            <a
                href="{{ $whatsappUrl }}"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl text-white font-semibold text-lg transition hover:opacity-90"
                style="background: var(--form-button);"
                data-track-source="Custom Form WhatsApp"
            >
                <span class="material-symbols-outlined">chat</span>
                {{ $form->whatsapp_button_label ?? __('Contact us on WhatsApp') }}
            </a>
        @endif
    </div>
</div>
@endsection
