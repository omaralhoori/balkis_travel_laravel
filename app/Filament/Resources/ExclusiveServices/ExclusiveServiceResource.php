<?php

namespace App\Filament\Resources\ExclusiveServices;

use App\Filament\Resources\ExclusiveServices\Pages\CreateExclusiveService;
use App\Filament\Resources\ExclusiveServices\Pages\EditExclusiveService;
use App\Filament\Resources\ExclusiveServices\Pages\ListExclusiveServices;
use App\Filament\Resources\ExclusiveServices\Schemas\ExclusiveServiceForm;
use App\Filament\Resources\ExclusiveServices\Tables\ExclusiveServicesTable;
use App\Filament\Translatable\Resources\Concerns\Translatable;
use App\Models\ExclusiveService;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExclusiveServiceResource extends Resource
{
    use Translatable;

    protected static ?string $model = ExclusiveService::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ExclusiveServiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExclusiveServicesTable::configure($table);
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
            'index' => ListExclusiveServices::route('/'),
            'create' => CreateExclusiveService::route('/create'),
            'edit' => EditExclusiveService::route('/{record}/edit'),
        ];
    }
}
