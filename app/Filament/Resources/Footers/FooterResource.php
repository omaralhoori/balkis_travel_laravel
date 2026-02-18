<?php

namespace App\Filament\Resources\Footers;

use App\Filament\Resources\Footers\Pages\EditFooter;
use App\Filament\Resources\Footers\Pages\ListFooters;
use App\Filament\Resources\Footers\Schemas\FooterForm;
use App\Filament\Translatable\Resources\Concerns\Translatable;
use App\Models\HomePage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class FooterResource extends Resource
{
    use Translatable;
    protected static ?string $model = HomePage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'التذييل';

    protected static ?string $modelLabel = 'التذييل';

    protected static ?string $pluralModelLabel = 'التذييل';

    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
    {
        return 'المحتوى';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function form(Schema $schema): Schema
    {
        return FooterForm::configure($schema);
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
            'index' => ListFooters::route('/'),
            'edit' => EditFooter::route('/{record}/edit'),
        ];
    }

    public static function getRecord(): HomePage
    {
        return HomePage::getCurrent();
    }

    public static function getIndexUrl(array $parameters = [], bool $isAbsolute = true, ?string $panel = null, ?\Illuminate\Database\Eloquent\Model $tenant = null, bool $shouldGuessMissingParameters = false): string
    {
        $homePage = HomePage::getCurrent();

        return static::getUrl('edit', ['record' => $homePage->getKey()], $isAbsolute, $panel, $tenant, $shouldGuessMissingParameters);
    }
}
