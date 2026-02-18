<?php

namespace App\Filament\Resources\HomePages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HomePageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('المحتوى الرئيسي')
                    ->schema([
                        TextInput::make('main_title')
                            ->label('العنوان')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('main_description')
                            ->label('الوصف')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),

                        FileUpload::make('main_background_image')
                            ->label('الصورة الرئيسية')
                            ->image()
                            ->disk('public')
                            ->directory('home-page')
                            ->visibility('public')
                            ->columnSpanFull(),

                        Repeater::make('destinations')
                            ->label('الوجهات المتاحة')
                            ->schema([
                                TextInput::make('name')
                                    ->label('اسم الوجهة')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('مثال: اسطنبول')
                                    ->helperText('اسم المدينة أو الوجهة السياحية'),
                            ])
                            ->defaultItems(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'وجهة جديدة')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
