@php
    $testimonials = \App\Models\Testimonial::where('is_active', true)->orderBy('order')->get();
@endphp

@if($testimonials->count() > 0)
<!-- Testimonials Section -->
<section class="relative py-20 px-4 md:px-10 lg:px-20 overflow-hidden">
    <!-- Background Decorative Element -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px] -z-10 translate-x-1/2 -translate-y-1/2"></div>
    <div class="max-w-7xl mx-auto flex flex-col gap-10">
        <!-- Header -->
        <div class="flex flex-col items-center text-center gap-3">
        <div class="flex items-center gap-2">  
        <span class="h-[1px] w-12 bg-primary"></span> <span class="text-primary text-sm font-bold tracking-widest uppercase">{{ __('Success Stories') }}</span> <span class="h-[1px] w-12 bg-primary"></span>
        </div>  
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-secondary  leading-tight">
                @if(app()->getLocale() == 'tr')
                    <span class="text-primary font-heading"> En İyi Müşterilerimizin </span>   Yorumları 
                @elseif(app()->getLocale() == 'en')
                    Opinions of <span class="text-primary font-heading"> Our Best Clients </span>
                @else
                    آراء <span class="text-primary font-heading"> عملائنا المميزين </span>
                @endif
            </h2>
            <p class="text-secondary max-w-2xl text-lg">
                {{ __('We are proud of our strategic partnerships with the elite investors and businessmen in the region') }}
            </p>
        </div>
        <!-- Carousel -->
        <div class="w-full relative mt-8">
            <!-- Navigation Buttons -->
<!-- Fix for ltr languages  -->
            @if(app()->getLocale() === 'ar')
            <button class="testimonials-prev absolute right-4 top-1/2 -translate-y-1/2 z-10 w-12 h-12 rounded-full bg-bg-main/80 backdrop-blur-md border border-primary/20 hover:bg-primary hover:text-zinc-dark text-primary transition-all duration-300 flex items-center justify-center shadow-lg disabled:opacity-50 disabled:cursor-not-allowed" aria-label="Previous testimonial">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
            <button class="testimonials-next absolute left-4 top-1/2 -translate-y-1/2 z-10 w-12 h-12 rounded-full bg-bg-main/80 backdrop-blur-md border border-primary/20 hover:bg-primary hover:text-zinc-dark text-primary transition-all duration-300 flex items-center justify-center shadow-lg disabled:opacity-50 disabled:cursor-not-allowed" aria-label="Next testimonial">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            @else
            <button class="testimonials-prev absolute left-4 top-1/2 -translate-y-1/2 z-10 w-12 h-12 rounded-full bg-bg-main/80 backdrop-blur-md border border-primary/20 hover:bg-primary hover:text-zinc-dark text-primary transition-all duration-300 flex items-center justify-center shadow-lg disabled:opacity-50 disabled:cursor-not-allowed" aria-label="Previous testimonial">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button class="testimonials-next absolute right-4 top-1/2 -translate-y-1/2 z-10 w-12 h-12 rounded-full bg-bg-main/80 backdrop-blur-md border border-primary/20 hover:bg-primary hover:text-zinc-dark text-primary transition-all duration-300 flex items-center justify-center shadow-lg disabled:opacity-50 disabled:cursor-not-allowed" aria-label="Next testimonial">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
            @endif
            <div class="testimonials-carousel flex overflow-x-auto pb-8 gap-6 snap-x snap-mandatory [-ms-scrollbar-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden scroll-smooth">
                @foreach($testimonials as $testimonial)
                    @php
                        $positionText = $testimonial->position;
                        if ($testimonial->company) {
                            $positionText .= ($positionText ? '، ' : '') . $testimonial->company;
                        }
                    @endphp
                    <div class="testimonial-card snap-center shrink-0 w-[350px] md:w-[400px] border border-primary p-8 rounded-xl flex flex-col gap-6 transition-all duration-300  bg-white hover:shadow-md">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-full bg-cover  bg-center border-2 border-primary/20 shadow-lg" style="background-image: url('{{ $testimonial->avatar_url }}');"></div>
                            <div>
                                <h4 class="text-secondary font-bold text-lg">{{ $testimonial->name }}</h4>
                                @if($positionText)
                                    <p class="text-primary text-sm">{{ $positionText }}</p>
                                @endif
                            </div>
                            <span class="material-symbols-outlined text-primary/20 !text-5xl mr-auto">format_quote</span>
                        </div>
                        <p class="text-secondary leading-relaxed flex-grow">
                            "{{ $testimonial->testimonial }}"
                        </p>
                        <div class="flex gap-1 mt-auto">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $testimonial->rating)
                                    <span class="material-symbols-outlined text-sm text-primary fill-current">star</span>
                                @else
                                    <span class="material-symbols-outlined text-sm text-primary/30">star</span>
                                @endif
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Dots Indicator -->
            <div class="testimonials-dots flex justify-center gap-2 mt-8"></div>
        </div>
    </div>
</section>
@endif

