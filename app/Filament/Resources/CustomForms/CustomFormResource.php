<?php

namespace App\Filament\Resources\CustomForms;

use App\Filament\Resources\CustomForms\Pages\CreateCustomForm;
use App\Filament\Resources\CustomForms\Pages\EditCustomForm;
use App\Filament\Resources\CustomForms\Pages\ListCustomForms;
use App\Filament\Resources\CustomForms\RelationManagers\SubmissionsRelationManager;
use App\Filament\Resources\CustomForms\Schemas\CustomFormForm;
use App\Filament\Resources\CustomForms\Tables\CustomFormsTable;
use App\Models\CustomForm;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CustomFormResource extends Resource
{
    protected static ?string $model = CustomForm::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $navigationLabel = 'منشئ النماذج';

    protected static ?string $modelLabel = 'نموذج';

    protected static ?string $pluralModelLabel = 'النماذج';

    protected static string|UnitEnum|null $navigationGroup = 'التسويق';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return CustomFormForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustomFormsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            SubmissionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCustomForms::route('/'),
            'create' => CreateCustomForm::route('/create'),
            'edit' => EditCustomForm::route('/{record}/edit'),
        ];
    }
}
