@extends('layouts.app')

@section('title', ($program->title ?? __('Program Details')) . ' - Balkis Premium Group')

@section('content')
@php
    $heroImage = $program->image_url ?? asset('image/default-program.jpg');
    $galleryImages = $program->gallery_images_urls ?? [];
    $features = $program->features ?? [];
    $tripStages = $program->trip_stages ?? [];
    $includes = $program->includes ?? [];
@endphp

<section class="relative h-[60vh] min-h-[400px] w-full overflow-hidden pt-15">
    <img alt="{{ $program->title }}" class="w-full h-full object-cover" src="{{ $heroImage }}"/>
    <div class="absolute inset-0 bg-linear-to-t from-background-dark via-background-dark/40 to-transparent"></div>
    <div class="absolute bottom-0 right-0 left-0 container mx-auto px-6 pb-12">
        <div class="flex flex-col gap-4">
            @if($program->location)
                <div class="inline-flex items-center gap-2 text-primary">
                    <span class="material-symbols-outlined">location_on</span>
                    <span class="text-sm font-medium font-text">{{ $program->location }}</span>
                </div>
            @endif
            <h1 class="text-4xl md:text-6xl font-black leading-tight font-heading text-white/90">{{ $program->title }}</h1>
        </div>
    </div>
</section>

<main class="container mx-auto px-6 py-12">
    <div class="flex flex-col lg:flex-row gap-12">
        <div class="grow lg:w-2/3 order-1 lg:order-1">
            @if($program->overview)
                <section class="mb-12">
                    <h3 class="text-2xl font-bold mb-6 text-primary border-r-4 border-primary pr-4 font-heading">{{ __('Program Overview') }}</h3>
                    <p class="text-lg leading-relaxed mb-8 font-text">
                        {{ $program->overview }}
                    </p>
                    @if($program->area || $program->rooms || $program->annual_return || $program->citizenship_eligible)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                            @if($program->area)
                                <div class="bg-white p-4 rounded-xl border border-primary/20 text-center">
                                    <span class="material-symbols-outlined text-primary mb-2">square_foot</span>
                                    <p class="text-xs text-gray-400 font-text">{{ __('Area') }}</p>
                                    <p class="font-bold font-text">{{ $program->area }}</p>
                                </div>
                            @endif
                            @if($program->rooms)
                                <div class="bg-white p-4 rounded-xl border border-primary/20 text-center">
                                    <span class="material-symbols-outlined text-primary mb-2">bed</span>
                                    <p class="text-xs text-gray-400 font-text">{{ __('Rooms') }}</p>
                                    <p class="font-bold font-text">{{ $program->rooms }}</p>
                                </div>
                            @endif
                            @if($program->annual_return)
                                <div class="bg-white p-4 rounded-xl border border-primary/20 text-center">
                                    <span class="material-symbols-outlined text-primary mb-2">payments</span>
                                    <p class="text-xs text-gray-400 font-text">{{ __('Annual Return') }}</p>
                                    <p class="font-bold font-text">{{ $program->annual_return }}</p>
                                </div>
                            @endif
                            @if($program->citizenship_eligible)
                                <div class="bg-white p-4 rounded-xl border border-primary/20 text-center">
                                    <span class="material-symbols-outlined text-primary mb-2">workspace_premium</span>
                                    <p class="text-xs text-gray-400 font-text">{{ __('Citizenship') }}</p>
                                    <p class="font-bold font-text">{{ __('Eligible') }}</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </section>
            @endif

            @if(count($galleryImages) > 0)
                <section class="mb-12">
                    <h3 class="text-2xl font-bold mb-6 text-primary border-r-4 border-primary pr-4 font-heading">{{ __('Photo Gallery') }}</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @if(count($galleryImages) > 0)
                            <div class="col-span-2 row-span-2 overflow-hidden rounded-2xl border border-primary/30 cursor-pointer gallery-image-wrapper">
                                <img alt="Gallery 1" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" src="{{ $galleryImages[0] }}" data-gallery-image="{{ $galleryImages[0] }}"/>
                            </div>
                        @endif
                        @if(count($galleryImages) > 1)
                            @foreach(array_slice($galleryImages, 1, 2) as $image)
                                <div class="overflow-hidden rounded-2xl border border-primary/30 aspect-square cursor-pointer gallery-image-wrapper">
                                    <img alt="Gallery" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" src="{{ $image }}" data-gallery-image="{{ $image }}"/>
                                </div>
                            @endforeach
                        @endif
                        @if(count($galleryImages) > 3)
                            @foreach(array_slice($galleryImages, 3) as $image)
                                <div class="overflow-hidden rounded-2xl border border-primary/30 aspect-square cursor-pointer gallery-image-wrapper">
                                    <img alt="Gallery" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" src="{{ $image }}" data-gallery-image="{{ $image }}"/>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </section>
            @endif

            @if(count($features) > 0)
                <section class="mb-12">
                    <h3 class="text-2xl font-bold mb-6 text-primary border-r-4 border-primary pr-4 font-heading">{{ __('Exclusive Features') }}</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach($features as $feature)
                            <div class="flex items-start gap-4 p-5 rounded-2xl bg-white/50 border border-primary/10">
                                <div class="bg-primary/10 p-2 rounded-lg">
                                    <span class="material-symbols-outlined text-primary">{{ $feature['icon'] ?? 'check_circle' }}</span>
                                </div>
                                <div>
                                    <h4 class="font-bold mb-1 font-heading">{{ $feature['title'] ?? '' }}</h4>
                                    <p class="text-sm text-gray-400 leading-relaxed font-text">{{ $feature['description'] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            @if($program->min_participants || $program->max_participants || $program->duration || $program->departure_location || $program->return_location || $program->accommodation_type || $program->meal_plan)
                <section class="mb-12">
                    <h3 class="text-2xl font-bold mb-6 text-primary border-r-4 border-primary pr-4 font-heading">{{ __('Tourism Program Details') }}</h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        @if($program->min_participants || $program->max_participants)
                            <div class="bg-white p-5 rounded-xl border border-primary/20">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="material-symbols-outlined text-primary">groups</span>
                                    <h4 class="font-bold font-heading">{{ __('Number of Participants') }}</h4>
                                </div>
                                <p class="text-sm text-gray-600 font-text">
                                    @if($program->min_participants && $program->max_participants)
                                        {{ __('From') }} {{ $program->min_participants }} {{ __('to') }} {{ $program->max_participants }} {{ __('people') }}
                                    @elseif($program->min_participants)
                                        {{ __('Minimum') }}: {{ $program->min_participants }} {{ __('people') }}
                                    @elseif($program->max_participants)
                                        {{ __('Maximum') }}: {{ $program->max_participants }} {{ __('people') }}
                                    @endif
                                </p>
                            </div>
                        @endif

                        @if($program->duration)
                            <div class="bg-white p-5 rounded-xl border border-primary/20">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="material-symbols-outlined text-primary">schedule</span>
                                    <h4 class="font-bold font-heading">{{ __('Duration') }}</h4>
                                </div>
                                <p class="text-sm text-gray-600 font-text">{{ $program->duration }}</p>
                            </div>
                        @endif

                        @if($program->departure_location)
                            <div class="bg-white p-5 rounded-xl border border-primary/20">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="material-symbols-outlined text-primary">flight_takeoff</span>
                                    <h4 class="font-bold font-heading">{{ __('Departure Location') }}</h4>
                                </div>
                                <p class="text-sm text-gray-600 font-text">{{ $program->departure_location }}</p>
                            </div>
                        @endif

                        @if($program->return_location)
                            <div class="bg-white p-5 rounded-xl border border-primary/20">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="material-symbols-outlined text-primary">flight_land</span>
                                    <h4 class="font-bold font-heading">{{ __('Return Location') }}</h4>
                                </div>
                                <p class="text-sm text-gray-600 font-text">{{ $program->return_location }}</p>
                            </div>
                        @endif

                        @if($program->accommodation_type)
                            <div class="bg-white p-5 rounded-xl border border-primary/20">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="material-symbols-outlined text-primary">hotel</span>
                                    <h4 class="font-bold font-heading">{{ __('Accommodation Type') }}</h4>
                                </div>
                                <p class="text-sm text-gray-600 font-text">{{ $program->accommodation_type }}</p>
                            </div>
                        @endif

                        @if($program->meal_plan)
                            <div class="bg-white p-5 rounded-xl border border-primary/20">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="material-symbols-outlined text-primary">restaurant</span>
                                    <h4 class="font-bold font-heading">{{ __('Meal Plan') }}</h4>
                                </div>
                                <p class="text-sm text-gray-600 font-text">{{ $program->meal_plan }}</p>
                            </div>
                        @endif
                    </div>
                </section>
            @endif

            @if(count($tripStages) > 0)
                <section class="mb-12">
                    <h3 class="text-2xl font-bold mb-6 text-primary border-r-4 border-primary pr-4 font-heading">{{ __('Trip Stages') }}</h3>
                    <div class="space-y-4">
                        @foreach($tripStages as $index => $stage)
                            <div class="bg-white p-6 rounded-xl border border-primary/20">
                                <div class="flex items-start gap-4">
                                    <div class="shrink-0 w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                                        <span class="text-primary font-bold font-heading">{{ $index + 1 }}</span>
                                    </div>
                                    <div class="grow">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="text-sm font-medium text-primary font-text">{{ $stage['day'] ?? '' }}</span>
                                            <h4 class="text-lg font-bold font-heading">{{ $stage['title'] ?? '' }}</h4>
                                        </div>
                                        <p class="text-sm text-gray-600 leading-relaxed font-text">{{ $stage['description'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            @if(count($includes) > 0)
                <section class="mb-12">
                    <h3 class="text-2xl font-bold mb-6 text-primary border-r-4 border-primary pr-4 font-heading">{{ __('What\'s Included') }}</h3>
                    <div class="bg-white p-6 rounded-xl border border-primary/20">
                        <ul class="grid md:grid-cols-2 gap-3">
                            @foreach($includes as $include)
                                <li class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-primary text-sm mt-0.5">check_circle</span>
                                    <span class="text-sm text-gray-600 font-text">{{ $include['item'] ?? '' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            @endif
        </div>

        <aside class="lg:w-1/3 order-2 lg:order-2">
            <div class="sticky top-28 space-y-6">
                <div class="rounded-2xl border border-primary/30 p-8 shadow-2xl relative overflow-hidden bg-white">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 blur-3xl"></div>
                    @if($program->price)
                        <div class="mb-8">
                            <span class="text-gray-400 text-sm block mb-1 font-text">{{ __('Starting from') }}</span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-4xl font-black text-primary font-heading">{{ $program->price }}</span>
                            </div>
                        </div>
                    @endif
                    <!-- <h4 class="text-xl font-bold mb-6 font-heading">{{ __('Request More Information') }}</h4>
                    <form id="program-inquiry-form" class="space-y-4" action="{{ route('inquiry.submit', ['locale' => app()->getLocale()]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="program_id" value="{{ $program->id }}">
                        <input type="hidden" name="program_title" value="{{ $program->title }}">
                        <div>
                            <label class="block text-xs text-gray-400 mb-1 mr-1 font-text">{{ __('Full Name') }}</label>
                            <input name="name" class="w-full bg-gray-50 border-gray-200 rounded-lg py-3 px-4 text-sm focus:ring-primary focus:border-primary font-text" placeholder="{{ __('Enter your name') }}" type="text" required/>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-400 mb-1 mr-1 font-text">{{ __('Phone Number') }}</label>
                            <input name="phone" class="w-full bg-gray-50 border-gray-200 rounded-lg py-3 px-4 text-sm focus:ring-primary focus:border-primary font-text" dir="ltr" placeholder="+966 50 000 0000" type="tel" required/>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-400 mb-1 mr-1 font-text">{{ __('Email') }}</label>
                            <input name="email" class="w-full bg-gray-50 border-gray-200 rounded-lg py-3 px-4 text-sm focus:ring-primary focus:border-primary font-text" placeholder="mail@example.com" type="email" required/>
                        </div>
                        <button type="submit" id="submit-program-inquiry-btn" class="w-full bg-gold-gradient text-white font-bold py-4 rounded-xl hover:brightness-110 transition-all shadow-lg shadow-primary/10 mt-4 font-heading">
                            <span id="submit-btn-text">{{ __('Send Request') }}</span>
                        </button>
                        <p id="form-message" class="mt-4 text-center text-sm font-text text-slate-400 hidden"></p>
                    </form> -->
                    <div class="mt-8 pt-8 border-t border-primary/20">
                        <p class="text-center text-xs text-gray-500 mb-4 font-text">{{ __('Contact us directly via') }}</p>
                        <a class="flex items-center justify-center gap-3 w-full py-3 rounded-xl border border-primary/40 text-primary hover:bg-primary/5 transition-all font-bold font-text" href="{{ route('whatsapp.redirect', ['locale' => app()->getLocale()]) }}" target="_blank">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.284l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.768-5.764-5.768zm3.393 8.125c-.15.424-.766.776-1.061.821-.285.043-.657.069-1.061-.06-.246-.079-.558-.189-.927-.352-1.571-.692-2.588-2.288-2.666-2.392-.078-.103-.639-.851-.639-1.624 0-.773.401-1.154.544-1.307.143-.153.312-.191.416-.191.104 0 .208.001.3.006.101.005.232-.039.363.273.134.319.458 1.116.498 1.197.04.081.066.176.013.282-.053.107-.078.176-.156.264-.078.088-.164.196-.234.264-.081.079-.165.166-.071.327.094.161.418.691.897 1.117.618.55 1.139.721 1.3.8.161.079.255.066.349-.043.094-.109.403-.468.511-.628.109-.16.216-.134.364-.079.148.055.939.442 1.1.523.161.081.268.121.307.189.039.068.039.394-.111.817zM12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2z"></path>
                            </svg>
                            {{ __('WhatsApp') }}
                        </a>
                    </div>
                </div>
                <!-- <div class="bg-primary/5 rounded-2xl p-6 border border-primary/10">
                    <div class="flex items-center gap-4 text-sm text-gray-400 font-text">
                        <span class="material-symbols-outlined text-primary">support_agent</span>
                        <span>{{ __('Free consultation with our real estate expert') }}</span>
                    </div>
                </div> -->
            </div>
        </aside>
    </div>
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
    #image-lightbox {
        display: flex;
        animation: fadeIn 0.3s ease-in-out;
    }
    
    #image-lightbox.hidden {
        display: none !important;
    }
    
    #lightbox-image {
        animation: zoomIn 0.3s ease-in-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    @keyframes zoomIn {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    .gallery-image-wrapper {
        position: relative;
    }
    
    .gallery-image-wrapper::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0);
        transition: background 0.3s ease;
        border-radius: 0.75rem;
        pointer-events: none;
    }
    
    .gallery-image-wrapper:hover::after {
        background: rgba(0, 0, 0, 0.2);
    }
    
    .gallery-image-wrapper img {
        pointer-events: none;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image Lightbox functionality
    const galleryWrappers = document.querySelectorAll('.gallery-image-wrapper');
    const lightbox = document.getElementById('image-lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const closeLightbox = document.getElementById('close-lightbox');
    const prevButton = document.getElementById('prev-image');
    const nextButton = document.getElementById('next-image');
    
    if (!lightbox || !lightboxImage || galleryWrappers.length === 0) {
        console.log('Lightbox elements not found or no gallery images');
        return;
    }
    
    let currentImageIndex = 0;
    const imageArray = [];
    
    // Collect all image URLs from gallery
    galleryWrappers.forEach((wrapper) => {
        const img = wrapper.querySelector('img[data-gallery-image]');
        if (img) {
            const imageUrl = img.getAttribute('data-gallery-image');
            if (imageUrl) {
                imageArray.push(imageUrl);
            }
        }
    });
    
    console.log('Found images:', imageArray.length);
    
    if (imageArray.length === 0) {
        return;
    }
    
    // Open lightbox
    function openLightbox(index) {
        if (index < 0 || index >= imageArray.length) {
            return;
        }
        currentImageIndex = index;
        lightboxImage.src = imageArray[index];
        lightbox.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Show/hide navigation buttons
        if (imageArray.length > 1) {
            if (prevButton) prevButton.classList.remove('hidden');
            if (nextButton) nextButton.classList.remove('hidden');
        } else {
            if (prevButton) prevButton.classList.add('hidden');
            if (nextButton) nextButton.classList.add('hidden');
        }
    }
    
    // Close lightbox
    function closeLightboxFunc() {
        lightbox.classList.add('hidden');
        document.body.style.overflow = '';
    }
    
    // Navigate to next image
    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % imageArray.length;
        lightboxImage.src = imageArray[currentImageIndex];
    }
    
    // Navigate to previous image
    function prevImage() {
        currentImageIndex = (currentImageIndex - 1 + imageArray.length) % imageArray.length;
        lightboxImage.src = imageArray[currentImageIndex];
    }
    
    // Add click event to all gallery wrappers
    galleryWrappers.forEach((wrapper, index) => {
        wrapper.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const img = wrapper.querySelector('img[data-gallery-image]');
            if (img) {
                const imageUrl = img.getAttribute('data-gallery-image');
                const foundIndex = imageArray.indexOf(imageUrl);
                if (foundIndex !== -1) {
                    openLightbox(foundIndex);
                } else {
                    openLightbox(index);
                }
            }
        });
    });
    
    // Close lightbox events
    if (closeLightbox) {
        closeLightbox.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeLightboxFunc();
        });
    }
    
    // Close on background click
    if (lightbox) {
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox || e.target.id === 'image-lightbox') {
                closeLightboxFunc();
            }
        });
    }
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (!lightbox.classList.contains('hidden')) {
            if (e.key === 'Escape') {
                closeLightboxFunc();
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                nextImage();
            } else if (e.key === 'ArrowLeft') {
                e.preventDefault();
                prevImage();
            }
        }
    });
    
    // Navigation buttons
    if (nextButton) {
        nextButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            nextImage();
        });
    }
    
    if (prevButton) {
        prevButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            prevImage();
        });
    }

    // Form submission
    const programInquiryForm = document.getElementById('program-inquiry-form');
    const submitBtn = document.getElementById('submit-program-inquiry-btn');
    const submitBtnText = document.getElementById('submit-btn-text');
    const formMessage = document.getElementById('form-message');

    if (programInquiryForm) {
        programInquiryForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Disable submit button
            submitBtn.disabled = true;
            submitBtnText.textContent = '{{ __("Sending...") }}';
            formMessage.classList.add('hidden');

            // Collect form data
            const formData = new FormData(programInquiryForm);

            try {
                const response = await fetch('{{ route("inquiry.submit", ["locale" => app()->getLocale()]) }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const data = await response.json();

                if (data.success) {
                    formMessage.className = 'mt-4 text-center text-sm font-text text-green-600';
                    formMessage.textContent = data.message || '{{ __("Inquiry submitted successfully!") }}';
                    formMessage.classList.remove('hidden');

                    // Redirect to WhatsApp after 1 second
                    setTimeout(() => {
                        window.open(data.whatsapp_url, '_blank');
                    }, 1000);
                } else {
                    formMessage.className = 'mt-4 text-center text-sm font-text text-red-600';
                    formMessage.textContent = data.message || '{{ __("An error occurred. Please try again.") }}';
                    formMessage.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Error submitting inquiry:', error);
                formMessage.className = 'mt-4 text-center text-sm font-text text-red-600';
                formMessage.textContent = '{{ __("An error occurred. Please try again.") }}';
                formMessage.classList.remove('hidden');
            } finally {
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtnText.textContent = '{{ __("Send Request") }}';
            }
        });
    }
});
</script>
@endpush
@endsection

