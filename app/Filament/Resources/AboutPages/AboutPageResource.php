<?php

namespace App\Filament\Resources\AboutPages;

use App\Filament\Resources\AboutPages\Pages\EditAboutPage;
use App\Filament\Resources\AboutPages\Pages\ListAboutPages;
use App\Filament\Resources\AboutPages\Schemas\AboutPageForm;
use App\Filament\Translatable\Resources\Concerns\Translatable;
use App\Models\AboutPage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class AboutPageResource extends Resource
{
    use Translatable;

    protected static ?string $model = AboutPage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInformationCircle;

    protected static ?string $navigationLabel = 'عن المجموعة';

    protected static ?string $modelLabel = 'صفحة عن المجموعة';

    protected static ?string $pluralModelLabel = 'صفحة عن المجموعة';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return 'المحتوى';
    }

    public static function form(Schema $schema): Schema
    {
        return AboutPageForm::configure($schema);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAboutPages::route('/'),
            'edit' => EditAboutPage::route('/edit'),
        ];
    }

    public static function getRecord(): AboutPage
    {
        return AboutPage::getCurrent();
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
