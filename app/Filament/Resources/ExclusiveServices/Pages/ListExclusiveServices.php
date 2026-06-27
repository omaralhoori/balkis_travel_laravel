<?php

namespace App\Filament\Resources\ExclusiveServices\Pages;

use App\Filament\Resources\ExclusiveServices\ExclusiveServiceResource;
use App\Filament\Translatable\Actions\LocaleSwitcher;
use App\Filament\Translatable\Resources\Pages\ListRecords\Concerns\Translatable;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExclusiveServices extends ListRecords
{
    use Translatable;

    protected static string $resource = ExclusiveServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
