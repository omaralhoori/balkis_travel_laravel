<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::saving(function (Model $model): void {
            if (blank($model->getAttribute('slug'))) {
                $model->setAttribute('slug', $model->generateUniqueSlug((string) $model->getAttribute($model->slugSource())));
            }
        });
    }

    public function slugSource(): string
    {
        return 'title';
    }

    public static function makeSlug(?string $value): string
    {
        $value = (string) $value;

        $slug = Str::slug($value);

        if ($slug !== '') {
            return $slug;
        }

        $slug = preg_replace('/[^\p{L}\p{N}]+/u', '-', Str::lower($value)) ?? '';

        return trim($slug, '-');
    }

    public function generateUniqueSlug(?string $value): string
    {
        $base = static::makeSlug($value);

        if ($base === '') {
            $base = Str::lower(class_basename(static::class));
        }

        $slug = $base;
        $suffix = 2;

        while (
            static::query()
                ->where('slug', $slug)
                ->when($this->getKey(), fn ($query) => $query->whereKeyNot($this->getKey()))
                ->exists()
        ) {
            $slug = $base.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }
}
