<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormSubmission extends Model
{
    /** @use HasFactory<\Database\Factories\FormSubmissionFactory> */
    use HasFactory;

    protected $fillable = [
        'custom_form_id',
        'answers',
        'ip_address',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'answers' => 'array',
        ];
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(CustomForm::class, 'custom_form_id');
    }

    public function answerFor(string $fieldKey): mixed
    {
        return $this->answers[$fieldKey] ?? null;
    }
}
