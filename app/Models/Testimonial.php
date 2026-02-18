<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    /** @use HasFactory<\Database\Factories\TestimonialFactory> */
    use HasFactory;

    use HasTranslations;

    /** @var array<string> */
    public array $translatable = [
        'testimonial',
        'position',
    ];

    protected $fillable = [
        'name',
        'position',
        'company',
        'testimonial',
        'rating',
        'avatar',
        'order',
        'is_active',
    ];

    protected $casts = [
        'rating' => 'integer',
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/'.$this->avatar);
        }

        // Default avatar placeholder
        return 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&background=d4af35&color=201d12&size=128&bold=true';
    }
}
