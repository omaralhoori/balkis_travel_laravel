<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'selected_destinations' => ['nullable', 'string'],
            'adults' => ['required', 'integer', 'min:0', 'max:40'],
            'children' => ['required', 'integer', 'min:0', 'max:20'],
            'arrival_date' => ['required', 'date', 'after_or_equal:today'],
            'departure_date' => ['required', 'date', 'after:arrival_date'],
            'services' => ['nullable'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'adults.required' => __('Number of adults is required'),
            'adults.integer' => __('Number of adults must be a number'),
            'adults.min' => __('Number of adults must be at least 0'),
            'adults.max' => __('Number of adults must not exceed 40'),
            'children.required' => __('Number of children is required'),
            'children.integer' => __('Number of children must be a number'),
            'children.min' => __('Number of children must be at least 0'),
            'children.max' => __('Number of children must not exceed 20'),
            'arrival_date.required' => __('Arrival date is required'),
            'arrival_date.date' => __('Arrival date must be a valid date'),
            'arrival_date.after_or_equal' => __('Arrival date must be today or later'),
            'departure_date.required' => __('Departure date is required'),
            'departure_date.date' => __('Departure date must be a valid date'),
            'departure_date.after' => __('Departure date must be after arrival date'),
        ];
    }
}
