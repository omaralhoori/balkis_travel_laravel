@extends('layouts.app')

@section('title', 'المدونة والتقارير - Balkis Premium Group')

@php
    $homePage = \App\Models\HomePage::getCurrent();
    
    // SEO Meta Tags
    $metaDescription = 'اكتشف أحدث المقالات والتقارير حول الاستثمار العقاري في تركيا، الجنسية التركية، والسياحة الفاخرة من خبراء بلقيس بريميوم جروب.';
    $metaKeywords = 'استثمار عقاري، تركيا، الجنسية التركية، عقارات، استثمار، بلقيس، مقالات، تقارير';
    $currentUrl = url()->current();
@endphp

@section('meta_description', $metaDescription)
@section('meta_keywords', $metaKeywords)

@section('og_type', 'website')
@section('og_url', $currentUrl)
@section('og_title', 'المدونة والتقارير - Balkis Premium Group')
@section('og_description', $metaDescription)
@section('og_image', asset('images/og-blog.jpg'))

@section('canonical_url', $currentUrl)

@section('content')
<section class="relative pt-24 px-6">
    <div class="max-w-7xl mx-auto mt-12">
        @if($featuredPost)
            <div class="relative h-[500px] md:h-[600px] rounded-3xl overflow-hidden group">
                @if($featuredPost->featured_image_url)
                    <img alt="{{ $featuredPost->title }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src="{{ $featuredPost->featured_image_url }}"/>
                @else
                    <div class="w-full h-full bg-zinc-dark flex items-center justify-center">
                        <span class="material-symbols-outlined text-6xl text-gray-600">image</span>
                    </div>
                @endif
                <div class="absolute inset-0 featured-overlay"></div>
                <div class="absolute bottom-0 @if(app()->getLocale() == 'ar') right-0 @else left-0 @endif p-8 md:p-16 max-w-3xl">
                    <span class="inline-block bg-gold-gradient text-zinc-dark px-4 py-1.5 text-xs font-bold mb-6 rounded-sm uppercase tracking-widest">{{ __('Featured Article') }}</span>
                    <h1 class="text-3xl md:text-5xl font-black text-white mb-6 font-display leading-tight">{{ $featuredPost->title }}</h1>
                    @if($featuredPost->excerpt)
                        <p class="text-gray-300 text-lg mb-8 line-clamp-2 md:line-clamp-none">{{ $featuredPost->excerpt }}</p>
                    @endif
                    <a class="backdrop-blur-sm bg-white/10 font-bold gap-3 group/link hover:bg-white  inline-flex items-center px-6 py-3 rounded-full text-primary transition-all" href="{{ route('blog.show', ['locale' => app()->getLocale(), 'slug' => $featuredPost->slug]) }}">
                        <span>{{ __('Read Full Article') }}</span>
                       
                            @if(app()->getLocale() == 'ar')
                            <span class="material-symbols-outlined transition-transform group-hover/link:-translate-x-2">
                                arrow_left_alt
                                </span>
                            @else
                                <span class="material-symbols-outlined transition-transform group-hover/link:translate-x-2">
                                    arrow_right_alt
                                </span>
                        
                                @endif
                        
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<main class="max-w-7xl mx-auto px-6 py-20">
    <div class="flex flex-col lg:flex-row gap-12">
        <aside class="w-full lg:w-1/3 order-1 lg:order-2 space-y-12">
            <div class="bg-white p-8 border border-gray-100 rounded-2xl shadow-sm">
                
                <h3 class="text-gray-600 text-lg  mb-6 font-display border-s-4 border-primary ps-4">{{ __('Search for a topic...') }}</h3>
                <div class="relative">
                    <input id="blog-search" class="w-full bg-white border border-secondary/20 text-secondary px-12 py-3 pe-12 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none text-sm transition-all" placeholder="{{ __('Search for a topic...') }}" type="text"/>
                    <span class="material-symbols-outlined absolute end-4 top-1/2 -translate-y-1/2 text-primary text-xl">search</span>
                </div>
            </div>
            
            <div class="bg-white p-8 border border-gray-100 rounded-2xl shadow-sm">
                <h3 class="text-secondary text-lg font-bold mb-6 font-display border-s-4 border-primary ps-4">{{ __('Top Categories') }}</h3>
                <div class="space-y-4">
                    @foreach($categories as $category)
                        <a class="flex items-center justify-between text-gray-400 hover:text-primary transition-colors py-2 border-b border-white/5 group" href="#">
                            <span class="text-sm font-medium">{{ $category->category }}</span>
                            <span class="text-xs bg-white/5 px-2 py-1 rounded group-hover:bg-primary group-hover:text-zinc-dark transition-all">{{ $category->count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            
            <div class="relative bg-gold-gradient p-8 rounded-2xl overflow-hidden group">
                <div class="absolute -top-12 -right-12 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                <h3 class="text-white/90 text-xl font-bold mb-3 font-display relative z-10">{{ __('Balkis Newsletter') }}</h3>
                <p class="text-white/70 text-sm mb-6 relative z-10">{{ __('Subscribe to get the latest exclusive reports and investment opportunities.') }}</p>
                <div class="space-y-3 relative z-10">
                    @if(session('newsletter_success'))
                        <div class="bg-white/20 text-zinc-dark px-4 py-3 rounded text-sm font-medium mb-3">
                            {{ session('newsletter_success') }}
                        </div>
                    @endif
                    @if($errors->has('email') || $errors->has('newsletter'))
                        <div class="bg-red-500/20 text-red-900 px-4 py-3 rounded text-sm font-medium mb-3">
                            {{ $errors->first('email') ?: $errors->first('newsletter') }}
                        </div>
                    @endif
                    <form action="{{ route('newsletter.subscribe', ['locale' => app()->getLocale()]) }}" method="POST" class="space-y-3">
                        @csrf
                        <input name="email" value="{{ old('email') }}" class="w-full bg-white/20 border-transparent placeholder-zinc-dark/60 text-zinc-dark text-sm px-4 py-3 rounded focus:ring-zinc-dark/40 focus:border-transparent @error('email') border-red-500 @enderror" placeholder="{{ __('Your Email') }}" type="email" required/>
                        <button type="submit" class="w-full bg-zinc-dark text-primary py-3 font-bold text-sm transition-colors">{{ __('Subscribe Now') }}</button>
                    </form>
                </div>
            </div>
        </aside>
        
        <div class="w-full lg:w-2/3 order-2 lg:order-1">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($posts as $post)
                    <div class="group bg-white border border-white/5 rounded-2xl overflow-hidden card-shadow transition-all duration-500 hover:-translate-y-2">
                        <div class="relative h-56 overflow-hidden">
                            @if($post->featured_image_url)
                                <img alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ $post->featured_image_url }}"/>
                            @else
                                <div class="w-full h-full bg-zinc-800 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-6xl text-gray-600">image</span>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4 bg-primary text-zinc-dark px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-sm">{{ $post->category }}</div>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-3 mb-4 text-gray-500 text-xs">
                                <span class="material-symbols-outlined text-sm">calendar_today</span>
                                <span>{{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-secondary mb-4 group-hover:text-primary transition-colors font-display leading-tight">{{ $post->title }}</h3>
                            @if($post->excerpt)
                                <p class="text-gray-400 text-sm leading-relaxed mb-6 line-clamp-3">{{ $post->excerpt }}</p>
                            @endif
                            <a class="inline-flex items-center gap-2 text-primary text-sm font-bold border-b border-primary/30 pb-1 group/btn hover:border-primary transition-all" href="{{ route('blog.show', ['locale' => app()->getLocale(), 'slug' => $post->slug]) }}">
                                <span>{{ __('Read More') }}</span>
                                @if(app()->getLocale() == 'ar')
                                <span class="material-symbols-outlined text-lg transition-transform group-hover/btn:-translate-x-1">arrow_left_alt</span>
                                @else
                                    <span class="material-symbols-outlined text-lg transition-transform group-hover/btn:translate-x-1">arrow_right_alt</span>
                                @endif
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-20">
                        <span class="material-symbols-outlined text-6xl text-gray-600 mb-4">article</span>
                        <p class="text-gray-400 text-lg">لا توجد مقالات متاحة حالياً</p>
                    </div>
                @endforelse
            </div>
            
            @if($posts->hasPages())
                <div class="mt-20 flex justify-center items-center gap-3">
                    @if($posts->onFirstPage())
                        <button class="w-11 h-11 flex items-center justify-center rounded border border-white/10 text-gray-400 cursor-not-allowed" disabled>
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                    @else
                        <a href="{{ $posts->previousPageUrl() }}" class="w-11 h-11 flex items-center justify-center rounded border border-white/10 text-gray-400 hover:border-primary hover:text-primary transition-all">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </a>
                    @endif
                    
                    @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                        @if($page == $posts->currentPage())
                            <button class="w-11 h-11 flex items-center justify-center rounded bg-primary text-zinc-dark font-bold shadow-lg shadow-primary/20">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="w-11 h-11 flex items-center justify-center rounded border border-white/10 text-gray-400 hover:border-primary hover:text-primary transition-all">{{ $page }}</a>
                        @endif
                    @endforeach
                    
                    @if($posts->hasMorePages())
                        <a href="{{ $posts->nextPageUrl() }}" class="w-11 h-11 flex items-center justify-center rounded border border-white/10 text-gray-400 hover:border-primary hover:text-primary transition-all">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </a>
                    @else
                        <button class="w-11 h-11 flex items-center justify-center rounded border border-white/10 text-gray-400 cursor-not-allowed" disabled>
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('blog-search');
        const postCards = document.querySelectorAll('.group.bg-zinc-dark');
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                postCards.forEach(card => {
                    const title = card.querySelector('h3')?.textContent.toLowerCase() || '';
                    const excerpt = card.querySelector('p')?.textContent.toLowerCase() || '';
                    const category = card.querySelector('.bg-primary')?.textContent.toLowerCase() || '';
                    
                    const matches = title.includes(searchTerm) || 
                                  excerpt.includes(searchTerm) || 
                                  category.includes(searchTerm);
                    
                    if (matches || searchTerm === '') {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endpush

