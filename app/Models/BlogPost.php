<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Tiptap\Editor;

class BlogPost extends Model
{
    /** @use HasFactory<\Database\Factories\BlogPostFactory> */
    use HasFactory;

    use HasTranslations;

    /** @var array<string> */
    public array $translatable = [
        'title',
        'excerpt',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'featured_image',
        'is_featured',
        'is_active',
        'order',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
        'canonical_url',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        // Set locale for translations when model is retrieved
        static::retrieved(function (BlogPost $post) {
            $post->setLocale(app()->getLocale());
        });
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        if (! $this->featured_image) {
            return null;
        }

        return asset('storage/'.$this->featured_image);
    }

    public function getOgImageUrlAttribute(): ?string
    {
        if (! $this->og_image) {
            return $this->featured_image_url;
        }

        return asset('storage/'.$this->og_image);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments(): HasMany
    {
        return $this->hasMany(Comment::class)->where('is_approved', true);
    }

    /**
     * Convert ProseMirror JSON to HTML if needed
     */
    protected function convertContentToHtml($content, ?string $locale = null): string
    {
        if (empty($content)) {
            return '';
        }

        // If content is already a string (HTML), return it
        if (is_string($content)) {
            return $content;
        }

        // If content is an array/object (ProseMirror JSON), convert it to HTML
        if (is_array($content) || is_object($content)) {
            try {
                $editor = new Editor;
                $html = $editor->setContent($content)->getHTML();

                return $html ?: '';
            } catch (\Exception $e) {
                // If conversion fails, return empty string
                return '';
            }
        }

        return (string) $content;
    }

    /**
     * Get content as HTML, converting from ProseMirror JSON if needed
     */
    public function getContentHtmlAttribute(): string
    {
        // Get content for current locale
        $locale = $this->getLocale() ?: app()->getLocale();
        $content = $this->getTranslation('content', $locale, useFallbackLocale: false);

        // If no translation found, try to get from raw attribute
        if (empty($content)) {
            $rawContent = $this->getAttributes()['content'] ?? null;
            if ($rawContent && is_array($rawContent) && isset($rawContent[$locale])) {
                $content = $rawContent[$locale];
            } elseif ($rawContent && is_string($rawContent)) {
                // Try to decode JSON
                $decoded = json_decode($rawContent, true);
                if (is_array($decoded) && isset($decoded[$locale])) {
                    $content = $decoded[$locale];
                } else {
                    $content = $rawContent;
                }
            }
        }

        return $this->convertContentToHtml($content);
    }
}
