@php
    $programs = $programs ?? \App\Models\Program::where('is_active', true)->orderBy('order')->get();
@endphp

@if($programs->count() > 0)
<section class="relative pt-32 pb-20 px-6 lg:px-20 overflow-hidden">
    <!-- Background decorative elements -->
    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
<!-- Pattern.png repeate -->
 <img src="{{ asset('image/pattern1.png') }}" alt="Pattern" class="absolute top-[10%] left-[-2%] w-[200px] h-[200px] repeat-y">
        <!-- <div class="absolute top-[-10%] left-[-5%] w-[500px] h-[500px] bg-primary rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[400px] h-[400px] bg-primary rounded-full blur-[100px]"></div> -->
        <img src="{{ asset('image/pattern1.png') }}" alt="Pattern" class="absolute bottom-[10%] right-[2%] w-[200px] h-[200px] repeat-y">
    </div>
    
    <div class="container mx-auto relative z-10">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div class="max-w-2xl">
                <div class="flex items-center gap-2 mb-4">
                    <div class="h-[1px] w-12 bg-primary"></div>
                    <span class="text-primary text-xs font-bold uppercase tracking-[0.2em]">{{ __('Discover Our Programs') }}</span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-black text-secondary mb-4 leading-tight">
                    @if(app()->getLocale() == 'tr')
                        Özel ve <span class="text-primary font-heading"> Premium </span> Programlar
                    @elseif(app()->getLocale() == 'en')
                        Exclusive & <span class="text-primary font-heading"> Premium </span> Programs
                    @else
                        برامجنا الحصرية <span class="text-primary font-heading"> والمميزة </span>
  
                    @endif
                </h2>
                <p class="text-secondary text-lg leading-relaxed">
                    {{ __('We offer you a carefully selected collection of the best investment and tourism opportunities.') }}
                </p>
            </div>
            <div class="flex items-center gap-4 self-start md:self-start">
                <a class="flex items-center gap-2 px-6 py-3 rounded-lg border border-primary/30 text-primary hover:bg-primary hover:text-white transition-all duration-300 font-bold group" href="{{ route('programs.index', ['locale' => app()->getLocale()]) }}">
                    <span>{{ __('View All Programs') }}</span>
                    @if(app()->getLocale() == 'ar')
                        <span class="material-symbols-outlined text-xl transition-transform group-hover:translate-x-[-4px]">arrow_left_alt</span>
                    @else
                        <span class="material-symbols-outlined text-xl transition-transform group-hover:translate-x-1">arrow_right_alt</span>
                    @endif
                </a>
            </div>
        </div>
        
        <!-- Programs Carousel -->
        <div class="relative group">
            <!-- Navigation Buttons -->
            <button class="programs-prev absolute right-[-20px] lg:right-[-40px] top-1/2 -translate-y-1/2 z-20 h-12 w-12 rounded-full border border-primary/30 bg-bg-main/80 backdrop-blur-md text-primary flex items-center justify-center hover:bg-primary hover:text-white transition-all hidden lg:flex shadow-xl" aria-label="السابق">
                <span class="material-symbols-outlined font-bold">chevron_right</span>
            </button>
            <button class="programs-next absolute left-[-20px] lg:left-[-40px] top-1/2 -translate-y-1/2 z-20 h-12 w-12 rounded-full border border-primary/30 bg-bg-main/80 backdrop-blur-md text-primary flex items-center justify-center hover:bg-primary hover:text-white transition-all hidden lg:flex shadow-xl" aria-label="التالي">
                <span class="material-symbols-outlined font-bold">chevron_left</span>
            </button>
            
            <!-- Programs Container -->
            <div class="programs-container flex gap-8 overflow-x-auto no-scrollbar snap-x snap-mandatory pb-8 scroll-smooth">
                @foreach($programs as $program)
                    <div class="min-w-[320px] md:min-w-[420px] h-[550px] relative rounded-2xl overflow-hidden snap-center group/card border border-white/10 hover:border-primary/50 transition-all duration-500 shadow-2xl">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover/card:scale-110" style="background-image: url('{{ $program->image_url ?? 'https://via.placeholder.com/800x600' }}');"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-8 glass-overlay mx-4 mb-4 rounded-xl translate-y-2 group-hover/card:translate-y-0 transition-transform duration-500">
                            <div class="flex items-center gap-2 text-primary text-[10px] font-bold uppercase mb-2 tracking-widest">
                                @if($program->category_icon)
                                    <span class="material-symbols-outlined text-sm">{{ $program->category_icon }}</span>
                                @endif
                                <span>{{ $program->category }}</span>
                            </div>
                            <h3 class="text-2xl font-bold text-secondary mb-2">{{ $program->title }}</h3>
                            @if($program->description)
                                <p class="text-secondary text-sm leading-relaxed mb-4 opacity-0 group-hover/card:opacity-100 transition-opacity duration-500 delay-100">
                                    {{ $program->description }}
                                </p>
                            @endif
                            <a href="{{ $program->url ?? '#' }}" class="flex justify-between items-center pt-3 border-t border-white/10 w-full">
                                <span class="text-primary font-bold">{{ __('Discover More') }}</span>
                                @if(app()->getLocale() == 'ar')
                                    <span class="material-symbols-outlined text-primary text-xl">arrow_back</span>
                                @else
                                    <span class="material-symbols-outlined text-primary text-xl">arrow_forward</span>
                                @endif
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination Dots -->
            @if($programs->count() > 1)
                <div class="justify-center gap-2 mt-8 hidden">
                    @foreach($programs as $index => $program)
                        <div class="programs-dot h-1.5 {{ $index === 0 ? 'w-8 bg-primary' : 'w-2 bg-white/20' }} rounded-full transition-all duration-300" data-index="{{ $index }}"></div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
@endif


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('.programs-container');
        const prevButton = document.querySelector('.programs-prev');
        const nextButton = document.querySelector('.programs-next');
        const dots = document.querySelectorAll('.programs-dot');
        
        if (!container) return;
        
        // Hide navigation buttons if only one program
        const programCards = container.querySelectorAll('.group\\/card');
        if (programCards.length <= 1) {
            if (prevButton) prevButton.style.display = 'none';
            if (nextButton) nextButton.style.display = 'none';
            return;
        }
        
        if (!prevButton || !nextButton) return;
        
        let currentIndex = 0;
        const gap = 32; // gap-8 = 2rem = 32px
        
        function getCardWidth() {
            // Get the actual width of the first card
            const firstCard = container.querySelector('.group\\/card');
            if (firstCard) {
                return firstCard.offsetWidth;
            }
            // Fallback: use responsive widths
            return window.innerWidth >= 768 ? 420 : 320;
        }
        
        function updateDots() {
            if (dots.length === 0) return;
            dots.forEach((dot, index) => {
                if (index === currentIndex) {
                    dot.classList.remove('bg-white/20', 'w-2');
                    dot.classList.add('bg-primary', 'w-8');
                } else {
                    dot.classList.remove('bg-primary', 'w-8');
                    dot.classList.add('bg-white/20', 'w-2');
                }
            });
        }
        
        function scrollToIndex(index) {
            const cardWidth = getCardWidth();
            const scrollAmount = index * (cardWidth + gap);
            container.scrollTo({
                left: scrollAmount,
                behavior: 'smooth'
            });
            currentIndex = index;
            updateDots();
        }
        
        function scrollByCards(direction) {
            const cardWidth = getCardWidth();
            const scrollAmount = cardWidth + gap;
            container.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }
        
        prevButton.addEventListener('click', () => {
            scrollByCards(1); // RTL: right is previous
        });
        
        nextButton.addEventListener('click', () => {
            scrollByCards(-1); // RTL: left is next
        });
        
        // Update dots on scroll
        let scrollTimeout;
        container.addEventListener('scroll', () => {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                const cardWidth = getCardWidth();
                const scrollLeft = container.scrollLeft;
                const newIndex = Math.round(scrollLeft / (cardWidth + gap));
                if (newIndex !== currentIndex && newIndex >= 0 && newIndex < dots.length) {
                    currentIndex = newIndex;
                    updateDots();
                }
            }, 100);
        });
        
        // Dot navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                scrollToIndex(index);
            });
        });
        
        // Update dots on window resize
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                const cardWidth = getCardWidth();
                const scrollLeft = container.scrollLeft;
                const newIndex = Math.round(scrollLeft / (cardWidth + gap));
                if (newIndex >= 0 && newIndex < dots.length) {
                    currentIndex = newIndex;
                    updateDots();
                }
            }, 250);
        });
    });
</script>
@endpush

