<?php

namespace App\Mail;

use App\Models\CustomForm;
use App\Models\FormSubmission;
use App\Services\CustomFormSubmissionExporter;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FormSubmissionNotification extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var array<string, string>
     */
    public array $labeledAnswers;

    public function __construct(
        public CustomForm $form,
        public FormSubmission $submission,
    ) {
        $this->labeledAnswers = app(CustomFormSubmissionExporter::class)
            ->labeledAnswers($form, $submission->answers);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'إرسال جديد: '.$this->form->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.form-submission',
        );
    }
}
