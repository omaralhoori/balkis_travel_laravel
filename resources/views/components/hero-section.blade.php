@php
    $homePage = $homePage ?? \App\Models\HomePage::getCurrent();
    $services = $services ?? $homePage->activeServices;
    $firstService = $services->first();
    $mainBgImage = $homePage->main_background_image_url 
        ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuDgY6giqkj21tUvclk3yFwACm-TA3MpuiAmhESMAAJH30FG5E4lt2_XTywcqzvo_tHIfTmiA9hjqoMbJe96DTcRbx07K9FiJVUTN6gWYKdvrICMQGbdOZRqq6JE4lG8olMYHgocw45mNjTi4geQCEsHg1YKHdiaEdWZDKs9I_MkCqBnAMRFfDK013HRnHSCcnlUknLqOP0_mkrOjfvmq6hKdsaJtL205T0fFp44s8SqQPysOWE2-gtWdJ5s0_C7mMn83RH_WPbkPkj7';
@endphp

<section class="hero-section flex-grow flex items-center relative min-h-screen pt-20">
    <!-- Background Image -->
    <div class="hero-background absolute inset-0 z-0 bg-cover bg-center transition-all duration-700 ease-in-out" 
         data-alt="Panaromic view of Istanbul skyline at sunset" 
         style="background-image: linear-gradient(rgba(24, 24, 27, 0.7), rgba(24, 24, 27, 0.8)), url('{{ $mainBgImage }}');">
    </div>
    
    <div class="relative z-10 container mx-auto px-6 lg:px-20 py-12 flex flex-col lg:flex-row items-center gap-12 h-full">
        <!-- Content Side -->
        <div class="hero-content-wrapper flex-1 flex flex-col gap-8 items-start transition-all duration-500 ease-in-out">
            @if($homePage->main_badge_text && $homePage->main_badge_icon)
                <div class="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-2 border border-primary/20 backdrop-blur-md">
                    <span class="hero-badge-icon material-symbols-outlined text-primary text-sm">{{ $homePage->main_badge_icon }}</span>
                    <span class="hero-badge-text text-primary text-xs font-bold uppercase tracking-wide">{{ $homePage->main_badge_text }}</span>
                </div>
            @endif
            <h1 class="text-4xl lg:text-6xl  text-white leading-[1.2]">
                <span class="hero-title-main text-primary font-black block font-heading mb-2">{{ $homePage->main_title }}</span>
                <span class="hero-subtitle font-heading">{{ $homePage->main_subtitle }}</span>
            </h1>
            <p class="hero-description text-gray-300 text-lg leading-relaxed max-w-xl">
                {{ $homePage->main_description ?? 'اكتشف قمة السياحة الفاخرة في تركيا، والعقارات المتميزة، والاستثمارات الاستراتيجية. نحن نصنع تجارب لا تُنسى ومستقبلاً واعداً.' }}
            </p>
            <div class="flex gap-4 mt-4">
                @if($firstService && $firstService->cta_button_text)
                    <a href="{{ $firstService->cta_button_url ?? '#' }}" class="service-cta-button flex items-center justify-center gap-2 h-12 px-8 rounded-lg bg-gold-gradient text-white font-bold hover:brightness-110  transition-all duration-300 shadow-[0_0_20px_rgba(212,175,53,0.3)]">
                        <span class="service-cta-text">{{ $firstService->cta_button_text }}</span>
                        @if(app()->getLocale() == 'ar')
                            <span class="material-symbols-outlined text-xl flip-rtl">arrow_right_alt</span>
                        @else
                            <span class="material-symbols-outlined text-xl">arrow_right_alt</span>
                        @endif
                    </a>
                @elseif($homePage->cta_button_text)
                    <a href="{{ $homePage->cta_button_url ?? '#' }}" class="flex items-center justify-center gap-2 h-12 px-8 rounded-lg bg-gold-gradient text-[#201d13] font-bold hover:bg-white hover:text-[#201d13] transition-all duration-300 shadow-[0_0_20px_rgba(212,175,53,0.3)]">
                        <span>{{ $homePage->cta_button_text }}</span>
                        @if(app()->getLocale() == 'ar')
                            <span class="material-symbols-outlined text-xl flip-rtl">arrow_right_alt</span>
                        @else
                            <span class="material-symbols-outlined text-xl">arrow_right_alt</span>
                        @endif
                    </a>
                @endif
                @if($homePage->video_button_text)
                    <button class="flex items-center justify-center gap-2 h-12 px-8 rounded-lg border border-white/20 bg-white/5 text-white font-medium hover:bg-white/10 transition-all backdrop-blur-sm">
                        <span class="material-symbols-outlined text-xl">play_circle</span>
                        <span>{{ $homePage->video_button_text }}</span>
                    </button>
                @endif
            </div>
            <div class="hero-stats mt-8 flex items-center gap-8 border-t border-white/10 pt-6 w-full max-w-md">
                @if($firstService && $firstService->stats)
                    @foreach($firstService->stats as $stat)
                        <div class="stat-item">
                            <p class="stat-value text-2xl font-bold text-white">{{ $stat['value'] ?? '' }}</p>
                            <p class="stat-label text-xs text-gray-400">{{ $stat['label'] ?? '' }}</p>
                        </div>
                    @endforeach
                @else
                    <div class="stat-item">
                        <p class="stat-value text-2xl font-bold text-white">١٥+</p>
                        <p class="stat-label text-xs text-gray-400">سنة خبرة</p>
                    </div>
                    <div class="stat-item">
                        <p class="stat-value text-2xl font-bold text-white">٥٠٠+</p>
                        <p class="stat-label text-xs text-gray-400">مشروع ناجح</p>
                    </div>
                    <div class="stat-item">
                        <p class="stat-value text-2xl font-bold text-white">٢٤/٧</p>
                        <p class="stat-label text-xs text-gray-400">دعم كبار الشخصيات</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Cards Side -->
        <div class="w-full lg:w-1/3 flex flex-row lg:flex-col gap-4 overflow-x-auto lg:overflow-visible pb-4 lg:pb-0 snap-x">
            @foreach($services as $index => $service)
                @php
                    $isActive = false;//$index === 0;
                    $cardImage = $service->card_image_url ?? 'https://via.placeholder.com/400x300';
                    $cardClass = $isActive 
                        ? 'service-card active group relative shrink-0 w-[280px] lg:w-full h-[180px] rounded-xl overflow-hidden cursor-pointer border-2 border-primary shadow-2xl transition-all duration-500 hover:-translate-y-1 snap-center' 
                        : 'service-card inactive group relative shrink-0 w-[280px] lg:w-full h-[160px] rounded-xl overflow-hidden cursor-pointer border border-white/10 opacity-70 hover:opacity-100 hover:border-primary/50 transition-all duration-500 snap-center';
                @endphp
                
                <a href="{{ $service->card_url ?? '#' }}" class="{{ $cardClass }}" data-service-id="{{ $service->service_key }}">
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110" 
                         style="background-image: url('{{ $cardImage }}');">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 {{ $isActive ? 'p-6' : 'p-5' }} flex items-end justify-between">
                        <div>
                            <h3 class="{{ $isActive ? 'text-xl' : 'text-lg' }} font-bold text-white mb-1">{{ $service->card_title }}</h3>
                            <p class="text-gray-300 {{ $isActive ? 'text-sm' : 'text-xs' }} line-clamp-1">{{ $service->card_description }}</p>
                        </div>
                        <div class="{{ $isActive ? 'h-10 w-10 rounded-full bg-gold-gradient flex items-center justify-center text-[#201d13]' : 'h-8 w-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white group-hover:bg-primary group-hover:text-[#201d13] transition-colors' }}">
                            <span class="material-symbols-outlined {{ !$isActive ? 'text-sm' : '' }}">{{ $service->card_icon }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    
    <!-- Bottom decorative element -->
    <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-bg-main to-transparent pointer-events-none"></div>
</section>

@push('scripts')
@php
    $servicesData = $services->mapWithKeys(function($service) {
        return [$service->service_key => [
            'id' => $service->service_key,
            'title' => $service->title,
            'subtitle' => $service->subtitle,
            'description' => $service->description,
            'badge' => $service->badge_text,
            'badgeIcon' => $service->badge_icon,
            'backgroundImage' => $service->background_image_url,
            'ctaButtonText' => $service->cta_button_text,
            'ctaButtonUrl' => $service->cta_button_url ?? '#',
            'stats' => $service->stats ?? [],
        ]];
    })->toArray();
@endphp
<script>
    // Pass services data to JavaScript
    window.homePageServices = @json($servicesData);
</script>
@endpush