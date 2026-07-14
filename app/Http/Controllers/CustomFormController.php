<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomFormSubmissionRequest;
use App\Mail\FormSubmissionNotification;
use App\Models\CustomForm;
use App\Models\FormSubmission;
use App\Models\WhatsAppNumber;
use App\Services\CustomFormSubmissionExporter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CustomFormController extends Controller
{
    public function show(string $locale, string $slug): View
    {
        $form = CustomForm::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with(['sections.fields' => fn ($query) => $query->orderBy('order')])
            ->firstOrFail();

        return view('custom_forms.show', [
            'form' => $form,
        ]);
    }

    public function store(StoreCustomFormSubmissionRequest $request, string $locale, string $slug): RedirectResponse
    {
        $form = CustomForm::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with('fields')
            ->firstOrFail();

        $answers = $request->validated('answers');

        $submission = FormSubmission::query()->create([
            'custom_form_id' => $form->id,
            'answers' => $answers,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $this->sendNotifications($form, $submission);

        $request->session()->put('custom_form_submission_id', $submission->id);

        return redirect()->route('custom_forms.thank_you', [
            'locale' => $locale,
            'slug' => $form->slug,
        ]);
    }

    public function thankYou(Request $request, string $locale, string $slug): View
    {
        $form = CustomForm::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $submissionId = $request->session()->pull('custom_form_submission_id');
        $submission = $submissionId
            ? FormSubmission::query()->whereKey($submissionId)->where('custom_form_id', $form->id)->first()
            : null;

        $whatsappUrl = null;

        if ($submission) {
            $message = $form->buildWhatsAppMessage($submission->answers);
            $whatsappNumber = $this->resolveWhatsAppNumber();
            $whatsappUrl = $whatsappNumber?->getWhatsAppUrl($message);
        }

        return view('custom_forms.thank_you', [
            'form' => $form,
            'submission' => $submission,
            'whatsappUrl' => $whatsappUrl,
        ]);
    }

    public function report(CustomForm $customForm): View
    {
        abort_unless(auth()->check(), 403);

        $customForm->load([
            'fields',
            'submissions' => fn ($query) => $query->latest()->limit(500),
        ]);

        return view('custom_forms.report', [
            'form' => $customForm,
        ]);
    }

    public function exportReport(CustomForm $customForm, CustomFormSubmissionExporter $exporter): StreamedResponse
    {
        abort_unless(auth()->check(), 403);

        return $exporter->exportCsv($customForm);
    }

    protected function sendNotifications(CustomForm $form, FormSubmission $submission): void
    {
        $recipients = array_filter([
            $form->notification_email_primary,
            $form->notification_email_secondary,
        ]);

        if ($recipients === []) {
            return;
        }

        foreach ($recipients as $email) {
            Mail::to($email)->send(new FormSubmissionNotification($form, $submission));
        }
    }

    protected function resolveWhatsAppNumber(): ?WhatsAppNumber
    {
        $whatsappNumbers = WhatsAppNumber::getActiveNumbers();

        if ($whatsappNumbers->isEmpty()) {
            return null;
        }

        $lastIndex = Cache::get('whatsapp_last_index', 0);
        $nextIndex = ($lastIndex + 1) % $whatsappNumbers->count();
        Cache::forever('whatsapp_last_index', $nextIndex);

        return $whatsappNumbers->get($nextIndex);
    }
}
