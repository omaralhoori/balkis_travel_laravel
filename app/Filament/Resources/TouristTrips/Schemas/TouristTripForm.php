<?php

namespace App\Filament\Resources\TouristTrips\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TouristTripForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('المعلومات الأساسية')
                    ->schema([
                        TextInput::make('title')
                            ->label('عنوان الرحلة')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('وصف مختصر للرحلة')
                            ->rows(4)
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->label('الصورة الرئيسية')
                            ->image()
                            ->disk('public')
                            ->directory('tourist-trips')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull(),

                        FileUpload::make('gallery_images')
                            ->label('معرض الصور')
                            ->image()
                            ->disk('public')
                            ->directory('tourist-trips/gallery')
                            ->visibility('public')
                            ->multiple()
                            ->maxFiles(10)
                            ->columnSpanFull(),

                        TextInput::make('order')
                            ->label('الترتيب')
                            ->required()
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_active')
                            ->label('نشط')
                            ->default(true),
                    ])
                    ->columns(2),

                Section::make('تفاصيل الرحلة')
                    ->schema([
                        TextInput::make('location')
                            ->label('الوجهة / الموقع')
                            ->maxLength(255)
                            ->nullable()
                            ->placeholder('مثال: إسطنبول، تركيا'),

                        TextInput::make('duration')
                            ->label('مدة الرحلة')
                            ->maxLength(255)
                            ->nullable()
                            ->placeholder('مثال: يوم كامل / 8 ساعات'),

                        TextInput::make('meeting_point')
                            ->label('نقطة الانطلاق')
                            ->maxLength(255)
                            ->nullable()
                            ->placeholder('مثال: أمام الفندق'),

                        TextInput::make('price')
                            ->label('السعر')
                            ->maxLength(255)
                            ->nullable()
                            ->placeholder('مثال: $150 للشخص'),

                        RichEditor::make('includes')
                            ->label('ماذا تتضمن الرحلة')
                            ->default(null)
                            ->columnSpanFull(),

                        RichEditor::make('what_to_bring')
                            ->label('ماذا يجب أن تفعل / ماذا تحضر')
                            ->default(null)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('البرنامج والمعالم')
                    ->schema([
                        Repeater::make('highlights')
                            ->label('أبرز معالم الرحلة')
                            ->schema([
                                TextInput::make('item')
                                    ->label('المعلم')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('مثال: زيارة مضيق البوسفور'),
                            ])
                            ->defaultItems(0)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['item'] ?? 'معلم جديد')
                            ->columnSpanFull(),

                        Repeater::make('itinerary')
                            ->label('برنامج الرحلة')
                            ->schema([
                                TextInput::make('time')
                                    ->label('الوقت / المرحلة')
                                    ->maxLength(255)
                                    ->nullable()
                                    ->placeholder('مثال: 09:00 صباحاً'),

                                TextInput::make('title')
                                    ->label('العنوان')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->label('الوصف')
                                    ->rows(2)
                                    ->nullable(),
                            ])
                            ->defaultItems(0)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'مرحلة جديدة')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }
}
