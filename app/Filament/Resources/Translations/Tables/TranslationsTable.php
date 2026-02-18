<?php

namespace App\Filament\Resources\Translations\Tables;

use App\Models\AboutPage;
use App\Models\BlogPost;
use App\Models\HomePage;
use App\Models\HomePageService;
use App\Models\Program;
use App\Models\Testimonial;
use App\Models\Translation;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TranslationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('translatable_type')
                    ->label('النموذج')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        HomePage::class => 'الصفحة الرئيسية',
                        HomePageService::class => 'خدمة الصفحة الرئيسية',
                        BlogPost::class => 'مقال',
                        Program::class => 'برنامج',
                        AboutPage::class => 'صفحة عن المجموعة',
                        Testimonial::class => 'شهادة',
                        default => class_basename($state),
                    })
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('translatable_id')
                    ->label('السجل')
                    ->formatStateUsing(function ($record) {
                        $model = $record->translatable;
                        if (! $model) {
                            return "ID: {$record->translatable_id}";
                        }

                        return match (get_class($model)) {
                            HomePage::class => '#'.$record->translatable_id.' - '.($model->getRawOriginal('main_title') ?? $model->attributes['main_title'] ?? 'الصفحة الرئيسية'),
                            HomePageService::class => '#'.$record->translatable_id.' - '.($model->getRawOriginal('title') ?? $model->attributes['title'] ?? '-').($model->service_key ? ' ('.$model->service_key.')' : ''),
                            BlogPost::class => '#'.$record->translatable_id.' - '.($model->getRawOriginal('title') ?? $model->attributes['title'] ?? '-').($model->getRawOriginal('category') ? ' ['.$model->getRawOriginal('category').']' : ''),
                            Program::class => '#'.$record->translatable_id.' - '.($model->getRawOriginal('title') ?? $model->attributes['title'] ?? '-').($model->getRawOriginal('category') ? ' ['.$model->getRawOriginal('category').']' : ''),
                            AboutPage::class => '#'.$record->translatable_id.' - '.($model->getRawOriginal('hero_title') ?? $model->attributes['hero_title'] ?? '-'),
                            Testimonial::class => '#'.$record->translatable_id.' - '.($model->getRawOriginal('name') ?? $model->attributes['name'] ?? '-').($model->getRawOriginal('position') ? ' ('.$model->getRawOriginal('position').')' : ''),
                            default => "ID: {$record->translatable_id}",
                        };
                    })
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('locale')
                    ->label('اللغة')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'ar' => 'العربية',
                        'en' => 'English',
                        'tr' => 'Türkçe',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'ar' => 'success',
                        'en' => 'info',
                        'tr' => 'warning',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),

                TextColumn::make('field')
                    ->label('الحقل')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('value')
                    ->label('القيمة المترجمة')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->value)
                    ->searchable()
                    ->wrap(),

                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('تاريخ التحديث')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('translatable_type')
                    ->label('النموذج')
                    ->options([
                        HomePage::class => 'الصفحة الرئيسية',
                        HomePageService::class => 'خدمة الصفحة الرئيسية',
                        BlogPost::class => 'مقال',
                        Program::class => 'برنامج',
                        AboutPage::class => 'صفحة عن المجموعة',
                        Testimonial::class => 'شهادة',
                    ])
                    ->searchable(),

                SelectFilter::make('locale')
                    ->label('اللغة')
                    ->options([
                        'ar' => 'العربية',
                        'en' => 'English',
                        'tr' => 'Türkçe',
                    ])
                    ->searchable(),

                SelectFilter::make('field')
                    ->label('الحقل')
                    ->options(function () {
                        return Translation::query()
                            ->distinct()
                            ->pluck('field', 'field')
                            ->toArray();
                    })
                    ->searchable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
