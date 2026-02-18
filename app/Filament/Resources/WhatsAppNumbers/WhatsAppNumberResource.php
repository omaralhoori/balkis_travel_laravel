<?php

namespace App\Filament\Resources\WhatsAppNumbers;

use App\Filament\Resources\WhatsAppNumbers\Pages\CreateWhatsAppNumber;
use App\Filament\Resources\WhatsAppNumbers\Pages\EditWhatsAppNumber;
use App\Filament\Resources\WhatsAppNumbers\Pages\ListWhatsAppNumbers;
use App\Filament\Resources\WhatsAppNumbers\Schemas\WhatsAppNumberForm;
use App\Filament\Resources\WhatsAppNumbers\Tables\WhatsAppNumbersTable;
use App\Models\WhatsAppNumber;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WhatsAppNumberResource extends Resource
{
    protected static ?string $model = WhatsAppNumber::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhone;

    protected static ?string $navigationLabel = 'أرقام الواتساب';

    protected static ?string $modelLabel = 'رقم واتساب';

    protected static ?string $pluralModelLabel = 'أرقام الواتساب';

    protected static ?int $navigationSort = 10;

    public static function getNavigationGroup(): ?string
    {
        return 'الإعدادات';
    }

    public static function form(Schema $schema): Schema
    {
        return WhatsAppNumberForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WhatsAppNumbersTable::configure($table);
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
            'index' => ListWhatsAppNumbers::route('/'),
            'create' => CreateWhatsAppNumber::route('/create'),
            'edit' => EditWhatsAppNumber::route('/{record}/edit'),
        ];
    }
}
