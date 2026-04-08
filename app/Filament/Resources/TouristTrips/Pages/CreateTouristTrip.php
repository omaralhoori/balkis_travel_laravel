<?php

namespace App\Filament\Resources\TouristTrips\Pages;

use App\Filament\Resources\TouristTrips\TouristTripResource;
use App\Filament\Translatable\Actions\LocaleSwitcher;
use App\Filament\Translatable\Resources\Pages\CreateRecord\Concerns\Translatable;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTouristTrip extends CreateRecord
{
    use Translatable;

    protected static string $resource = TouristTripResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
