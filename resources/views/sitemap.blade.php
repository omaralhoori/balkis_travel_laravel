<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach(config('app.supported_locales', ['ar', 'en', 'tr', 'fr']) as $locale)
        <!-- Home Page -->
        <url>
            <loc>{{ url('/' . $locale) }}</loc>
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
            @foreach(config('app.supported_locales', ['ar', 'en', 'tr', 'fr']) as $altLocale)
                <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ url('/' . $altLocale) }}" />
            @endforeach
        </url>

        <!-- About Page -->
        <url>
            <loc>{{ url('/' . $locale . '/about') }}</loc>
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
            @foreach(config('app.supported_locales', ['ar', 'en', 'tr', 'fr']) as $altLocale)
                <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ url('/' . $altLocale . '/about') }}" />
            @endforeach
        </url>

        <!-- Programs Page -->
        <url>
            <loc>{{ url('/' . $locale . '/programs') }}</loc>
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
            @foreach(config('app.supported_locales', ['ar', 'en', 'tr', 'fr']) as $altLocale)
                <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ url('/' . $altLocale . '/programs') }}" />
            @endforeach
        </url>

        <!-- Blog Page -->
        <url>
            <loc>{{ url('/' . $locale . '/blog') }}</loc>
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
            @foreach(config('app.supported_locales', ['ar', 'en', 'tr', 'fr']) as $altLocale)
                <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ url('/' . $altLocale . '/blog') }}" />
            @endforeach
        </url>

        <!-- Individual Programs -->
        @foreach(\App\Models\Program::where('is_active', true)->get() as $program)
            <url>
                <loc>{{ url('/' . $locale . '/programs/' . $program->id) }}</loc>
                <lastmod>{{ $program->updated_at->tz('UTC')->toAtomString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
                @foreach(config('app.supported_locales', ['ar', 'en', 'tr', 'fr']) as $altLocale)
                    <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ url('/' . $altLocale . '/programs/' . $program->id) }}" />
                @endforeach
            </url>
        @endforeach

        <!-- Individual Blog Posts -->
        @foreach(\App\Models\BlogPost::where('is_active', true)->where('published_at', '<=', now())->get() as $post)
            <url>
                <loc>{{ url('/' . $locale . '/blog/' . $post->slug) }}</loc>
                <lastmod>{{ $post->updated_at->tz('UTC')->toAtomString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
                @foreach(config('app.supported_locales', ['ar', 'en', 'tr', 'fr']) as $altLocale)
                    <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ url('/' . $altLocale . '/blog/' . $post->slug) }}" />
                @endforeach
            </url>
        @endforeach
    @endforeach
</urlset>
