<!DOCTYPE html>
<html dir="{{ $dir ?? 'rtl' }}" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('image/balkis_travel.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('image/balkis_travel.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('image/balkis_travel.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('image/balkis_travel.ico') }}">
    <title>@yield('title', 'Balkis Premium Group')</title>
    
    <!-- Meta Tags -->
    @hasSection('meta_description')
        <meta name="description" content="@yield('meta_description')">
    @else
        <meta name="description" content="@yield('title', 'Balkis Premium Group') - {{ __('We offer you a carefully selected collection of the best investment and tourism opportunities.') }}">
    @endif
    
    @hasSection('meta_keywords')
        <meta name="keywords" content="@yield('meta_keywords')">
    @else
        <meta name="keywords" content="Balkis, Tourism, Investment, Real Estate, Premium, Turkey, Istanbul, Trabzon">
    @endif
    
    <!-- Open Graph / Facebook -->
    @hasSection('og_title')
        <meta property="og:title" content="@yield('og_title')">
    @else
        <meta property="og:title" content="@yield('title', 'Balkis Premium Group')">
    @endif
        <meta property="og:type" content="@yield('og_type', 'website')">
        <meta property="og:url" content="@yield('og_url', url()->current())">
    @hasSection('og_description')
        <meta property="og:description" content="@yield('og_description')">
    @else
        <meta property="og:description" content="@yield('title', 'Balkis Premium Group') - {{ __('We offer you a carefully selected collection of the best investment and tourism opportunities.') }}">
    @endif
    @hasSection('og_image')
        <meta property="og:image" content="@yield('og_image')">
    @else
        <meta property="og:image" content="{{ asset('image/BALKIS TRAVEL TEXT HORIZONTAL.png') }}">
    @endif
        <meta property="og:locale" content="{{ app()->getLocale() === 'ar' ? 'ar_AR' : (app()->getLocale() === 'tr' ? 'tr_TR' : (app()->getLocale() === 'fr' ? 'fr_FR' : 'en_US')) }}">
        <meta property="og:site_name" content="Balkis Premium Group">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="@yield('og_url', url()->current())">
    @hasSection('og_title')
        <meta name="twitter:title" content="@yield('og_title')">
    @else
        <meta name="twitter:title" content="@yield('title', 'Balkis Premium Group')">
    @endif
    @hasSection('og_description')
        <meta name="twitter:description" content="@yield('og_description')">
    @else
        <meta name="twitter:description" content="@yield('title', 'Balkis Premium Group') - {{ __('We offer you a carefully selected collection of the best investment and tourism opportunities.') }}">
    @endif
    @hasSection('og_image')
        <meta name="twitter:image" content="@yield('og_image')">
    @else
        <meta name="twitter:image" content="{{ asset('image/BALKIS TRAVEL TEXT HORIZONTAL.png') }}">
    @endif
    
    <!-- Canonical URL -->
    @hasSection('canonical_url')
        <link rel="canonical" href="@yield('canonical_url')">
    @endif
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-bg-main text-gray-900" lang="{{ app()->getLocale() }}">
    <div class="relative flex min-h-screen flex-col overflow-hidden bg-bg-main">
        @include('components.navigation')
        
        <main class="grow">
            @yield('content')
        </main>
        
        @hasSection('showStatsBar')
            @include('components.stats-bar')
        @endif
        
        @php
            $homePage = $homePage ?? \App\Models\HomePage::getCurrent();
        @endphp
        @include('components.footer', ['homePage' => $homePage])
    </div>
    
    @stack('scripts')
</body>
</html>
