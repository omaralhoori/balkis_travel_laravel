@extends('layouts.app')

@section('title', $form->title)

@push('styles')
<style>
    .custom-form-page {
        --form-primary: {{ $form->primary_color }};
        --form-button: {{ $form->button_color }};
        --form-text: {{ $form->text_color }};
        min-height: 100vh;
        background-color: #f8f6f2;
        @if ($form->background_image_path)
        background-image: linear-gradient(rgba(255,255,255,0.2), rgba(255,255,255,0.44)), url('{{ asset('storage/'.$form->background_image_path) }}');
        @endif
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    .custom-form-card {
        background: rgba(255,255,255,0.95);
        border: 1px solid rgba(198,162,100,0.25);
        box-shadow: 0 20px 60px rgba(74,86,108,0.08);
    }
    .custom-form-title { color: var(--form-text); }
    .custom-form-section-title {
        color: var(--form-primary);
        border-bottom: 2px solid rgba(198,162,100,0.35);
    }
    .custom-form-label { color: var(--form-text); }
    .custom-form-input {
        border-color: rgba(198,162,100,0.35);
        color: var(--form-text);
    }
    .custom-form-input:focus {
        border-color: var(--form-primary);
        ring-color: var(--form-primary);
        outline: none;
        box-shadow: 0 0 0 3px color-mix(in srgb, var(--form-primary) 25%, transparent);
    }
    .custom-form-submit {
        background: var(--form-button);
        color: #fff;
    }
    .custom-form-submit:hover { opacity: 0.92; }
    .field-hidden { display: none !important; }
</style>
@endpush

@section('content')
<div class="custom-form-page pt-24 pb-10 px-4 sm:px-6">
    <div class="max-w-3xl mx-auto">
        <div class="custom-form-card rounded-2xl p-6 sm:p-10">
            @if ($form->logo_path)
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('storage/'.$form->logo_path) }}" alt="{{ $form->title }}" class="h-20 object-contain">
                </div>
            @endif

            <h1 class="custom-form-title text-3xl font-bold text-center mb-3">{{ $form->title }}</h1>

            @if ($form->description)
                <p class="text-center text-gray-600 mb-8">{{ $form->description }}</p>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                    <ul class="list-disc ps-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('custom_forms.store', ['locale' => app()->getLocale(), 'slug' => $form->slug]) }}" id="custom-form" class="space-y-8">
                @csrf

                @foreach ($form->sections as $section)
                    <section class="space-y-5">
                        <h2 class="custom-form-section-title text-xl font-semibold pb-2">{{ $section->title }}</h2>

                        @foreach ($section->fields as $field)
                            @php
                                $inputName = 'answers['.$field->field_key.']';
                                $oldValue = old('answers.'.$field->field_key);
                            @endphp

                            <div
                                class="form-field-wrapper space-y-2"
                                data-field-key="{{ $field->field_key }}"
                                data-conditional-rules='@json($field->conditional_rules ?? [])'
                            >
                                <label class="custom-form-label block font-medium">
                                    {{ $field->label }}
                                    @if ($field->is_required)
                                        <span class="text-red-500">*</span>
                                    @endif
                                </label>

                                @if ($field->help_text)
                                    <p class="text-sm text-gray-500">{{ $field->help_text }}</p>
                                @endif

                                @switch($field->type)
                                    @case(\App\Enums\FormFieldType::Textarea)
                                        <textarea name="{{ $inputName }}" rows="4" class="custom-form-input w-full rounded-xl border px-4 py-3" @required($field->is_required)>{{ $oldValue }}</textarea>
                                        @break

                                    @case(\App\Enums\FormFieldType::Email)
                                        <input type="email" name="{{ $inputName }}" value="{{ $oldValue }}" class="custom-form-input w-full rounded-xl border px-4 py-3" @required($field->is_required)>
                                        @break

                                    @case(\App\Enums\FormFieldType::Phone)
                                        <input type="tel" name="{{ $inputName }}" value="{{ $oldValue }}" class="custom-form-input w-full rounded-xl border px-4 py-3" @required($field->is_required)>
                                        @break

                                    @case(\App\Enums\FormFieldType::Number)
                                        <input type="number" name="{{ $inputName }}" value="{{ $oldValue }}" class="custom-form-input w-full rounded-xl border px-4 py-3" @required($field->is_required)>
                                        @break

                                    @case(\App\Enums\FormFieldType::Date)
                                        <input type="date" name="{{ $inputName }}" value="{{ $oldValue }}" class="custom-form-input w-full rounded-xl border px-4 py-3" @required($field->is_required)>
                                        @break

                                    @case(\App\Enums\FormFieldType::Select)
                                        <select name="{{ $inputName }}" class="custom-form-input w-full rounded-xl border px-4 py-3" @required($field->is_required)>
                                            <option value="">{{ __('Select an option') }}</option>
                                            @foreach ($field->options ?? [] as $option)
                                                <option value="{{ $option }}" @selected($oldValue === $option)>{{ $option }}</option>
                                            @endforeach
                                        </select>
                                        @break

                                    @case(\App\Enums\FormFieldType::Radio)
                                        <div class="space-y-2">
                                            @foreach ($field->options ?? [] as $option)
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="{{ $inputName }}" value="{{ $option }}" class="text-[var(--form-primary)]" @checked($oldValue === $option) @required($field->is_required && $loop->first)>
                                                    <span>{{ $option }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        @break

                                    @case(\App\Enums\FormFieldType::Checkbox)
                                        <div class="space-y-2">
                                            @foreach ($field->options ?? [] as $option)
                                                @php $checked = is_array($oldValue) && in_array($option, $oldValue, true); @endphp
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="checkbox" name="{{ $inputName }}[]" value="{{ $option }}" class="text-[var(--form-primary)]" @checked($checked)>
                                                    <span>{{ $option }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        @break

                                    @default
                                        <input type="text" name="{{ $inputName }}" value="{{ $oldValue }}" class="custom-form-input w-full rounded-xl border px-4 py-3" @required($field->is_required)>
                                @endswitch
                            </div>
                        @endforeach
                    </section>
                @endforeach

                <div class="pt-4">
                    <button type="submit" class="custom-form-submit w-full sm:w-auto px-10 py-3 rounded-xl font-semibold transition">
                        {{ __('Submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('custom-form');
    if (!form) return;

    const wrappers = Array.from(form.querySelectorAll('.form-field-wrapper'));

    const getAnswers = () => {
        const answers = {};
        wrappers.forEach((wrapper) => {
            const key = wrapper.dataset.fieldKey;
            const radios = wrapper.querySelectorAll(`input[type="radio"][name="answers[${key}]"]`);
            const checkboxes = wrapper.querySelectorAll(`input[type="checkbox"][name="answers[${key}][]"]`);
            const select = wrapper.querySelector(`select[name="answers[${key}]"]`);
            const input = wrapper.querySelector(`input[name="answers[${key}]"]:not([type="radio"]):not([type="checkbox"]), textarea[name="answers[${key}]"]`);

            if (checkboxes.length) {
                answers[key] = Array.from(checkboxes).filter((el) => el.checked).map((el) => el.value);
            } else if (radios.length) {
                const checked = Array.from(radios).find((el) => el.checked);
                answers[key] = checked ? checked.value : '';
            } else if (select) {
                answers[key] = select.value;
            } else if (input) {
                answers[key] = input.value;
            }
        });
        return answers;
    };

    const ruleMatches = (rule, answers) => {
        const answer = answers[rule.field_key] ?? '';
        const expected = String(rule.value ?? '');
        const operator = rule.operator ?? 'equals';

        if (Array.isArray(answer)) {
            if (operator === 'equals') return answer.includes(expected);
            if (operator === 'not_equals') return !answer.includes(expected);
            if (operator === 'contains') return answer.some((item) => String(item).includes(expected));
            return false;
        }

        const answerString = String(answer);
        if (operator === 'equals') return answerString === expected;
        if (operator === 'not_equals') return answerString !== expected;
        if (operator === 'contains') return answerString.includes(expected);
        return false;
    };

    const updateVisibility = () => {
        const answers = getAnswers();

        wrappers.forEach((wrapper) => {
            let rules = [];
            try {
                rules = JSON.parse(wrapper.dataset.conditionalRules || '[]');
            } catch (e) {
                rules = [];
            }

            const visible = !rules.length || rules.every((rule) => ruleMatches(rule, answers));
            wrapper.classList.toggle('field-hidden', !visible);

            wrapper.querySelectorAll('input, select, textarea').forEach((el) => {
                if (!visible) {
                    el.removeAttribute('required');
                }
            });
        });
    };

    form.addEventListener('change', updateVisibility);
    form.addEventListener('input', updateVisibility);
    updateVisibility();
});
</script>
@endpush
