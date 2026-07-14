<?php

use App\Enums\FormFieldType;
use App\Mail\FormSubmissionNotification;
use App\Models\CustomForm;
use App\Models\FormField;
use App\Models\FormSection;
use App\Models\FormSubmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

it('displays an active custom form', function () {
    $form = CustomForm::factory()->create([
        'slug' => 'family-trip',
        'is_active' => true,
    ]);

    $section = FormSection::factory()->create([
        'custom_form_id' => $form->id,
        'title' => 'معلومات شخصية',
        'order' => 0,
    ]);

    FormField::query()->create([
        'custom_form_id' => $form->id,
        'form_section_id' => $section->id,
        'label' => 'الاسم الكامل',
        'field_key' => 'full_name',
        'type' => FormFieldType::Text,
        'is_required' => true,
        'order' => 0,
    ]);

    $this->get('/ar/forms/family-trip')
        ->assertSuccessful()
        ->assertSee('الاسم الكامل');
});

it('stores a submission and redirects to thank you page', function () {
    Mail::fake();

    $form = CustomForm::factory()->create([
        'slug' => 'booking-form',
        'is_active' => true,
        'whatsapp_message_template' => 'مرحباً {{full_name}}',
    ]);

    $section = FormSection::factory()->create([
        'custom_form_id' => $form->id,
        'title' => 'البيانات',
        'order' => 0,
    ]);

    FormField::query()->create([
        'custom_form_id' => $form->id,
        'form_section_id' => $section->id,
        'label' => 'الاسم',
        'field_key' => 'full_name',
        'type' => FormFieldType::Text,
        'is_required' => true,
        'order' => 0,
    ]);

    $response = $this->post('/ar/forms/booking-form', [
        'answers' => [
            'full_name' => 'أحمد محمد',
        ],
    ]);

    $response->assertRedirect(route('custom_forms.thank_you', ['locale' => 'ar', 'slug' => 'booking-form']));

    $this->assertDatabaseHas(FormSubmission::class, [
        'custom_form_id' => $form->id,
    ]);

    Mail::assertSent(FormSubmissionNotification::class, 2);
});

it('falls back to env default emails when form emails are not set', function () {
    Mail::fake();

    config([
        'mail.form_notifications.default_recipients' => [
            'admin@balkispg.com',
            'sales@balkispg.com',
        ],
    ]);

    $form = CustomForm::factory()->create([
        'slug' => 'fallback-form',
        'is_active' => true,
        'notification_email_primary' => null,
        'notification_email_secondary' => null,
    ]);

    $section = FormSection::factory()->create([
        'custom_form_id' => $form->id,
        'title' => 'البيانات',
        'order' => 0,
    ]);

    FormField::query()->create([
        'custom_form_id' => $form->id,
        'form_section_id' => $section->id,
        'label' => 'الاسم',
        'field_key' => 'full_name',
        'type' => FormFieldType::Text,
        'is_required' => true,
        'order' => 0,
    ]);

    $this->post('/ar/forms/fallback-form', [
        'answers' => [
            'full_name' => 'سارة',
        ],
    ])->assertRedirect();

    Mail::assertSent(FormSubmissionNotification::class, 2);
    Mail::assertSent(FormSubmissionNotification::class, fn (FormSubmissionNotification $mail): bool => $mail->hasTo('admin@balkispg.com'));
    Mail::assertSent(FormSubmissionNotification::class, fn (FormSubmissionNotification $mail): bool => $mail->hasTo('sales@balkispg.com'));
});

it('hides inactive forms', function () {
    CustomForm::factory()->create([
        'slug' => 'hidden-form',
        'is_active' => false,
    ]);

    $this->get('/ar/forms/hidden-form')->assertNotFound();
});
