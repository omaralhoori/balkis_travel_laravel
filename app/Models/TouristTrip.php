<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TouristTrip extends Model
{
    /** @use HasFactory<\Database\Factories\TouristTripFactory> */
    use HasFactory;

    use HasTranslations;

    /** @var array<string> */
    public array $translatable = [
        'title',
        'includes',
        'what_to_bring',
    ];

    protected $fillable = [
        'title',
        'image',
        'includes',
        'what_to_bring',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order' => 'integer',
        ];
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        return asset('storage/'.$this->image);
    }
}
