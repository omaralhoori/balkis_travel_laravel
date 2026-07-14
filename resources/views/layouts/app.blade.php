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

    @php
        $locale = app()->getLocale();
        $brandName = config('seo.brand.name.'.$locale, config('seo.brand.name.ar'));
        $defaultTitle = $brandName;
        $defaultDescription = config('seo.schema.description.'.$locale, config('seo.schema.description.ar'));
        $defaultKeywords = config('seo.defaults.keywords.'.$locale, config('seo.defaults.keywords.ar'));
        $defaultAuthor = config('seo.defaults.author.'.$locale, config('seo.defaults.author.ar'));
        $defaultOgImage = asset(config('seo.brand.logo'));
        $pageTitle = trim($__env->yieldContent('title', $defaultTitle));
        $pageDescription = trim($__env->yieldContent('meta_description', $defaultDescription));
        $pageKeywords = trim($__env->yieldContent('meta_keywords', $defaultKeywords));
        $ogTitle = trim($__env->yieldContent('og_title', $pageTitle));
        $ogDescription = trim($__env->yieldContent('og_description', $pageDescription));
        $ogUrl = trim($__env->yieldContent('og_url', url()->current()));
        $ogImage = trim($__env->yieldContent('og_image', $defaultOgImage));
        $twitterTitle = trim($__env->yieldContent('twitter_title', $ogTitle));
        $twitterDescription = trim($__env->yieldContent('twitter_description', $ogDescription));
        $canonicalUrl = trim($__env->yieldContent('canonical_url', url()->current()));
    @endphp

    <title>{{ $pageTitle }}</title>

    <meta name="description" content="{{ $pageDescription }}">
    <meta name="keywords" content="{{ $pageKeywords }}">
    <meta name="robots" content="{{ config('seo.defaults.robots') }}">
    <meta name="author" content="{{ $defaultAuthor }}">
    <meta name="language" content="{{ $locale }}">

    <link rel="canonical" href="{{ $canonicalUrl }}">

    <x-google-ads-tag />
    <!-- Meta Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1336915315078068');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=1336915315078068&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Meta Pixel Code -->
    <x-tiktok-pixel />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ $ogUrl }}">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDescription }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:locale" content="{{ $locale === 'ar' ? 'ar_AR' : ($locale === 'tr' ? 'tr_TR' : ($locale === 'fr' ? 'fr_FR' : 'en_US')) }}">
    <meta property="og:site_name" content="{{ $brandName }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $ogUrl }}">
    <meta name="twitter:title" content="{{ $twitterTitle }}">
    <meta name="twitter:description" content="{{ $twitterDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <x-seo-travel-agency-schema />

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

    <x-floating-contact />
    
    @stack('scripts')
</body>
</html>
