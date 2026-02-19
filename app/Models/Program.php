<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Program extends Model
{
    /** @use HasFactory<\Database\Factories\ProgramFactory> */
    use HasFactory;

    use HasTranslations;

    /** @var array<string> */
    public array $translatable = [
        'title',
        'description',
        'category',
        'overview',
    ];

    protected $fillable = [
        'title',
        'description',
        'category',
        'category_icon',
        'image',
        'url',
        'location',
        'area',
        'rooms',
        'annual_return',
        'citizenship_eligible',
        'price',
        'gallery_images',
        'features',
        'overview',
        // Tourism fields
        'trip_stages',
        'includes',
        'min_participants',
        'max_participants',
        'duration',
        'departure_location',
        'return_location',
        'accommodation_type',
        'meal_plan',
        'order',
        'is_active',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean',
        'citizenship_eligible' => 'boolean',
        'gallery_images' => 'array',
        'features' => 'array',
        'trip_stages' => 'array',
        'includes' => 'array',
        'min_participants' => 'integer',
        'max_participants' => 'integer',
    ];

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        return asset('storage/'.$this->image);
    }

    /**
     * Get gallery images URLs
     *
     * @return array<string>
     */
    public function getGalleryImagesUrlsAttribute(): array
    {
        if (! $this->gallery_images || ! is_array($this->gallery_images)) {
            return [];
        }

        return array_map(function ($image) {
            return asset('storage/'.$image);
        }, $this->gallery_images);
    }
}
