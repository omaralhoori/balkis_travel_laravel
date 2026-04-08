<?php

namespace App\Filament\Resources\TouristTrips\Pages;

use App\Filament\Resources\TouristTrips\TouristTripResource;
use App\Filament\Translatable\Actions\LocaleSwitcher;
use App\Filament\Translatable\Resources\Pages\ListRecords\Concerns\Translatable;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTouristTrips extends ListRecords
{
    use Translatable;

    protected static string $resource = TouristTripResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
