<?php

namespace App\Traits;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Translatable
{
    /**
     * Get all translations for this model
     */
    public function translations(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    /**
     * Get translation for a specific field and locale
     */
    public function getTranslation(string $field, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();

        // إذا كانت اللغة هي اللغة الافتراضية (العربية)، لا نحتاج للترجمة
        if ($locale === 'ar') {
            return null;
        }

        // استخدام cache للترجمات لتجنب استعلامات متعددة
        $cacheKey = "translation_{$this->getMorphClass()}_{$this->getKey()}_{$locale}_{$field}";

        return cache()->remember($cacheKey, 3600, function () use ($field, $locale) {
            $translation = $this->translations()
                ->where('locale', $locale)
                ->where('field', $field)
                ->first();

            return $translation?->value;
        });
    }

    /**
     * Set translation for a specific field and locale
     */
    public function setTranslation(string $field, string $value, ?string $locale = null): void
    {
        $locale = $locale ?? app()->getLocale();

        $this->translations()->updateOrCreate(
            [
                'locale' => $locale,
                'field' => $field,
            ],
            [
                'value' => $value,
            ]
        );

        // مسح الـ cache بعد تحديث الترجمة
        $cacheKey = "translation_{$this->getMorphClass()}_{$this->getKey()}_{$locale}_{$field}";
        cache()->forget($cacheKey);
    }

    /**
     * Get translated value or fallback to default
     */
    public function getTranslated(string $field, ?string $locale = null): mixed
    {
        $locale = $locale ?? app()->getLocale();

        // إذا كانت اللغة هي اللغة الافتراضية (العربية)، ارجع القيمة الأصلية
        if ($locale === 'ar') {
            return $this->getRawOriginal($field) ?? $this->attributes[$field] ?? null;
        }

        // جرب الحصول على الترجمة
        $translation = $this->getTranslation($field, $locale);

        // إذا كانت الترجمة موجودة، ارجعها
        if ($translation !== null) {
            return $translation;
        }

        // إذا لم تكن موجودة، ارجع القيمة الافتراضية (العربية) بدون استدعاء accessor
        return $this->getRawOriginal($field) ?? $this->attributes[$field] ?? null;
    }

    /**
     * Get all translations for a specific locale
     */
    public function getTranslationsForLocale(?string $locale = null): array
    {
        $locale = $locale ?? app()->getLocale();

        return $this->translations()
            ->where('locale', $locale)
            ->pluck('value', 'field')
            ->toArray();
    }

    /**
     * Delete translation for a specific field and locale
     */
    public function deleteTranslation(string $field, ?string $locale = null): bool
    {
        $locale = $locale ?? app()->getLocale();

        $deleted = $this->translations()
            ->where('locale', $locale)
            ->where('field', $field)
            ->delete() > 0;

        if ($deleted) {
            // مسح الـ cache بعد حذف الترجمة
            $cacheKey = "translation_{$this->getMorphClass()}_{$this->getKey()}_{$locale}_{$field}";
            cache()->forget($cacheKey);
        }

        return $deleted;
    }

    /**
     * Delete all translations for a specific locale
     */
    public function deleteTranslationsForLocale(?string $locale = null): bool
    {
        $locale = $locale ?? app()->getLocale();

        // الحصول على جميع الحقول قبل الحذف لمسح الـ cache
        $fields = $this->translations()
            ->where('locale', $locale)
            ->pluck('field')
            ->unique();

        $deleted = $this->translations()
            ->where('locale', $locale)
            ->delete() > 0;

        if ($deleted) {
            // مسح الـ cache لجميع الحقول
            foreach ($fields as $field) {
                $cacheKey = "translation_{$this->getMorphClass()}_{$this->getKey()}_{$locale}_{$field}";
                cache()->forget($cacheKey);
            }
        }

        return $deleted;
    }
}
