@php
    $locale = app()->getLocale();
    $brand = config('seo.brand');
    $schema = config('seo.schema');
    $brandName = $brand['name'][$locale] ?? $brand['name']['ar'];
    $description = $schema['description'][$locale] ?? $schema['description']['ar'];
    $logoUrl = asset($brand['logo']);
    $pageUrl = url()->current();

    $offers = collect($schema['offers'])->map(function (array $offer) use ($locale): array {
        return [
            '@type' => 'Offer',
            'itemOffered' => [
                '@type' => 'TouristTrip',
                'name' => $offer['name'][$locale] ?? $offer['name']['ar'],
                'description' => $offer['description'][$locale] ?? $offer['description']['ar'],
            ],
        ];
    })->values()->all();

    $areaServed = collect($schema['area_served'])->map(fn (string $country): array => [
        '@type' => 'Country',
        'name' => $country,
    ])->values()->all();

    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'TravelAgency',
        'name' => $brandName,
        'alternateName' => $brand['alternate_name'],
        'description' => $description,
        'url' => $pageUrl,
        'logo' => $logoUrl,
        'image' => $logoUrl,
        'telephone' => $brand['telephone'],
        'email' => $brand['email'],
        'address' => [
            '@type' => 'PostalAddress',
            'addressCountry' => $schema['address']['addressCountry'],
            'addressRegion' => $schema['address']['addressRegion'],
        ],
        'areaServed' => $areaServed,
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => $locale === 'ar' ? 'برامج السياحة الفاخرة في الشمال التركي' : 'Luxury Tourism Programs in Northern Turkey',
            'itemListElement' => $offers,
        ],
        'sameAs' => $schema['same_as'],
        'openingHoursSpecification' => [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            'opens' => '00:00',
            'closes' => '23:59',
        ],
        'priceRange' => $schema['price_range'],
        'currenciesAccepted' => $schema['currencies_accepted'],
        'paymentAccepted' => $schema['payment_accepted'],
        'inLanguage' => $locale,
    ];
@endphp

<script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
