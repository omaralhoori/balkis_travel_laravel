<?php

namespace App\Filament\Resources\CustomForms\Pages;

use App\Filament\Resources\CustomForms\CustomFormResource;
use App\Services\CustomFormSubmissionExporter;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;

class EditCustomForm extends EditRecord
{
    protected static string $resource = CustomFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('copyLink')
                ->label('نسخ رابط النموذج')
                ->icon(Heroicon::OutlinedLink)
                ->action(function (): void {
                    $url = $this->record->publicUrl();
                    $this->js('navigator.clipboard.writeText('.json_encode($url).');');
                }),

            Action::make('preview')
                ->label('معاينة النموذج')
                ->icon(Heroicon::OutlinedEye)
                ->url(fn () => $this->record->publicUrl())
                ->openUrlInNewTab(),

            Action::make('exportSubmissions')
                ->label('تصدير الإرسالات')
                ->icon(Heroicon::OutlinedArrowDownTray)
                ->action(fn () => app(CustomFormSubmissionExporter::class)->exportCsv($this->record)),

            DeleteAction::make(),
        ];
    }
}
