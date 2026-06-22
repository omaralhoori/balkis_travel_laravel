@extends('layouts.app')

@section('title', ($trip->title ?? __('Trip Details')) . ' - Balkis Premium Group')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($trip->description ?? __('Explore our carefully curated tourist trips')), 150))
@section('og_title', ($trip->title ?? __('Trip Details')) . ' - Balkis Premium Group')

@section('content')
@php
    $heroImage = $trip->image_url ?? asset('image/default-program.jpg');
    $galleryImages = $trip->gallery_images_urls ?? [];
    $highlights = $trip->highlights ?? [];
    $itinerary = $trip->itinerary ?? [];
    $whatsappLink = route('whatsapp.redirect', ['locale' => app()->getLocale()]) . '?text=' . urlencode(__('Inquiry about ') . $trip->title);
@endphp

<!-- Hero Section -->
<section class="relative h-[60vh] min-h-[400px] w-full overflow-hidden pt-15">
    @if($trip->image_url)
        <img alt="{{ $trip->title }}" class="w-full h-full object-cover" src="{{ $heroImage }}"/>
    @else
        <div class="w-full h-full bg-slate-800 flex items-center justify-center">
            <span class="material-symbols-outlined text-7xl text-slate-600">tour</span>
        </div>
    @endif
    <div class="absolute inset-0 bg-linear-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
    <div class="absolute bottom-0 right-0 left-0 max-w-7xl mx-auto px-6 pb-12">
        <div class="flex flex-col gap-4">
            <div class="flex flex-wrap items-center gap-4">
                <span class="px-3 py-1 bg-primary/90 text-white text-xs font-bold rounded-lg shadow-sm">{{ __('Trip') }}</span>
                @if($trip->location)
                    <div class="inline-flex items-center gap-2 text-primary">
                        <span class="material-symbols-outlined">location_on</span>
                        <span class="text-sm font-medium font-text">{{ $trip->location }}</span>
                    </div>
                @endif
                @if($trip->duration)
                    <div class="inline-flex items-center gap-2 text-primary">
                        <span class="material-symbols-outlined">schedule</span>
                        <span class="text-sm font-medium font-text">{{ $trip->duration }}</span>
                    </div>
                @endif
            </div>
            <h1 class="text-4xl md:text-6xl font-black leading-tight font-heading text-white/90">{{ $trip->title }}</h1>
        </div>
    </div>
</section>

<main class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex flex-col lg:flex-row gap-12 mb-12">
        <div class="grow lg:w-2/3 order-1 lg:order-1">
        @if(count($galleryImages) > 0)
                <section class="mb-12">
                    <h3 class="text-2xl font-bold mb-6 text-primary border-r-4 ltr:border-r-0 ltr:border-l-4 border-primary pr-4 ltr:pr-0 ltr:pl-4 font-heading">{{ __('Photo Gallery') }}</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($galleryImages as $image)
                            <div class="overflow-hidden rounded-2xl border border-primary/20 aspect-square cursor-pointer gallery-image-wrapper">
                                <img alt="{{ $trip->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" src="{{ $image }}" data-gallery-image="{{ $image }}"/>
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
                    @if($trip->price)
                        <div class="mb-8">
                            <span class="text-slate-400 text-sm block mb-1 font-text">{{ __('Starting from') }}</span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-black text-primary font-heading">{{ $trip->price }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="space-y-4 mb-8">
                        @if($trip->duration)
                            <div class="flex items-center gap-3 text-sm">
                                <span class="material-symbols-outlined text-primary">schedule</span>
                                <div>
                                    <p class="text-xs text-slate-400 font-text">{{ __('Duration') }}</p>
                                    <p class="font-bold text-slate-700 font-text">{{ $trip->duration }}</p>
                                </div>
                            </div>
                        @endif
                        @if($trip->location)
                            <div class="flex items-center gap-3 text-sm">
                                <span class="material-symbols-outlined text-primary">location_on</span>
                                <div>
                                    <p class="text-xs text-slate-400 font-text">{{ __('Destination') }}</p>
                                    <p class="font-bold text-slate-700 font-text">{{ $trip->location }}</p>
                                </div>
                            </div>
                        @endif
                        @if($trip->meeting_point)
                            <div class="flex items-center gap-3 text-sm">
                                <span class="material-symbols-outlined text-primary">pin_drop</span>
                                <div>
                                    <p class="text-xs text-slate-400 font-text">{{ __('Meeting Point') }}</p>
                                    <p class="font-bold text-slate-700 font-text">{{ $trip->meeting_point }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <a href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-3 w-full py-3.5 rounded-xl bg-slate-900 hover:bg-primary text-white transition-all font-bold font-heading">
                        {{ __('Book Now') }}
                        <span class="material-symbols-outlined rtl:rotate-180">arrow_forward</span>
                    </a>

                    <div class="mt-6 pt-6 border-t border-primary/20">
                        <p class="text-center text-xs text-slate-500 mb-4 font-text">{{ __('Contact us directly via') }}</p>
                        <a class="flex items-center justify-center gap-3 w-full py-3 rounded-xl border border-primary/40 text-primary hover:bg-primary/5 transition-all font-bold font-text" href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.284l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.768-5.764-5.768zm3.393 8.125c-.15.424-.766.776-1.061.821-.285.043-.657.069-1.061-.06-.246-.079-.558-.189-.927-.352-1.571-.692-2.588-2.288-2.666-2.392-.078-.103-.639-.851-.639-1.624 0-.773.401-1.154.544-1.307.143-.153.312-.191.416-.191.104 0 .208.001.3.006.101.005.232-.039.363.273.134.319.458 1.116.498 1.197.04.081.066.176.013.282-.053.107-.078.176-.156.264-.078.088-.164.196-.234.264-.081.079-.165.166-.071.327.094.161.418.691.897 1.117.618.55 1.139.721 1.3.8.161.079.255.066.349-.043.094-.109.403-.468.511-.628.109-.16.216-.134.364-.079.148.055.939.442 1.1.523.161.081.268.121.307.189.039.068.039.394-.111.817zM12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2z"></path>
                            </svg>
                            {{ __('WhatsApp') }}
                        </a>
                    </div>
                </div>
            </div>
        </aside>

        
    </div>
    @if($trip->description)
                <section class="mb-12">
                    <h3 class="text-2xl font-bold mb-6 text-primary border-r-4 ltr:border-r-0 ltr:border-l-4 border-primary pr-4 ltr:pr-0 ltr:pl-4 font-heading">{{ __('Trip Overview') }}</h3>
                    <p class="text-lg leading-relaxed text-slate-600 font-text whitespace-pre-line">{{ $trip->description }}</p>
                </section>
            @endif

            @if(count($highlights) > 0)
                <section class="mb-12">
                    <h3 class="text-2xl font-bold mb-6 text-primary border-r-4 ltr:border-r-0 ltr:border-l-4 border-primary pr-4 ltr:pr-0 ltr:pl-4 font-heading">{{ __('Trip Highlights') }}</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach($highlights as $highlight)
                            <div class="flex items-start gap-3 p-4 rounded-2xl bg-white border border-primary/10 shadow-sm">
                                <span class="material-symbols-outlined text-primary mt-0.5 shrink-0">star</span>
                                <span class="text-sm text-slate-600 font-text leading-relaxed">{{ $highlight['item'] ?? '' }}</span>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            @if($trip->includes)
                <section class="mb-12">
                    <h3 class="flex items-center gap-2 text-2xl font-bold mb-6 text-primary border-r-4 ltr:border-r-0 ltr:border-l-4 border-primary pr-4 ltr:pr-0 ltr:pl-4 font-heading">
                        <span class="material-symbols-outlined">check_circle</span>
                        {{ __('What is included') }}
                    </h3>
                    <div class="bg-white p-6 rounded-2xl border border-primary/10 shadow-sm prose prose-slate max-w-none text-slate-600 font-text">{!! $trip->includes !!}</div>
                </section>
            @endif

            @if(count($itinerary) > 0)
                <section class="mb-12">
                    <h3 class="text-2xl font-bold mb-6 text-primary border-r-4 ltr:border-r-0 ltr:border-l-4 border-primary pr-4 ltr:pr-0 ltr:pl-4 font-heading">{{ __('Trip Itinerary') }}</h3>
                    <div class="space-y-4">
                        @foreach($itinerary as $index => $stage)
                            <div class="bg-white p-6 rounded-2xl border border-primary/10 shadow-sm">
                                <div class="flex items-start gap-4">
                                    <div class="shrink-0 w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                                        <span class="text-primary font-bold font-heading">{{ $index + 1 }}</span>
                                    </div>
                                    <div class="grow">
                                        <div class="flex flex-wrap items-center gap-2 mb-2">
                                            @if(!empty($stage['time']))
                                                <span class="text-sm font-medium text-primary font-text">{{ $stage['time'] }}</span>
                                            @endif
                                            <h4 class="text-lg font-bold font-heading text-slate-800">{{ $stage['title'] ?? '' }}</h4>
                                        </div>
                                        @if(!empty($stage['description']))
                                            <p class="text-sm text-slate-600 leading-relaxed font-text">{{ $stage['description'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            @if($trip->what_to_bring)
                <section class="mb-12">
                    <h3 class="flex items-center gap-2 text-2xl font-bold mb-6 text-primary border-r-4 ltr:border-r-0 ltr:border-l-4 border-primary pr-4 ltr:pr-0 ltr:pl-4 font-heading">
                        <span class="material-symbols-outlined">backpack</span>
                        {{ __('What to bring / Remarks') }}
                    </h3>
                    <div class="bg-white p-6 rounded-2xl border border-primary/10 shadow-sm prose prose-slate max-w-none text-slate-600 font-text">{!! $trip->what_to_bring !!}</div>
                </section>
            @endif
    @if(isset($relatedTrips) && $relatedTrips->isNotEmpty())
        <section class="mt-16 pt-12 border-t border-slate-100">
            <h3 class="text-2xl font-bold mb-8 text-slate-800 font-heading">{{ __('Other Trips') }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedTrips as $related)
                    <a href="{{ route('tourist_trips.show', ['locale' => app()->getLocale(), 'slug' => $related->slug]) }}" class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col group hover:shadow-lg transition-all duration-300">
                        <div class="w-full h-44 relative overflow-hidden shrink-0">
                            @if($related->image_url)
                                <img src="{{ $related->image_url }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl text-slate-300">tour</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col grow">
                            <h4 class="text-base font-bold font-heading text-slate-800 mb-1 group-hover:text-primary transition-colors line-clamp-1">{{ $related->title }}</h4>
                            @if($related->location)
                                <p class="text-xs text-slate-400 font-text flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">location_on</span>
                                    {{ $related->location }}
                                </p>
                            @endif
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

<!-- Image Lightbox Modal -->
<div id="image-lightbox" class="fixed inset-0 z-9999 hidden items-center justify-center bg-black/90 backdrop-blur-sm">
    <button id="close-lightbox" class="absolute top-4 right-4 z-10000 text-white hover:text-primary transition-colors p-2">
        <span class="material-symbols-outlined text-3xl">close</span>
    </button>
    <button id="prev-image" class="absolute right-4 top-1/2 -translate-y-1/2 z-10000 text-white hover:text-primary transition-colors p-2 hidden">
        <span class="material-symbols-outlined text-4xl">chevron_right</span>
    </button>
    <button id="next-image" class="absolute left-4 top-1/2 -translate-y-1/2 z-10000 text-white hover:text-primary transition-colors p-2 hidden">
        <span class="material-symbols-outlined text-4xl">chevron_left</span>
    </button>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <img id="lightbox-image" class="max-h-[90vh] w-auto mx-auto rounded-lg" src="" alt="Gallery Image"/>
    </div>
</div>

@push('styles')
<style>
    #image-lightbox { display: none; }
    #image-lightbox.show { display: flex; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const galleryWrappers = document.querySelectorAll('.gallery-image-wrapper');
    const lightbox = document.getElementById('image-lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const closeLightbox = document.getElementById('close-lightbox');
    const prevButton = document.getElementById('prev-image');
    const nextButton = document.getElementById('next-image');

    if (!lightbox || !lightboxImage || galleryWrappers.length === 0) {
        return;
    }

    let currentImageIndex = 0;
    const imageArray = [];

    galleryWrappers.forEach((wrapper) => {
        const img = wrapper.querySelector('img[data-gallery-image]');
        if (img) {
            const imageUrl = img.getAttribute('data-gallery-image');
            if (imageUrl) {
                imageArray.push(imageUrl);
            }
        }
    });

    function openLightbox(index) {
        currentImageIndex = index;
        lightboxImage.src = imageArray[index];
        lightbox.classList.add('show');
        document.body.style.overflow = 'hidden';
        const showNav = imageArray.length > 1;
        prevButton.classList.toggle('hidden', !showNav);
        nextButton.classList.toggle('hidden', !showNav);
    }

    function closeLightboxFunc() {
        lightbox.classList.remove('show');
        document.body.style.overflow = '';
    }

    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % imageArray.length;
        lightboxImage.src = imageArray[currentImageIndex];
    }

    function prevImage() {
        currentImageIndex = (currentImageIndex - 1 + imageArray.length) % imageArray.length;
        lightboxImage.src = imageArray[currentImageIndex];
    }

    galleryWrappers.forEach((wrapper, index) => {
        wrapper.addEventListener('click', () => openLightbox(index));
    });

    closeLightbox.addEventListener('click', closeLightboxFunc);
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) {
            closeLightboxFunc();
        }
    });
    nextButton.addEventListener('click', nextImage);
    prevButton.addEventListener('click', prevImage);
    document.addEventListener('keydown', (e) => {
        if (lightbox.classList.contains('show')) {
            if (e.key === 'Escape') closeLightboxFunc();
            else if (e.key === 'ArrowRight') nextImage();
            else if (e.key === 'ArrowLeft') prevImage();
        }
    });
});
</script>
@endpush
@endsection
