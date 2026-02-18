<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('معلومات العميل')
                    ->schema([
                        TextInput::make('name')
                            ->label('الاسم')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('position')
                            ->label('المنصب')
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('company')
                            ->label('الشركة')
                            ->maxLength(255)
                            ->nullable(),

                        FileUpload::make('avatar')
                            ->label('صورة العميل')
                            ->image()
                            ->disk('public')
                            ->directory('testimonials/avatars')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull()
                            ->nullable(),
                    ])
                    ->columns(2),

                Section::make('التعليق والتقييم')
                    ->schema([
                        Textarea::make('testimonial')
                            ->label('التعليق')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        Select::make('rating')
                            ->label('التقييم')
                            ->options([
                                1 => '⭐ (1 نجمة)',
                                2 => '⭐⭐ (2 نجمتين)',
                                3 => '⭐⭐⭐ (3 نجوم)',
                                4 => '⭐⭐⭐⭐ (4 نجوم)',
                                5 => '⭐⭐⭐⭐⭐ (5 نجوم)',
                            ])
                            ->default(5)
                            ->required(),

                        TextInput::make('order')
                            ->label('الترتيب')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('نشط')
                            ->default(true),
                    ])
                    ->columns(3),
            ]);
    }
}
