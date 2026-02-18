<?php

namespace App\Filament\Resources\ContactMessages\Pages;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactMessage extends EditRecord
{
    protected static string $resource = ContactMessageResource::class;

    protected static ?string $title = 'عرض رسالة التواصل';

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('حذف'),
        ];
    }

    public function mount(int|string $record): void
    {
        parent::mount($record);

        // Mark as read when viewing
        $this->record->update([
            'is_read' => true,
            'read_at' => $this->record->read_at ?? now(),
        ]);
    }
}
