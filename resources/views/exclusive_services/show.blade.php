@extends('layouts.app')

@section('title', ($service->title ?? __('Service Details')) . ' - Balkis Premium Group')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($service->description ?? __('Balkis Exclusive Services')), 150))
@section('og_title', ($service->title ?? __('Service Details')) . ' - Balkis Premium Group')

@section('content')
@php
    $heroImage = $service->image_url ?? $service->display_image_url ?? asset('image/default-program.jpg');
    $services = $service->services ?? [];
    $whatsappLink = route('whatsapp.redirect', ['locale' => app()->getLocale()]) . '?text=' . urlencode(__('Inquiry about ') . $service->title);
@endphp

<!-- Hero Section -->
<section class="relative h-[60vh] min-h-[400px] w-full overflow-hidden pt-15">
    @if($service->image_url || $service->display_image_url)
        <img alt="{{ $service->title }}" class="w-full h-full object-cover" src="{{ $heroImage }}"/>
    @else
        <div class="w-full h-full bg-slate-800 flex items-center justify-center">
            <span class="material-symbols-outlined text-7xl text-slate-600">auto_awesome</span>
        </div>
    @endif
    <div class="absolute inset-0 bg-linear-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
    <div class="absolute bottom-0 right-0 left-0 max-w-7xl mx-auto px-6 pb-12">
        <div class="flex flex-col gap-4">
            <span class="w-fit px-3 py-1 bg-gold-gradient text-white text-xs font-bold rounded-lg shadow-sm">{{ __('Exclusive') }}</span>
            <h1 class="text-4xl md:text-6xl font-black leading-tight font-heading text-white/90">{{ $service->title }}</h1>
        </div>
    </div>
</section>

<main class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex flex-col lg:flex-row gap-12">
        <div class="grow lg:w-2/3 order-1 lg:order-1">
            @if($service->description)
                <section class="mb-12">
                    <h3 class="text-2xl font-bold mb-6 text-primary border-r-4 ltr:border-r-0 ltr:border-l-4 border-primary pr-4 ltr:pr-0 ltr:pl-4 font-heading">{{ __('Overview') }}</h3>
                    <p class="text-lg leading-relaxed text-slate-600 font-text whitespace-pre-line">{{ $service->description }}</p>
                </section>
            @endif

            @if(count($services) > 0)
                <section class="mb-12">
                    <h3 class="text-2xl font-bold mb-6 text-primary border-r-4 ltr:border-r-0 ltr:border-l-4 border-primary pr-4 ltr:pr-0 ltr:pl-4 font-heading">{{ __('Services') }}</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach($services as $item)
                            <div class="flex items-start gap-4 p-5 rounded-2xl bg-white border border-primary/10 shadow-sm">
                                <div class="bg-primary/10 p-2 rounded-lg shrink-0">
                                    <span class="material-symbols-outlined text-primary">check_circle</span>
                                </div>
                                <div>
                                    <h4 class="font-bold mb-1 font-heading text-slate-800">{{ $item['title'] ?? '' }}</h4>
                                    @if(!empty($item['description']))
                                        <p class="text-sm text-slate-500 leading-relaxed font-text">{{ $item['description'] }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>

        <aside class="lg:w-1/3 order-2 lg:order-2">
            <div class="sticky top-28 space-y-6">
                <div class="rounded-2xl border border-primary/30 p-8 shadow-2xl relative overflow-hidden bg-white">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 blur-3xl"></div>

                    @if($service->display_image_url)
                        <div class="mb-6 rounded-xl overflow-hidden">
                            <img src="{{ $service->display_image_url }}" alt="{{ $service->title }}" class="w-full h-40 object-cover">
                        </div>
                    @endif

                    <h4 class="text-lg font-bold mb-2 font-heading text-slate-800">{{ $service->title }}</h4>
                    <p class="text-sm text-slate-500 mb-6 font-text">{{ __('Contact us directly to learn more about this service') }}</p>

                    <a href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-3 w-full py-3.5 rounded-xl bg-slate-900 hover:bg-primary text-white transition-all font-bold font-heading">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.284l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.768-5.764-5.768zm3.393 8.125c-.15.424-.766.776-1.061.821-.285.043-.657.069-1.061-.06-.246-.079-.558-.189-.927-.352-1.571-.692-2.588-2.288-2.666-2.392-.078-.103-.639-.851-.639-1.624 0-.773.401-1.154.544-1.307.143-.153.312-.191.416-.191.104 0 .208.001.3.006.101.005.232-.039.363.273.134.319.458 1.116.498 1.197.04.081.066.176.013.282-.053.107-.078.176-.156.264-.078.088-.164.196-.234.264-.081.079-.165.166-.071.327.094.161.418.691.897 1.117.618.55 1.139.721 1.3.8.161.079.255.066.349-.043.094-.109.403-.468.511-.628.109-.16.216-.134.364-.079.148.055.939.442 1.1.523.161.081.268.121.307.189.039.068.039.394-.111.817zM12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2z"></path></svg>
                        {{ __('Direct WhatsApp Contact') }}
                    </a>
                </div>
            </div>
        </aside>
    </div>

    @if(isset($relatedServices) && $relatedServices->isNotEmpty())
        <section class="mt-16 pt-12 border-t border-slate-100">
            <h3 class="text-2xl font-bold mb-8 text-slate-800 font-heading">{{ __('Other Services') }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedServices as $related)
                    <a href="{{ route('exclusive_services.show', ['locale' => app()->getLocale(), 'slug' => $related->slug]) }}" class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col group hover:shadow-lg transition-all duration-300">
                        <div class="w-full h-44 relative overflow-hidden shrink-0">
                            @if($related->display_image_url)
                                <img src="{{ $related->display_image_url }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl text-slate-300">auto_awesome</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col grow">
                            <h4 class="text-base font-bold font-heading text-slate-800 mb-1 group-hover:text-primary transition-colors line-clamp-1">{{ $related->title }}</h4>
                            <span class="mt-4 inline-flex items-center gap-1 text-primary text-sm font-bold font-text">
                                {{ __('More Details') }}
                                <span class="material-symbols-outlined text-sm rtl:rotate-180">arrow_forward</span>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</main>
@endsection
