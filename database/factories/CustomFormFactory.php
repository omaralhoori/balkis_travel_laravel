<?php

namespace Database\Factories;

use App\Models\CustomForm;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CustomForm>
 */
class CustomFormFactory extends Factory
{
    protected $model = CustomForm::class;

    public function definition(): array
    {
        $title = fake()->sentence(3);

        return [
            'title' => $title,
            'slug' => CustomForm::makeSlug($title),
            'description' => fake()->paragraph(),
            'primary_color' => '#C6A264',
            'button_color' => '#765C39',
            'text_color' => '#4A566C',
            'thank_you_title' => 'شكراً لك!',
            'thank_you_message' => 'تم استلام طلبك بنجاح.',
            'whatsapp_button_label' => 'تواصل معنا عبر واتساب',
            'whatsapp_message_template' => 'مرحباً، اسمي {{full_name}}',
            'notification_email_primary' => fake()->safeEmail(),
            'notification_email_secondary' => fake()->safeEmail(),
            'is_active' => true,
        ];
    }
}
