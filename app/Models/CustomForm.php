<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class CustomForm extends Model
{
    /** @use HasFactory<\Database\Factories\CustomFormFactory> */
    use HasFactory;

    use HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'logo_path',
        'background_image_path',
        'primary_color',
        'button_color',
        'text_color',
        'thank_you_title',
        'thank_you_message',
        'whatsapp_button_label',
        'whatsapp_message_template',
        'notification_email_primary',
        'notification_email_secondary',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function sections(): HasMany
    {
        return $this->hasMany(FormSection::class)->orderBy('order');
    }

    public function fields(): HasMany
    {
        return $this->hasMany(FormField::class)->orderBy('order');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(FormSubmission::class)->latest();
    }

    public function publicUrl(?string $locale = null): string
    {
        $locale ??= app()->getLocale();

        return route('custom_forms.show', [
            'locale' => $locale,
            'slug' => $this->slug,
        ]);
    }

    public function buildWhatsAppMessage(array $answers): string
    {
        $template = $this->whatsapp_message_template ?? __('Thank you for your submission. We will contact you soon.');

        return preg_replace_callback('/\{\{\s*([a-zA-Z0-9_]+)\s*\}\}/', function (array $matches) use ($answers): string {
            $key = $matches[1];
            $value = $answers[$key] ?? '';

            if (is_array($value)) {
                return implode(', ', $value);
            }

            return (string) $value;
        }, $template) ?? $template;
    }

    public static function makeFieldKey(string $label): string
    {
        $key = Str::slug($label, '_');

        if ($key === '') {
            $key = 'field_'.Str::lower(Str::random(6));
        }

        return $key;
    }
}
