<?php

namespace App\Filament\Resources\HomePages;

use App\Filament\Resources\HomePages\Pages\EditHomePage;
use App\Filament\Resources\HomePages\Schemas\HomePageForm;
use App\Filament\Translatable\Resources\Concerns\Translatable;
use App\Models\HomePage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class HomePageResource extends Resource
{
    use Translatable;

    protected static ?string $model = HomePage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?string $navigationLabel = 'الصفحة الرئيسية';

    protected static ?string $modelLabel = 'الصفحة الرئيسية';

    protected static ?string $pluralModelLabel = 'الصفحة الرئيسية';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return 'المحتوى';
    }

    public static function form(Schema $schema): Schema
    {
        return HomePageForm::configure($schema);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\HomePages\Pages\ListHomePage::route('/'),
            'edit' => EditHomePage::route('/edit'),
        ];
    }

    public static function getRecord(): HomePage
    {
        return HomePage::getCurrent();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function getIndexUrl(array $parameters = [], bool $isAbsolute = true, ?string $panel = null, ?\Illuminate\Database\Eloquent\Model $tenant = null, bool $shouldGuessMissingParameters = false): string
    {
        return static::getUrl('edit', $parameters, $isAbsolute, $panel, $tenant, $shouldGuessMissingParameters);
    }
}
