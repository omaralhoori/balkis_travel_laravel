<?php

use Illuminate\Support\Facades\Route;

// Redirect root to default locale
Route::get('/', function () {
    return redirect('/'.config('app.locale', 'ar'));
});

// Sitemap Route
Route::get('/sitemap.xml', function () {
    return response()->view('sitemap')->header('Content-Type', 'text/xml');
});

// Robots.txt Route
Route::get('/robots.txt', function () {
    $content = "User-agent: *\nDisallow:\n\nSitemap: " . url('/sitemap.xml') . "\n";
    return response($content)->header('Content-Type', 'text/plain');
});

// Locale-prefixed routes
Route::prefix('{locale}')
    ->where(['locale' => implode('|', config('app.supported_locales', ['ar', 'en', 'tr', 'fr']))])
    ->group(function () {
        Route::get('/', function () {
            $topPrograms = \App\Models\Program::where('is_active', true)
                ->orderBy('views', 'desc')
                ->limit(6)
                ->get();
                
            $touristTrips = \App\Models\TouristTrip::where('is_active', true)
                ->orderBy('order')
                ->get();
                
            // Tourist Guide Rotation Logic
            $homePage = \App\Models\HomePage::getCurrent();
            
            if (!$homePage->tourist_guide_last_rotated_at || now()->diffInDays($homePage->tourist_guide_last_rotated_at) >= 3) {
                $homePage->tourist_guide_offset += 5;
                $homePage->tourist_guide_last_rotated_at = now();
                $homePage->save();
            }
            
            $offset = $homePage->tourist_guide_offset;
            $allActivePosts = \App\Models\BlogPost::where('is_active', true)->orderBy('published_at', 'desc')->get();
            
            $totalPosts = $allActivePosts->count();
            $touristGuidePosts = collect();
            
            if ($totalPosts > 0) {
                $startIndex = $offset % $totalPosts;
                $needed = min(5, $totalPosts);
                
                for ($i = 0; $i < $needed; $i++) {
                    $index = ($startIndex + $i) % $totalPosts;
                    $touristGuidePosts->push($allActivePosts[$index]);
                }
            }
                
            return view('home', compact('topPrograms', 'touristTrips', 'touristGuidePosts'));
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

        Route::get('/programs/{id}', function (string $locale, int $id) {
            $program = \App\Models\Program::where('id', $id)
                ->where('is_active', true)
                ->firstOrFail();

            // Increment views
            $program->increment('views');

            // Set locale on program to ensure translations work correctly
            $program->setLocale($locale);

            return view('programs.show', [
                'program' => $program,
            ]);
        })->name('programs.show');

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

        Route::post('/inquiry', [\App\Http\Controllers\InquiryController::class, 'store'])->name('inquiry.submit');

        Route::post('/newsletter/subscribe', [\App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

        Route::get('/tourist-trips', function () {
            $touristTrips = \App\Models\TouristTrip::where('is_active', true)
                ->orderBy('order')
                ->get();
            return view('tourist_trips', compact('touristTrips'));
        })->name('tourist_trips.index');

        Route::get('/accommodations', function () {
            $allAccommodations = \App\Models\Accommodation::where('is_active', true)
                ->orderBy('order')
                ->get();
                
            $cities = $allAccommodations->pluck('city')->unique()->values();
            
            $selectedCity = request('city');
            $filteredAccommodations = null;
            
            if ($selectedCity) {
                // filter accommodations by city text in current locale
                $filteredAccommodations = $allAccommodations->filter(function($acc) use ($selectedCity) {
                    return $acc->city === $selectedCity;
                });
            }

            return view('accommodations.index', compact('cities', 'filteredAccommodations', 'allAccommodations'));
        })->name('accommodations.index');

        Route::post('/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');

        Route::get('/about', function () {
            $aboutPage = \App\Models\AboutPage::getCurrent();

            return view('about', ['aboutPage' => $aboutPage]);
        })->name('about');

        Route::get('/whatsapp', [\App\Http\Controllers\WhatsAppController::class, 'redirect'])->name('whatsapp.redirect');
    });
