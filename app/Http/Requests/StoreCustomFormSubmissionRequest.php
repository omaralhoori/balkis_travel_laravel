<?php

namespace App\Http\Requests;

use App\Enums\FormFieldType;
use App\Models\CustomForm;
use App\Models\FormField;
use App\Services\CustomFormFieldLogic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomFormSubmissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $form = CustomForm::query()
            ->where('slug', $this->route('slug'))
            ->where('is_active', true)
            ->with('fields')
            ->first();

        if (! $form instanceof CustomForm) {
            return ['answers' => ['required', 'array']];
        }

        $answers = $this->input('answers', []);

        if (! is_array($answers)) {
            $answers = [];
        }

        $rules = [
            'answers' => ['required', 'array'],
        ];

        foreach ($form->fields as $field) {
            if (! CustomFormFieldLogic::fieldIsVisible($field, $answers)) {
                continue;
            }

            $key = 'answers.'.$field->field_key;
            $fieldRules = [];

            if ($field->is_required) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }

            $fieldRules = array_merge($fieldRules, $this->rulesForFieldType($field));

            $rules[$key] = $fieldRules;
        }

        return $rules;
    }

    /**
     * @return array<int, string|\Illuminate\Validation\Rules\In>
     */
    protected function rulesForFieldType(FormField $field): array
    {
        return match ($field->type) {
            FormFieldType::Email => ['email', 'max:255'],
            FormFieldType::Phone => ['string', 'max:30'],
            FormFieldType::Number => ['numeric'],
            FormFieldType::Date => ['date'],
            FormFieldType::Textarea => ['string', 'max:5000'],
            FormFieldType::Checkbox => ['array'],
            FormFieldType::Radio, FormFieldType::Select => [
                'string',
                Rule::in($field->options ?? []),
            ],
            default => ['string', 'max:255'],
        };
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        $form = CustomForm::query()
            ->where('slug', $this->route('slug'))
            ->where('is_active', true)
            ->with('fields')
            ->first();

        if (! $form instanceof CustomForm) {
            return [];
        }

        $attributes = [];

        foreach ($form->fields as $field) {
            $attributes['answers.'.$field->field_key] = $field->label;
        }

        return $attributes;
    }
}
