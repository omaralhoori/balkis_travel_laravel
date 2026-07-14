<?php

namespace Database\Factories;

use App\Models\CustomForm;
use App\Models\FormSubmission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FormSubmission>
 */
class FormSubmissionFactory extends Factory
{
    protected $model = FormSubmission::class;

    public function definition(): array
    {
        return [
            'custom_form_id' => CustomForm::factory(),
            'answers' => [
                'full_name' => fake()->name(),
                'phone' => fake()->phoneNumber(),
            ],
            'ip_address' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
        ];
    }
}
