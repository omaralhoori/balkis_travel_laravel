@extends('layouts.app')

@section('title', __('Balkis Exclusive Services') . ' - Balkis Premium Group')
@section('meta_description', __('Discover the exclusive services we offer to make your experience exceptional'))
@section('og_title', __('Balkis Exclusive Services') . ' - Balkis Premium Group')

@section('content')
<section class="relative pt-44 pb-20" style="background-image: url('/image/pattern2.png');">
    <div class="absolute inset-0 bg-gradient-to-b from-bg-main/50 via-bg-main to-bg-main"></div>
    <div class="relative z-10 container mx-auto px-6 text-center">
        <span class="inline-block px-4 py-1 bg-gold-gradient text-white text-xs font-bold rounded-lg shadow-sm mb-6">{{ __('Exclusive') }}</span>
        <h1 class="text-4xl md:text-6xl font-black text-secondary mb-6 font-display tracking-tight leading-tight">
            {{ __('Balkis Exclusive Services') }}
        </h1>
        <p class="max-w-2xl mx-auto text-secondary text-lg leading-relaxed">
            {{ __('Discover the exclusive services we offer to make your experience exceptional') }}
        </p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 pb-20 relative z-20">
    @if($exclusiveServices->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($exclusiveServices as $service)
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col group hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="relative h-56 overflow-hidden shrink-0">
                    @if($service->display_image_url)
                        <img src="{{ $service->display_image_url }}" alt="{{ $service->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                    @else
                        <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                            <span class="material-symbols-outlined text-5xl text-slate-300">auto_awesome</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-slate-900/10 to-transparent"></div>
                    <div class="absolute bottom-5 left-5 right-5 z-10">
                        <h4 class="text-white text-xl font-bold font-heading drop-shadow-md leading-tight">{{ $service->title }}</h4>
                    </div>
                    <div class="absolute top-4 ltr:right-4 rtl:left-4">
                        <span class="px-3 py-1 bg-gold-gradient text-white text-[10px] font-bold rounded-lg shadow-sm">{{ __('Exclusive') }}</span>
                    </div>
                </div>

                <div class="p-6 flex flex-col grow">
                    @if($service->description)
                        <p class="text-slate-500 text-sm line-clamp-3 mb-5 font-text leading-relaxed">{{ $service->description }}</p>
                    @endif

                    @if(!empty($service->services) && is_array($service->services))
                        <ul class="space-y-2 mb-6">
                            @foreach(array_slice($service->services, 0, 3) as $item)
                            <li class="flex items-start gap-2 text-sm text-slate-600 font-text">
                                <span class="material-symbols-outlined text-primary text-base shrink-0">check_circle</span>
                                <span class="line-clamp-1">{{ $item['title'] ?? '' }}</span>
                            </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mt-auto pt-4 border-t border-slate-100 flex flex-col gap-2">
                        <a href="{{ route('exclusive_services.show', ['locale' => app()->getLocale(), 'slug' => $service->slug]) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 hover:border-primary hover:text-primary text-slate-700 text-sm font-bold rounded-xl transition-all duration-300">
                            {{ __('More Details') }}
                            <span class="material-symbols-outlined text-sm">info</span>
                        </a>
                        <a href="{{ route('whatsapp.redirect', ['locale' => app()->getLocale()]) }}?text={{ urlencode(__('Inquiry about ') . $service->title) }}" target="_blank" rel="noopener noreferrer" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-900 hover:bg-primary text-white text-sm font-bold rounded-xl transition-all duration-300">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.284l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.768-5.764-5.768zm3.393 8.125c-.15.424-.766.776-1.061.821-.285.043-.657.069-1.061-.06-.246-.079-.558-.189-.927-.352-1.571-.692-2.588-2.288-2.666-2.392-.078-.103-.639-.851-.639-1.624 0-.773.401-1.154.544-1.307.143-.153.312-.191.416-.191.104 0 .208.001.3.006.101.005.232-.039.363.273.134.319.458 1.116.498 1.197.04.081.066.176.013.282-.053.107-.078.176-.156.264-.078.088-.164.196-.234.264-.081.079-.165.166-.071.327.094.161.418.691.897 1.117.618.55 1.139.721 1.3.8.161.079.255.066.349-.043.094-.109.403-.468.511-.628.109-.16.216-.134.364-.079.148.055.939.442 1.1.523.161.081.268.121.307.189.039.068.039.394-.111.817zM12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2z"></path></svg>
                            {{ __('Direct WhatsApp Contact') }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-20">
            <span class="material-symbols-outlined text-6xl text-slate-300 mb-4">auto_awesome</span>
            <p class="text-slate-500 font-text text-lg">{{ __('No services available') }}</p>
        </div>
    @endif
</section>
@endsection
