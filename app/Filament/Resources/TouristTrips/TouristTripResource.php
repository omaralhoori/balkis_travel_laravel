<?php

namespace App\Filament\Resources\TouristTrips;

use App\Filament\Resources\TouristTrips\Pages\CreateTouristTrip;
use App\Filament\Resources\TouristTrips\Pages\EditTouristTrip;
use App\Filament\Resources\TouristTrips\Pages\ListTouristTrips;
use App\Filament\Resources\TouristTrips\Schemas\TouristTripForm;
use App\Filament\Resources\TouristTrips\Tables\TouristTripsTable;
use App\Models\TouristTrip;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Translatable\Resources\Concerns\Translatable;

class TouristTripResource extends Resource
{
    use Translatable;

    protected static ?string $model = TouristTrip::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return TouristTripForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TouristTripsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTouristTrips::route('/'),
            'create' => CreateTouristTrip::route('/create'),
            'edit' => EditTouristTrip::route('/{record}/edit'),
        ];
    }
}
