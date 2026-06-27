<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ExclusiveService extends Model
{
    /** @use HasFactory<\Database\Factories\ExclusiveServiceFactory> */
    use HasFactory;

    use HasSlug;
    use HasTranslations;

    /** @var array<string> */
    public array $translatable = [
        'title',
        'description',
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'display_image',
        'services',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order' => 'integer',
            'services' => 'array',
        ];
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        return asset('storage/'.$this->image);
    }

    public function getDisplayImageUrlAttribute(): ?string
    {
        if (! $this->display_image) {
            return $this->image_url;
        }

        return asset('storage/'.$this->display_image);
    }
}
