<?php

namespace App\Models;

use App\Enums\FormFieldType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormField extends Model
{
    protected static function booted(): void
    {
        static::saving(function (FormField $field): void {
            if (blank($field->custom_form_id) && filled($field->form_section_id)) {
                $field->custom_form_id = FormSection::query()
                    ->whereKey($field->form_section_id)
                    ->value('custom_form_id');
            }
        });
    }

    protected $fillable = [
        'custom_form_id',
        'form_section_id',
        'label',
        'field_key',
        'type',
        'help_text',
        'options',
        'conditional_rules',
        'is_required',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'type' => FormFieldType::class,
            'options' => 'array',
            'conditional_rules' => 'array',
            'is_required' => 'boolean',
        ];
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(CustomForm::class, 'custom_form_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(FormSection::class, 'form_section_id');
    }

    public function hasConditionalRules(): bool
    {
        return filled($this->conditional_rules);
    }

    /**
     * @return array<int, array{field_key: string, operator: string, value: string}>
     */
    public function conditionalRulesList(): array
    {
        return $this->conditional_rules ?? [];
    }
}
