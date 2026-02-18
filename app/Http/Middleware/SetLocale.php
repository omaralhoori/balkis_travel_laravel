<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);
        $supportedLocales = config('app.supported_locales', []);

        if (! in_array($locale, $supportedLocales)) {
            $locale = config('app.locale', 'ar');
        }

        app()->setLocale($locale);
        setlocale(LC_TIME, $this->getPhpLocale($locale));

        $dir = $locale === 'ar' ? 'rtl' : 'ltr';
        view()->share('dir', $dir);
        view()->share('currentLocale', $locale);

        return $next($request);
    }

    private function getPhpLocale(string $locale): string
    {
        return match ($locale) {
            'ar' => 'ar_SA.UTF-8',
            'en' => 'en_US.UTF-8',
            'tr' => 'tr_TR.UTF-8',
            default => 'ar_SA.UTF-8',
        };
    }
}
