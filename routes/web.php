<?php

use Illuminate\Support\Facades\Route;

// Redirect root to default locale
Route::get('/', function () {
    return redirect('/'.config('app.locale', 'ar'));
});

// Locale-prefixed routes
Route::prefix('{locale}')
    ->where(['locale' => implode('|', config('app.supported_locales', ['ar', 'en', 'tr']))])
    ->group(function () {
        Route::get('/', function () {
            return view('home');
        })->name('home');

        Route::get('/programs', function () {
            $programs = \App\Models\Program::where('is_active', true)->orderBy('order')->get();
            $categories = \App\Models\Program::where('is_active', true)
                ->distinct()
                ->pluck('category')
                ->filter()
                ->values();

            return view('programs.index', [
                'programs' => $programs,
                'categories' => $categories,
            ]);
        })->name('programs.index');

        Route::get('/blog', function () {
            $featuredPost = \App\Models\BlogPost::where('is_active', true)
                ->where('is_featured', true)
                ->where('published_at', '<=', now())
                ->orderBy('published_at', 'desc')
                ->first();

            $posts = \App\Models\BlogPost::where('is_active', true)
                ->where('published_at', '<=', now())
                ->where(function ($query) use ($featuredPost) {
                    if ($featuredPost) {
                        $query->where('id', '!=', $featuredPost->id);
                    }
                })
                ->orderBy('published_at', 'desc')
                ->paginate(6);

            $categories = \App\Models\BlogPost::where('is_active', true)
                ->where('published_at', '<=', now())
                ->selectRaw('category, COUNT(*) as count')
                ->groupBy('category')
                ->orderBy('count', 'desc')
                ->get();

            return view('blog.index', [
                'featuredPost' => $featuredPost,
                'posts' => $posts,
                'categories' => $categories,
            ]);
        })->name('blog.index');

        Route::get('/blog/{slug}', function (string $locale, string $slug) {
            $post = \App\Models\BlogPost::with('approvedComments')
                ->where('slug', $slug)
                ->where('is_active', true)
                ->where('published_at', '<=', now())
                ->firstOrFail();

            // Set locale on post to ensure translations work correctly
            $post->setLocale($locale);

            $prevPost = \App\Models\BlogPost::where('is_active', true)
                ->where('published_at', '<=', now())
                ->where('published_at', '<', $post->published_at)
                ->orderBy('published_at', 'desc')
                ->first();

            if ($prevPost) {
                $prevPost->setLocale($locale);
            }

            $nextPost = \App\Models\BlogPost::where('is_active', true)
                ->where('published_at', '<=', now())
                ->where('published_at', '>', $post->published_at)
                ->orderBy('published_at', 'asc')
                ->first();

            if ($nextPost) {
                $nextPost->setLocale($locale);
            }

            $relatedPosts = \App\Models\BlogPost::where('is_active', true)
                ->where('published_at', '<=', now())
                ->where('id', '!=', $post->id)
                ->where('category', $post->category)
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();

            // Set locale on all related posts
            foreach ($relatedPosts as $relatedPost) {
                $relatedPost->setLocale($locale);
            }

            return view('blog.show', [
                'post' => $post,
                'prevPost' => $prevPost,
                'nextPost' => $nextPost,
                'relatedPosts' => $relatedPosts,
            ]);
        })->name('blog.show');

        Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.submit');

        Route::post('/newsletter/subscribe', [\App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

        Route::post('/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');

        Route::get('/about', function () {
            $aboutPage = \App\Models\AboutPage::getCurrent();

            return view('about', ['aboutPage' => $aboutPage]);
        })->name('about');

        Route::get('/whatsapp', [\App\Http\Controllers\WhatsAppController::class, 'redirect'])->name('whatsapp.redirect');
    });
