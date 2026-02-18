@extends('layouts.app')

@php
    $currentLocale = app()->getLocale();
    $homePage = \App\Models\HomePage::getCurrent();
    
    // Set locale on model to ensure translations work correctly
    $post->setLocale($currentLocale);
    
    // Use accessor directly - HasTranslations trait automatically returns translation for current locale
    // The model's locale is set above, so $post->title, $post->content etc. will return the correct translation
    $postTitle = $post->title;
    $postMetaTitle = $post->meta_title;
    
    // Ensure they are strings
    $postTitle = is_string($postTitle) ? $postTitle : (is_array($postTitle) ? '' : (string) $postTitle);
    $postMetaTitle = is_string($postMetaTitle) ? $postMetaTitle : (is_array($postMetaTitle) ? '' : (string) $postMetaTitle);
    
    // Get translated content for reading time calculation
    // Use content_html accessor to convert ProseMirror JSON to HTML if needed
    $content = $post->content_html;
    $wordCount = str_word_count(strip_tags($content));
    $readingTime = max(1, ceil($wordCount / 200));
    
    // SEO Meta Tags - use accessors directly
    $metaTitle = $post->meta_title ?: $post->title;
    $metaDescription = $post->meta_description ?: $post->excerpt;
    $metaKeywords = $post->meta_keywords;
    
    // Ensure all meta tags are strings, not arrays
    $metaTitle = is_string($metaTitle) ? $metaTitle : (is_array($metaTitle) ? '' : (string) $metaTitle);
    $metaDescription = is_string($metaDescription) ? $metaDescription : (is_array($metaDescription) ? '' : (string) $metaDescription);
    $metaKeywords = is_string($metaKeywords) ? $metaKeywords : (is_array($metaKeywords) ? '' : (string) $metaKeywords);
    $ogImage = $post->og_image_url;
    $canonicalUrl = $post->canonical_url ?: route('blog.show', ['locale' => $currentLocale, 'slug' => $post->slug]);
    $currentUrl = url()->current();
@endphp

@section('title', ($postMetaTitle ?: $postTitle) . ' - Balkis Premium Group')

@section('meta_description', $metaDescription)
@if($metaKeywords)
    @section('meta_keywords', $metaKeywords)
@endif

@section('og_type', 'article')
@section('og_url', $currentUrl)
@section('og_title', $metaTitle)
@section('og_description', $metaDescription)
@if($ogImage)
    @section('og_image', $ogImage)
@endif

@section('canonical_url', $canonicalUrl)

@section('content')
<section class="relative pt-20">
    <div class="h-[60vh] md:h-[75vh] relative overflow-hidden">
        @if($post->featured_image_url)
            <img alt="{{ $postTitle }}" class="w-full h-full object-cover" src="{{ $post->featured_image_url }}"/>
        @else
            <div class="w-full h-full bg-zinc-dark flex items-center justify-center">
                <span class="material-symbols-outlined text-6xl text-gray-600">image</span>
            </div>
        @endif
        <div class="absolute inset-0 featured-overlay"></div>
        <div class="absolute bottom-0 w-full">
            <div class="max-w-5xl mx-auto px-6 pb-16">
                <div class="flex flex-wrap items-center gap-4 mb-6">
                    <span class="bg-primary text-zinc-dark px-4 py-1 text-xs font-bold rounded-sm uppercase tracking-widest">{{ $post->category }}</span>
                    <span class="text-gray-300 text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-primary">calendar_today</span>
                        {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}
                    </span>
                    <span class="text-gray-300 text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-primary">schedule</span>
                        {{ $readingTime }} {{ __('minutes to read') }}
                    </span>
                </div>
                <h1 class="text-4xl md:text-6xl font-black text-white font-almarai leading-tight max-w-4xl">{{ $postTitle }}</h1>
            </div>
        </div>
    </div>
</section>

<main class="max-w-7xl mx-auto px-6 py-16">
    <div class="flex flex-col lg:flex-row gap-16">
        <div class="w-full lg:w-2/3">
            <article class="article-content rounded-3xl p-8">
                @php
                    // Use accessor directly - locale is already set on model above
                    $excerpt = $post->excerpt;
                    // Use content_html accessor to convert ProseMirror JSON to HTML if needed
                    $content = $post->content_html;
                    
                    // Ensure excerpt is a string
                    $excerpt = is_string($excerpt) ? $excerpt : (is_array($excerpt) ? '' : (string) $excerpt);
                @endphp
                @if($excerpt)
                    <p class="text-xl text-gray-200 font-medium mb-10 leading-relaxed border-s-2 border-primary ps-6">
                        {{ $excerpt }}
                    </p>
                @endif

                @if($content)
                    {!! $content !!}
                @else
                    <p class="text-gray-300 text-lg leading-8 mb-6">{{ __('Content is currently unavailable.') }}</p>
                @endif
            </article>

            <div class="mt-20 pt-10 border-t border-primary flex flex-col md:flex-row justify-between gap-8">
                @if($prevPost)
                    @php
                        $prevPost->setLocale($currentLocale);
                        $prevPostTitle = $prevPost->title;
                        $prevPostTitle = is_string($prevPostTitle) ? $prevPostTitle : (is_array($prevPostTitle) ? '' : (string) $prevPostTitle);
                    @endphp
                    <a class="flex-1 group flex items-center gap-4 p-4 rounded-xl bg-white hover:bg-primary/10 transition-all border border-primary/40" href="{{ route('blog.show', ['locale' => app()->getLocale(), 'slug' => $prevPost->slug]) }}">
                        <div class="w-20 h-20 rounded-lg overflow-hidden shrink-0">
                            @if($prevPost->featured_image_url)
                                <img alt="{{ $prevPostTitle }}" class="w-full h-full object-cover" src="{{ $prevPost->featured_image_url }}"/>
                            @else
                                <div class="w-full h-full bg-zinc-800 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-2xl text-gray-600">image</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <span class="text-secondary text-[10px] font-bold block mb-1">{{ __('Previous Article') }}</span>
                            <h4 class="text-secondary text-sm font-bold  transition-colors">{{ $prevPostTitle }}</h4>
                        </div>
                    </a>
                @else
                    <div class="flex-1"></div>
                @endif

                @if($nextPost)
                    @php
                        $nextPost->setLocale($currentLocale);
                        $nextPostTitle = $nextPost->title;
                        $nextPostTitle = is_string($nextPostTitle) ? $nextPostTitle : (is_array($nextPostTitle) ? '' : (string) $nextPostTitle);
                    @endphp
                    <a class="flex-1 group flex items-center justify-end gap-4 p-4 rounded-xl bg-white hover:bg-primary/10 transition-all border border-primary/40 text-left" href="{{ route('blog.show', ['locale' => app()->getLocale(), 'slug' => $nextPost->slug]) }}">
                        <div class="text-right">
                            <span class="text-secondary text-[10px] font-bold block mb-1">{{ __('Next Article') }}</span>
                            <h4 class="text-secondary text-sm font-bold transition-colors">{{ $nextPostTitle }}</h4>
                        </div>
                        <div class="w-20 h-20 rounded-lg overflow-hidden shrink-0">
                            @if($nextPost->featured_image_url)
                                <img alt="{{ $nextPostTitle }}" class="w-full h-full object-cover" src="{{ $nextPost->featured_image_url }}"/>
                            @else
                                <div class="w-full h-full bg-zinc-800 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-2xl text-gray-600">image</span>
                                </div>
                            @endif
                        </div>
                    </a>
                @else
                    <div class="flex-1"></div>
                @endif
            </div>

            @php
                $approvedComments = $post->approvedComments()->orderBy('created_at', 'desc')->get();
            @endphp

            @if($approvedComments->count() > 0)
                <section class="mt-20">
                    <h3 class="text-2xl font-bold text-white mb-8 font-almarai">التعليقات ({{ $approvedComments->count() }})</h3>
                    <div class="space-y-6">
                        @foreach($approvedComments as $comment)
                            <div class="bg-zinc-dark p-6 rounded-2xl border border-white/5">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <h4 class="text-white font-bold mb-1">{{ $comment->name }}</h4>
                                        <p class="text-gray-500 text-xs">{{ $comment->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                                <p class="text-gray-300 leading-relaxed">{{ $comment->message }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <section class="mt-20">
                <h3 class="text-2xl font-bold text-secondary mb-8 font-almarai">{{ __('Leave a Comment') }}</h3>
                @if(session('comment_success'))
                    <div class="bg-primary/20 border border-primary/30 text-primary px-6 py-4 rounded-lg mb-6">
                        {{ session('comment_success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="bg-red-500/20 border border-red-500/30 text-red-400 px-6 py-4 rounded-lg mb-6">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="space-y-6 bg-white p-8 rounded-2xl border border-primary/40" action="{{ route('comments.store', ['locale' => app()->getLocale()]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="blog_post_id" value="{{ $post->id }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm text-gray-400 mr-2">{{ __('Full Name') }}</label>
                            <input name="name" value="{{ old('name') }}" class="w-full bg-white border border-gray-200 rounded-lg focus-visible:ring-primary focus:ring-primary focus:border-primary text-secondary px-4 py-3 @error('name') border-red-500 @enderror" placeholder="{{ __('Full Name') }}" type="text" required/>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm text-gray-400 mr-2">{{ __('Email') }}</label>
                            <input name="email" value="{{ old('email') }}" class="w-full bg-white border border-gray-200 rounded-lg focus:ring-primary focus:border-primary text-secondary px-4 py-3 @error('email') border-red-500 @enderror" placeholder="your@email.com" type="email" required/>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm text-gray-400 mr-2">{{ __('Comment') }}</label>
                        <textarea name="message" class="w-full bg-white border border-gray-200 rounded-lg focus:ring-primary focus:border-primary text-secondary px-4 py-3 @error('message') border-red-500 @enderror" placeholder="{{ __('Write your comment here...') }}" rows="5" required>{{ old('message') }}</textarea>
                    </div>
                    <button class="bg-primary text-white px-10 py-3 font-bold hover:bg-primary/80 transition-colors rounded-sm" type="submit">{{ __('Send Comment') }}</button>
                </form>
            </section>
        </div>

        <aside class="w-full lg:w-1/3 space-y-10">
            <div class="bg-white p-8 rounded-2xl border border-primary/40 text-center">
                <div class="w-24 h-24 mx-auto mb-4 rounded-full border-2 border-primary p-1">
                    <div class="w-full h-full bg-primary/20 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-4xl text-primary">person</span>
                    </div>
                </div>
                <h4 class="text-secondary text-lg font-bold font-almarai mb-1">{{ __('Balkis Team') }}</h4>
                <p class="text-primary text-xs font-medium mb-4 uppercase tracking-wider">{{ __('Investment Experts') }}</p>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">{{ __('A team of experts specializing in the Turkish real estate market and investment management.') }}</p>
                <div class="flex justify-center gap-4">
                    @if($homePage && $homePage->footer_linkedin_url)
                        <a class="text-gray-500 hover:text-primary transition-colors" href="{{ $homePage->footer_linkedin_url }}" target="_blank" rel="noopener noreferrer">
                            <span class="material-symbols-outlined">alternate_email</span>
                        </a>
                    @endif
                    <a class="text-gray-500 hover:text-primary transition-colors" href="{{ route('blog.index', ['locale' => app()->getLocale()]) }}">
                        <span class="material-symbols-outlined">share</span>
                    </a>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl border border-primary/40">
                <h4 class="text-secondary text-sm font-bold mb-6 font-almarai border-s-4 border-primary ps-3">{{ __('Share Article') }}</h4>
                <div class="flex gap-4">
                    <button onclick="shareOnTwitter()" class="flex-1 bg-primary/10 border border-primary/20 text-primary py-3 rounded-lg flex items-center justify-center gap-2 hover:bg-primary hover:text-zinc-dark transition-all">
                        <span class="material-symbols-outlined text-xl">share</span>
                        <span class="text-xs font-bold uppercase tracking-widest">Twitter</span>
                    </button>
                    <button onclick="shareOnLinkedIn()" class="flex-1 bg-primary/10 border border-primary/20 text-primary py-3 rounded-lg flex items-center justify-center gap-2 hover:bg-primary hover:text-zinc-dark transition-all">
                        <span class="material-symbols-outlined text-xl">link</span>
                        <span class="text-xs font-bold uppercase tracking-widest">LinkedIn</span>
                    </button>
                </div>
            </div>

            @if($relatedPosts->count() > 0)
                <div class="bg-white p-8 rounded-2xl border border-primary/40">
                    <h4 class="text-secondary text-sm font-bold mb-8 font-almarai border-s-4 border-primary ps-3">{{ __('Trending Articles') }}</h4>
                    <div class="space-y-6">
                        @foreach($relatedPosts as $index => $relatedPost)
                            @php
                                $relatedPost->setLocale($currentLocale);
                                $relatedPostTitle = $relatedPost->title;
                                $relatedPostTitle = is_string($relatedPostTitle) ? $relatedPostTitle : (is_array($relatedPostTitle) ? '' : (string) $relatedPostTitle);
                                // Use content_html accessor to convert ProseMirror JSON to HTML if needed
                                $relatedContent = $relatedPost->content_html;
                                $relatedWordCount = str_word_count(strip_tags($relatedContent));
                                $relatedReadingTime = max(1, ceil($relatedWordCount / 200));
                            @endphp
                            <a class="group flex gap-4" href="{{ route('blog.show', ['locale' => app()->getLocale(), 'slug' => $relatedPost->slug]) }}">
                                <span class="text-2xl font-black text-secondary/10 group-hover:text-primary/30 transition-colors">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <div>
                                    <h5 class="text-secondary text-sm font-bold mb-1 leading-snug group-hover:text-primary transition-colors">{{ $relatedPostTitle }}</h5>
                                    <span class="text-gray-500 text-[10px]">{{ $relatedReadingTime }} {{ __('minutes to read') }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="relative bg-gold-gradient p-8 rounded-2xl overflow-hidden">
                <div class="absolute -top-12 -right-12 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                <h3 class="text-white/90 text-xl font-bold mb-3 font-almarai relative z-10">{{ __('Balkis Newsletter') }}</h3>
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
                        <input name="email" value="{{ old('email') }}" class="w-full bg-white/20 border-transparent placeholder-zinc-dark/60 text-zinc-dark text-sm px-4 py-3 rounded focus:ring-zinc-dark/40 @error('email') border-red-500 @enderror" placeholder="بريدك الإلكتروني" type="email" required/>
                        <button type="submit" class="w-full bg-zinc-dark text-primary py-3 font-bold text-sm  transition-colors">{{ __('Subscribe Now') }}</button>
                    </form>
                </div>
            </div>
        </aside>
    </div>
</main>
@endsection

@push('scripts')
<script>
    function shareOnTwitter() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('{{ $postTitle }}');
        window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank', 'width=600,height=400');
    }

    function shareOnLinkedIn() {
        const url = encodeURIComponent(window.location.href);
        window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}`, '_blank', 'width=600,height=400');
    }
</script>
@endpush

