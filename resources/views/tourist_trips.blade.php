@extends('layouts.app')

@section('title', __('Tourist Trips') . ' - Balkis Premium Group')
@section('meta_description', __('Explore our carefully curated tourist trips') . ' - Balkis Premium Group')
@section('og_title', __('Tourist Trips') . ' - Balkis Premium Group')

@section('content')
<!-- Hero Section -->
<section class="relative pt-32 pb-20 bg-slate-900 border-b border-primary/20 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-black z-0"></div>
    <!-- Particles/Background accents -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-gold-400/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-heading text-white mb-6 drop-shadow-lg leading-tight">
            {{ __('Tourist Trips') }}
        </h1>
        <div class="w-24 h-1 bg-gold-gradient mx-auto rounded-full mb-6 shadow-glow"></div>
        <p class="text-slate-300 font-text max-w-2xl mx-auto text-lg leading-relaxed">
            {{ __('Explore our carefully curated tourist trips') }}
        </p>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 md:py-24 bg-slate-50/50 relative">
    <div class="max-w-7xl mx-auto px-6">
        @if(isset($touristTrips) && $touristTrips->isNotEmpty())
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach($touristTrips as $trip)
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col md:flex-row group hover:shadow-xl transition-all duration-300">
                <div class="w-full md:w-2/5 h-64 md:h-auto relative overflow-hidden shrink-0">
                    @if($trip->image_url)
                        <img src="{{ $trip->image_url }}" alt="{{ $trip->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                    @else
                        <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                            <span class="material-symbols-outlined text-5xl text-slate-300">tour</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-l from-slate-900/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4 md:bottom-auto md:top-4 md:right-4 md:left-auto flex items-center gap-2">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-primary text-xs font-bold rounded-lg shadow-sm">{{ __('Trip') }}</span>
                    </div>
                </div>
                
                <div class="p-6 md:p-8 flex flex-col grow">
                    <h4 class="text-2xl font-bold font-heading text-slate-800 mb-6 group-hover:text-primary transition-colors">{{ $trip->title }}</h4>
                    
                    <div class="space-y-6 flex-grow font-text">
                        <!-- What is included -->
                        @if($trip->includes)
                        <div>
                            <h5 class="flex items-center gap-2 font-bold text-slate-700 mb-2">
                                <span class="material-symbols-outlined text-primary text-lg flex-shrink-0">check_circle</span>
                                {{ __('What is included') }}
                            </h5>
                            <div class="text-sm text-slate-500 leading-relaxed ps-7 line-clamp-3 prose prose-slate prose-sm text-slate-500">{!! $trip->includes !!}</div>
                        </div>
                        @endif

                        <!-- What to bring / do -->
                        @if($trip->what_to_bring)
                        <div>
                            <h5 class="flex items-center gap-2 font-bold text-slate-700 mb-2">
                                <span class="material-symbols-outlined text-primary text-lg flex-shrink-0">backpack</span>
                                {{ __('What to bring / Remarks') }}
                            </h5>
                            <div class="text-sm text-slate-500 leading-relaxed ps-7 line-clamp-3 prose prose-slate prose-sm text-slate-500">{!! $trip->what_to_bring !!}</div>
                        </div>
                        @endif
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end">
                        <a href="{{ route('whatsapp.redirect', ['locale' => app()->getLocale()]) }}?text={{ urlencode(__('Inquiry about ').$trip->title) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-900 hover:bg-primary text-white text-sm font-bold rounded-xl transition-all duration-300">
                            {{ __('Book Now') }}
                            <span class="material-symbols-outlined text-sm rtl:rotate-180">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-slate-100">
            <span class="material-symbols-outlined text-6xl text-slate-300 mb-4 block">tour</span>
            <p class="text-slate-500 font-text">{{ __('No programs available') }}</p>
        </div>
        @endif
    </div>
</section>
@endsection
