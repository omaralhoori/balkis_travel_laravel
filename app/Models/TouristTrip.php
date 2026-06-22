<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TouristTrip extends Model
{
    /** @use HasFactory<\Database\Factories\TouristTripFactory> */
    use HasFactory;

    use HasSlug;
    use HasTranslations;

    /** @var array<string> */
    public array $translatable = [
        'title',
        'description',
        'location',
        'duration',
        'meeting_point',
        'includes',
        'what_to_bring',
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'duration',
        'meeting_point',
        'price',
        'image',
        'gallery_images',
        'includes',
        'what_to_bring',
        'highlights',
        'itinerary',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order' => 'integer',
            'gallery_images' => 'array',
            'highlights' => 'array',
            'itinerary' => 'array',
        ];
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        return asset('storage/'.$this->image);
    }

    /**
     * Get gallery images URLs.
     *
     * @return array<string>
     */
    public function getGalleryImagesUrlsAttribute(): array
    {
        if (! $this->gallery_images || ! is_array($this->gallery_images)) {
            return [];
        }

        return array_map(fn (string $image): string => asset('storage/'.$image), $this->gallery_images);
    }
}
