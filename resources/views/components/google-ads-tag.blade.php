@php
    $conversionId = config('services.google_ads.conversion_id');
    $conversionLabel = config('services.google_ads.conversion_label');
@endphp

@if($conversionId && $conversionLabel)
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $conversionId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', @json($conversionId));
        window.googleAdsConversionSendTo = @json($conversionId.'/'.$conversionLabel);
    </script>
@endif
