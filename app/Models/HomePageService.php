<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class HomePageService extends Model
{
    use HasTranslations;

    /** @var array<string> */
    public array $translatable = [
        'title',
        'subtitle',
        'description',
        'badge_text',
        'card_title',
        'card_description',
        'cta_button_text',
        'stats'
    ];

    protected $fillable = [
        'home_page_id',
        'service_key',
        'title',
        'subtitle',
        'description',
        'badge_text',
        'badge_icon',
        'background_image',
        'card_image',
        'card_title',
        'card_description',
        'card_icon',
        'card_url',
        'cta_button_text',
        'cta_button_url',
        'order',
        'is_active',
        'stats',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'stats' => 'array',
        'order' => 'integer',
    ];

    public function getBackgroundImageUrlAttribute(): ?string
    {
        if (! $this->background_image) {
            return null;
        }

        return asset('storage/'.$this->background_image);
    }

    public function getCardImageUrlAttribute(): ?string
    {
        if ($this->card_image) {
            return asset('storage/'.$this->card_image);
        }

        if ($this->background_image) {
            return asset('storage/'.$this->background_image);
        }

        return null;
    }

    public function homePage(): BelongsTo
    {
        return $this->belongsTo(HomePage::class);
    }
}
