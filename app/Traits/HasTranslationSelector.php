<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;

trait HasTranslationSelector
{
    /**
     * Get the current translation locale from session
     */
    protected function getTranslationLocale(): string
    {
        return Session::get('translation_locale', 'ar');
    }

    /**
     * Set the translation locale in session
     */
    protected function setTranslationLocale(string $locale): void
    {
        if (in_array($locale, ['ar', 'en', 'tr'])) {
            Session::put('translation_locale', $locale);
        }
    }

    /**
     * Check if currently editing translations (non-Arabic locale)
     */
    protected function isEditingTranslation(): bool
    {
        return $this->getTranslationLocale() !== 'ar';
    }
}
