<?php

namespace App\Services;

use App\Mail\FormSubmissionNotification;
use App\Models\CustomForm;
use App\Models\FormSubmission;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FormSubmissionNotifier
{
    public function notify(CustomForm $form, FormSubmission $submission): void
    {
        $recipients = $form->notificationRecipients();

        if ($recipients === []) {
            Log::warning('Form submission notification skipped: no recipients configured.', [
                'form_id' => $form->id,
                'form_slug' => $form->slug,
                'submission_id' => $submission->id,
            ]);

            return;
        }

        $mailable = new FormSubmissionNotification($form, $submission);

        foreach ($recipients as $email) {
            Mail::to($email)->send($mailable);
        }
    }
}
