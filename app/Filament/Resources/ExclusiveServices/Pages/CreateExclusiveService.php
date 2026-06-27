<?php

namespace App\Filament\Resources\ExclusiveServices\Pages;

use App\Filament\Resources\ExclusiveServices\ExclusiveServiceResource;
use App\Filament\Translatable\Actions\LocaleSwitcher;
use App\Filament\Translatable\Resources\Pages\CreateRecord\Concerns\Translatable;
use Filament\Resources\Pages\CreateRecord;

class CreateExclusiveService extends CreateRecord
{
    use Translatable;

    protected static string $resource = ExclusiveServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
