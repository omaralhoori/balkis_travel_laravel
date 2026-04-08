@extends('layouts.app')

@section('title', __('Accommodations') . ' - Balkis Premium Group')
@section('meta_description', __('Explore premium accommodations in various cities') . ' - Balkis Premium Group')
@section('og_title', __('Accommodations') . ' - Balkis Premium Group')

@section('content')
<!-- Hero Section -->
<section class="relative pt-32 pb-20 bg-slate-900 border-b border-primary/20 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-black z-0"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-gold-400/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-heading text-white mb-6 drop-shadow-lg leading-tight">
            {{ __('Accommodations') }}
        </h1>
        <div class="w-24 h-1 bg-gold-gradient mx-auto rounded-full mb-6 shadow-glow"></div>
        <p class="text-slate-300 font-text max-w-2xl mx-auto text-lg leading-relaxed">
            @if(request('city'))
                {{ __('Accommodations in') }} {{ request('city') }}
            @else
                {{ __('Select City') }}
            @endif
        </p>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 md:py-24 bg-slate-50/50 relative min-h-[50vh]">
    <div class="max-w-7xl mx-auto px-6">
        
        <!-- City Selector Cards if no city selected -->
        @if(!request('city'))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($cities as $city)
                    <a href="{{ route('accommodations.index', ['locale' => app()->getLocale(), 'city' => $city]) }}" class="group block relative overflow-hidden rounded-3xl shadow-sm border border-slate-100 bg-white aspect-[4/3] transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        @php
                            // Get a generic image for the city from its first accommodation
                            $cityAcc = $allAccommodations->first(function($acc) use ($city) {
                                return $acc->city === $city && count($acc->images_urls) > 0;
                            });
                            $cityImage = $cityAcc ? $cityAcc->images_urls[0] : null;
                        @endphp
                        
                        @if($cityImage)
                            <img src="{{ $cityImage }}" alt="{{ $city }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                        @else
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                <span class="material-symbols-outlined text-6xl text-slate-300">location_city</span>
                            </div>
                        @endif
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent"></div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-8 flex flex-col items-center justify-center text-center">
                            <h3 class="text-3xl font-bold font-heading text-white mb-2 drop-shadow-md group-hover:text-primary transition-colors flex items-center gap-2">
                                <span class="material-symbols-outlined">location_on</span>
                                {{ $city }}
                            </h3>
                            <span class="inline-block px-4 py-1.5 bg-primary/20 backdrop-blur-md border border-primary/30 text-white text-sm font-medium rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-4 group-hover:translate-y-0">
                                {{ __('Explore') }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
            
            @if($cities->isEmpty())
                <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-slate-100">
                    <span class="material-symbols-outlined text-6xl text-slate-300 mb-4 block">domain_disabled</span>
                    <p class="text-slate-500 font-text">{{ __('No accommodations available') }}</p>
                </div>
            @endif
            
        @else
            <!-- Accommodations in the selected city -->
            <div class="mb-12 flex justify-between items-center bg-white p-4 rounded-2xl shadow-sm border border-slate-100">
                <a href="{{ route('accommodations.index', ['locale' => app()->getLocale()]) }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-primary font-medium transition-colors font-text">
                    <span class="material-symbols-outlined rtl:rotate-180">arrow_back</span>
                    {{ __('Back to cities') }}
                </a>
                <h2 class="text-xl font-bold font-heading text-slate-800">{{ request('city') }}</h2>
            </div>
            
            @if($filteredAccommodations && $filteredAccommodations->isNotEmpty())
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($filteredAccommodations as $acc)
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col group hover:shadow-xl transition-all duration-300">
                        
                        <!-- Image Carousel or Single Image -->
                        <div class="relative h-72 w-full overflow-hidden shrink-0">
                            @if(count($acc->images_urls) > 0)
                                <img src="{{ $acc->images_urls[0] }}" alt="{{ $acc->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                                
                                @if(count($acc->images_urls) > 1)
                                <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between pointer-events-none">
                                    <div class="flex gap-1">
                                        @foreach(array_slice($acc->images_urls, 0, 5) as $idx => $img)
                                            <div class="w-2 h-2 rounded-full {{ $idx === 0 ? 'bg-white' : 'bg-white/50' }} shadow-sm"></div>
                                        @endforeach
                                    </div>
                                    <span class="px-2 py-1 bg-black/50 backdrop-blur-sm text-white text-xs rounded-md shadow-sm">
                                        <span class="material-symbols-outlined text-[14px] align-middle">photo_camera</span>
                                        {{ count($acc->images_urls) }}
                                    </span>
                                </div>
                                @endif
                                
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-5xl text-slate-300">hotel</span>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4 flex items-center gap-2">
                                <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-primary text-xs font-bold rounded-lg shadow-sm">
                                    {{ match($acc->type) {
                                        'hotel' => __('Hotel'),
                                        'hotel_apartment' => __('Hotel Apartment'),
                                        'cottage' => __('Cottage'),
                                        default => $acc->type
                                    } }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6 md:p-8 flex flex-col grow">
                            <div class="flex justify-between items-start gap-4 mb-4">
                                <h4 class="text-2xl font-bold font-heading text-slate-800 group-hover:text-primary transition-colors leading-tight">{{ $acc->title }}</h4>
                                
                                @if($acc->rating)
                                <div class="flex items-center gap-1 bg-amber-50 px-2 py-1 rounded-lg border border-amber-100 shrink-0">
                                    <span class="material-symbols-outlined text-amber-400 text-[18px] filled">star</span>
                                    <span class="font-bold text-amber-700 text-sm font-text pt-0.5">{{ $acc->rating }}</span>
                                </div>
                                @endif
                            </div>
                            
                            <div class="space-y-4 flex-grow font-text">
                                @if($acc->description)
                                <div class="text-sm text-slate-500 leading-relaxed line-clamp-4 prose prose-slate prose-sm text-slate-500">
                                    {!! $acc->description !!}
                                </div>
                                @endif
                            </div>
                            
                            <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap gap-4 items-center justify-between">
                                <div class="flex items-center gap-2 text-slate-500 text-sm bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">
                                    <span class="material-symbols-outlined text-sm text-primary">location_on</span>
                                    <span class="font-medium font-text">{{ $acc->city }}</span>
                                </div>
                                
                                @php
                                    $inquiryText = __('Inquiry about ') . match($acc->type) {
                                        'hotel' => __('Hotel'),
                                        'hotel_apartment' => __('Hotel Apartment'),
                                        'cottage' => __('Cottage'),
                                        default => ''
                                    } . ' ' . $acc->title . ' ' . __('in') . ' ' . $acc->city;
                                @endphp
                                
                                <a href="{{ route('whatsapp.redirect', ['locale' => app()->getLocale()]) }}?text={{ urlencode($inquiryText) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-slate-900 hover:bg-primary text-white text-sm font-bold rounded-xl transition-all duration-300 w-full sm:w-auto">
                                    <span class="material-symbols-outlined text-sm">chat</span>
                                    {{ __('Contact for Details') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-slate-100">
                    <span class="material-symbols-outlined text-6xl text-slate-300 mb-4 block">bed</span>
                    <p class="text-slate-500 font-text">{{ __('No accommodations available in this city') }}</p>
                </div>
            @endif
            
        @endif
    </div>
</section>
@endsection
