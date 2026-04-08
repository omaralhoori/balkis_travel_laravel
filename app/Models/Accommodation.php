<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Storage;

class Accommodation extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'city',
        'type',
        'rating',
        'images',
        'order',
        'is_active',
    ];

    public $translatable = ['title', 'description', 'city'];

    protected function casts(): array
    {
        return [
            'images' => 'array',
            'is_active' => 'boolean',
            'rating' => 'decimal:1',
        ];
    }
    
    public function getImagesUrlsAttribute(): array
    {
        $urls = [];
        if ($this->images) {
            foreach ($this->images as $image) {
                if (filter_var($image, FILTER_VALIDATE_URL)) {
                    $urls[] = $image;
                } else {
                    $urls[] = Storage::disk('public')->url($image);
                }
            }
        }
        return $urls;
    }
}
