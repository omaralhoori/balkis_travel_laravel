<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
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

                Section::make('تفاصيل البرنامج')
                    ->schema([
                        Textarea::make('overview')
                            ->label('نظرة عامة على البرنامج')
                            ->rows(4)
                            ->columnSpanFull(),

                        TextInput::make('location')
                            ->label('الموقع')
                            ->maxLength(255)
                            ->nullable()
                            ->placeholder('مثال: إسطنبول، تركيا - منطقة بيليك دوزو'),

                        TextInput::make('area')
                            ->label('المساحة')
                            ->maxLength(255)
                            ->nullable()
                            ->placeholder('مثال: 450 م²'),

                        TextInput::make('rooms')
                            ->label('الغرف')
                            ->maxLength(255)
                            ->nullable()
                            ->placeholder('مثال: 5+2'),

                        TextInput::make('annual_return')
                            ->label('العائد السنوي')
                            ->maxLength(255)
                            ->nullable()
                            ->placeholder('مثال: 8-12%'),

                        Toggle::make('citizenship_eligible')
                            ->label('مؤهل للحصول على الجنسية')
                            ->default(false),

                        TextInput::make('price')
                            ->label('السعر')
                            ->maxLength(255)
                            ->nullable()
                            ->placeholder('مثال: $850,000 USD')
                            ->columnSpanFull(),

                        FileUpload::make('gallery_images')
                            ->label('معرض الصور')
                            ->image()
                            ->disk('public')
                            ->directory('programs/gallery')
                            ->visibility('public')
                            ->multiple()
                            ->maxFiles(10)
                            ->columnSpanFull(),

                        Repeater::make('features')
                            ->label('المزايا الحصرية')
                            ->schema([
                                TextInput::make('icon')
                                    ->label('الأيقونة')
                                    ->placeholder('مثال: verified')
                                    ->helperText('اسم أيقونة Material Symbols')
                                    ->maxLength(255)
                                    ->required(),

                                TextInput::make('title')
                                    ->label('العنوان')
                                    ->maxLength(255)
                                    ->required(),

                                Textarea::make('description')
                                    ->label('الوصف')
                                    ->rows(2)
                                    ->required(),
                            ])
                            ->defaultItems(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'ميزة جديدة')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('خصائص البرنامج السياحي')
                    ->schema([
                        Repeater::make('trip_stages')
                            ->label('مراحل الرحلة')
                            ->schema([
                                TextInput::make('day')
                                    ->label('اليوم/المرحلة')
                                    ->placeholder('مثال: اليوم الأول')
                                    ->maxLength(255)
                                    ->required(),

                                TextInput::make('title')
                                    ->label('عنوان المرحلة')
                                    ->maxLength(255)
                                    ->required(),

                                Textarea::make('description')
                                    ->label('وصف المرحلة')
                                    ->rows(3)
                                    ->required(),
                            ])
                            ->defaultItems(3)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['day'] ?? '').' - '.($state['title'] ?? 'مرحلة جديدة'))
                            ->columnSpanFull(),

                        Repeater::make('includes')
                            ->label('ماذا يشمل البرنامج')
                            ->schema([
                                TextInput::make('item')
                                    ->label('البند')
                                    ->maxLength(255)
                                    ->required()
                                    ->placeholder('مثال: الإقامة في فندق 5 نجوم'),
                            ])
                            ->defaultItems(5)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['item'] ?? 'بند جديد')
                            ->columnSpanFull(),

                        TextInput::make('min_participants')
                            ->label('الحد الأدنى لعدد الأفراد')
                            ->numeric()
                            ->minValue(1)
                            ->nullable()
                            ->placeholder('مثال: 2'),

                        TextInput::make('max_participants')
                            ->label('الحد الأقصى لعدد الأفراد')
                            ->numeric()
                            ->minValue(1)
                            ->nullable()
                            ->placeholder('مثال: 20'),

                        TextInput::make('duration')
                            ->label('مدة الرحلة')
                            ->maxLength(255)
                            ->nullable()
                            ->placeholder('مثال: 7 أيام / 6 ليال')
                            ->columnSpanFull(),

                        TextInput::make('departure_location')
                            ->label('مكان المغادرة')
                            ->maxLength(255)
                            ->nullable()
                            ->placeholder('مثال: مطار إسطنبول الدولي'),

                        TextInput::make('return_location')
                            ->label('مكان العودة')
                            ->maxLength(255)
                            ->nullable()
                            ->placeholder('مثال: مطار إسطنبول الدولي'),

                        TextInput::make('accommodation_type')
                            ->label('نوع الإقامة')
                            ->maxLength(255)
                            ->nullable()
                            ->placeholder('مثال: فندق 5 نجوم، فيلا فاخرة'),

                        TextInput::make('meal_plan')
                            ->label('نوع الوجبات')
                            ->maxLength(255)
                            ->nullable()
                            ->placeholder('مثال: إفطار، نصف إقامة، إقامة كاملة')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
