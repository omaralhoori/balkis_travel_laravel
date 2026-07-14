<?php

namespace App\Services;

use App\Models\CustomForm;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CustomFormSubmissionExporter
{
    public function exportCsv(CustomForm $form): StreamedResponse
    {
        $form->load(['fields' => fn ($query) => $query->orderBy('order')]);

        $filename = 'form-'.$form->slug.'-'.now()->format('Y-m-d').'.csv';

        return response()->streamDownload(function () use ($form): void {
            $handle = fopen('php://output', 'w');

            if ($handle === false) {
                return;
            }

            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            $headers = ['#', __('Submitted at')];
            foreach ($form->fields as $field) {
                $headers[] = $field->label;
            }
            fputcsv($handle, $headers);

            $form->submissions()
                ->orderBy('id')
                ->chunk(100, function ($submissions) use ($handle, $form): void {
                    foreach ($submissions as $submission) {
                        $row = [
                            $submission->id,
                            $submission->created_at?->format('Y-m-d H:i'),
                        ];

                        foreach ($form->fields as $field) {
                            $row[] = $this->formatAnswer($submission->answers[$field->field_key] ?? null);
                        }

                        fputcsv($handle, $row);
                    }
                });

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function formatAnswer(mixed $value): string
    {
        if (is_array($value)) {
            return implode(', ', $value);
        }

        if ($value === null) {
            return '';
        }

        return (string) $value;
    }

    /**
     * @return array<string, string>
     */
    public function labeledAnswers(CustomForm $form, array $answers): array
    {
        $labeled = [];

        foreach ($form->fields as $field) {
            if (! CustomFormFieldLogic::fieldIsVisible($field, $answers)) {
                continue;
            }

            $value = $answers[$field->field_key] ?? null;

            if ($value === null || $value === '' || $value === []) {
                continue;
            }

            $labeled[$field->label] = $this->formatAnswer($value);
        }

        return $labeled;
    }
}
