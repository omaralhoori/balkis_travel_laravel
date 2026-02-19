<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HomePage extends Model
{
    use HasTranslations;

    /** @var array<string> */
    public array $translatable = [
        'main_title',
        'main_description',
        'footer_brand_name',
        'footer_brand_description',
        'destinations',
    ];

    protected $fillable = [
        // Home Page Fields
        'main_title',
        'main_description',
        'main_background_image',
        'destinations',
        // Footer Fields
        'footer_brand_name',
        'footer_brand_description',
        'footer_linkedin_url',
        'footer_twitter_url',
        'footer_instagram_url',
        'footer_facebook_url',
        'footer_youtube_url',
        'footer_snapchat_url',
        'footer_tiktok_url',
        'footer_about_url',
        'footer_projects_url',
        'footer_services_url',
        'footer_blog_url',
        'footer_tourism_url',
        'footer_realestate_url',
        'footer_investment_url',
        'footer_phone',
        'footer_email',
        'footer_working_hours',
        'footer_copyright_text',
        'footer_privacy_policy_url',
        'footer_terms_url',
    ];

    protected $casts = [
        'destinations' => 'array',
    ];

    public function getMainBackgroundImageUrlAttribute(): ?string
    {
        if (! $this->main_background_image) {
            return null;
        }

        return asset('storage/'.$this->main_background_image);
    }

    public static function getCurrent(): self
    {
        return static::firstOrCreate([], [
            'main_title' => 'مجموعة بلقيس',
            'main_description' => 'اكتشف قمة السياحة الفاخرة في تركيا، والعقارات المتميزة، والاستثمارات الاستراتيجية. نحن نصنع تجارب لا تُنسى ومستقبلاً واعداً.',
        ]);
    }
}
