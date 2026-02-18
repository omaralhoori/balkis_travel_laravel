<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('معلومات البرنامج')
                    ->schema([
                        TextInput::make('title')
                            ->label('عنوان البرنامج')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('الوصف')
                            ->rows(4)
                            ->columnSpanFull(),

                        Select::make('category')
                            ->label('الفئة')
                            ->options([
                                'برنامج استثماري' => 'برنامج استثماري',
                                'سياحة فاخرة' => 'سياحة فاخرة',
                                'الجنسية التركية' => 'الجنسية التركية',
                                'عقارات تجارية' => 'عقارات تجارية',
                            ])
                            ->required()
                            ->searchable(),

                        TextInput::make('category_icon')
                            ->label('أيقونة الفئة')
                            ->placeholder('مثال: workspace_premium')
                            ->helperText('اسم أيقونة Material Symbols')
                            ->maxLength(255)
                            ->nullable(),

                        FileUpload::make('image')
                            ->label('صورة البرنامج')
                            ->image()
                            ->disk('public')
                            ->directory('programs/images')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '16:9',
                                '4:3',
                            ])
                            ->columnSpanFull()
                            ->required(),

                        TextInput::make('url')
                            ->label('رابط البرنامج')
                            ->url()
                            ->maxLength(255)
                            ->nullable()
                            ->columnSpanFull(),

                        TextInput::make('order')
                            ->label('الترتيب')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('نشط')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
