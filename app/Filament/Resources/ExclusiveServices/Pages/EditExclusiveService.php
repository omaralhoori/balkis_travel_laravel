<?php

namespace App\Filament\Resources\ExclusiveServices\Pages;

use App\Filament\Resources\ExclusiveServices\ExclusiveServiceResource;
use App\Filament\Translatable\Actions\LocaleSwitcher;
use App\Filament\Translatable\Resources\Pages\EditRecord\Concerns\Translatable;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExclusiveService extends EditRecord
{
    use Translatable;

    protected static string $resource = ExclusiveServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
