<!DOCTYPE html>
<html dir="{{ $dir ?? 'rtl' }}" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <link rel="icon" href="{{ asset('image/balkis_travel.ico') }}" type="image/x-icon">
    <title>@yield('title', 'Balkis Premium Group')</title>
    
    <!-- Meta Tags -->
    @hasSection('meta_description')
        <meta name="description" content="@yield('meta_description')">
    @endif
    
    @hasSection('meta_keywords')
        <meta name="keywords" content="@yield('meta_keywords')">
    @endif
    
    <!-- Open Graph / Facebook -->
    @hasSection('og_title')
        <meta property="og:type" content="@yield('og_type', 'article')">
        <meta property="og:url" content="@yield('og_url', url()->current())">
        <meta property="og:title" content="@yield('og_title')">
        <meta property="og:description" content="@yield('og_description')">
        @hasSection('og_image')
            <meta property="og:image" content="@yield('og_image')">
        @endif
        <meta property="og:locale" content="{{ app()->getLocale() === 'ar' ? 'ar_AR' : (app()->getLocale() === 'tr' ? 'tr_TR' : 'en_US') }}">
        <meta property="og:site_name" content="Balkis Premium Group">
    @endif
    
    <!-- Twitter -->
    @hasSection('og_title')
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="@yield('og_url', url()->current())">
        <meta name="twitter:title" content="@yield('og_title')">
        <meta name="twitter:description" content="@yield('og_description')">
        @hasSection('og_image')
            <meta name="twitter:image" content="@yield('og_image')">
        @endif
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
