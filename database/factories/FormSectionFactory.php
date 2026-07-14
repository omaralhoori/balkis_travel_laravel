<?php

namespace Database\Factories;

use App\Models\CustomForm;
use App\Models\FormSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FormSection>
 */
class FormSectionFactory extends Factory
{
    protected $model = FormSection::class;

    public function definition(): array
    {
        return [
            'custom_form_id' => CustomForm::factory(),
            'title' => fake()->words(2, true),
            'order' => 0,
        ];
    }
}
