<?php

namespace App\Filament\Resources\AboutPages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AboutPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('قسم Hero')
                    ->schema([
                        Toggle::make('is_hero_visible')
                            ->label('إظهار القسم')
                            ->default(true)
                            ->columnSpanFull(),

                        TextInput::make('hero_title')
                            ->label('العنوان الرئيسي')
                            ->required()
                            ->maxLength(255)
                            ->default('التميز في كل تفصيل'),

                        TextInput::make('hero_title_highlight')
                            ->label('الكلمة المميزة في العنوان')
                            ->required()
                            ->maxLength(255)
                            ->default('التميز'),

                        Textarea::make('hero_description')
                            ->label('الوصف')
                            ->rows(3)
                            ->columnSpanFull(),

                        FileUpload::make('hero_background_image')
                            ->label('صورة الخلفية')
                            ->image()
                            ->disk('public')
                            ->directory('about-page')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('الرؤية والرسالة')
                    ->schema([
                        Toggle::make('is_vision_mission_visible')
                            ->label('إظهار القسم')
                            ->default(true)
                            ->columnSpanFull(),

                        TextInput::make('vision_icon')
                            ->label('أيقونة الرؤية (Material Icons)')
                            ->maxLength(255)
                            ->default('visibility'),

                        TextInput::make('vision_title')
                            ->label('عنوان الرؤية')
                            ->required()
                            ->maxLength(255)
                            ->default('رؤيتنا'),

                        Textarea::make('vision_description')
                            ->label('وصف الرؤية')
                            ->rows(4)
                            ->columnSpanFull(),

                        TextInput::make('mission_icon')
                            ->label('أيقونة الرسالة (Material Icons)')
                            ->maxLength(255)
                            ->default('rocket_launch'),

                        TextInput::make('mission_title')
                            ->label('عنوان الرسالة')
                            ->required()
                            ->maxLength(255)
                            ->default('رسالتنا'),

                        Textarea::make('mission_description')
                            ->label('وصف الرسالة')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('المسيرة الزمنية')
                    ->schema([
                        Toggle::make('is_timeline_visible')
                            ->label('إظهار القسم')
                            ->default(true)
                            ->columnSpanFull(),

                        TextInput::make('timeline_badge')
                            ->label('شارة القسم')
                            ->maxLength(255)
                            ->default('مسيرتنا'),

                        TextInput::make('timeline_title')
                            ->label('عنوان القسم')
                            ->required()
                            ->maxLength(255)
                            ->default('تاريخ حافل بالنجاحات')
                            ->columnSpanFull(),

                        Repeater::make('timeline_items')
                            ->label('عناصر المسيرة')
                            ->schema([
                                TextInput::make('year')
                                    ->label('السنة')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('title')
                                    ->label('العنوان')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->label('الوصف')
                                    ->rows(2)
                                    ->columnSpanFull(),

                                Select::make('position')
                                    ->label('الموضع')
                                    ->options([
                                        'left' => 'يسار',
                                        'right' => 'يمين',
                                    ])
                                    ->default('left')
                                    ->required(),
                            ])
                            ->defaultItems(4)
                            ->columns(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['year'] ?? '') . ' - ' . ($state['title'] ?? ''))
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('القيم الجوهرية')
                    ->schema([
                        Toggle::make('is_values_visible')
                            ->label('إظهار القسم')
                            ->default(true)
                            ->columnSpanFull(),

                        TextInput::make('values_title')
                            ->label('عنوان القسم')
                            ->required()
                            ->maxLength(255)
                            ->default('قيمنا الجوهرية')
                            ->columnSpanFull(),

                        Repeater::make('core_values')
                            ->label('القيم')
                            ->schema([
                                TextInput::make('icon')
                                    ->label('الأيقونة (Material Icons)')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('title')
                                    ->label('العنوان')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->label('الوصف')
                                    ->rows(2)
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                            ->defaultItems(4)
                            ->columns(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('فريق العمل')
                    ->schema([
                        Toggle::make('is_team_visible')
                            ->label('إظهار القسم')
                            ->default(true)
                            ->columnSpanFull(),

                        TextInput::make('team_badge')
                            ->label('شارة القسم')
                            ->maxLength(255)
                            ->default('فريق العمل'),

                        TextInput::make('team_title')
                            ->label('عنوان القسم')
                            ->required()
                            ->maxLength(255)
                            ->default('القيادة التنفيذية')
                            ->columnSpanFull(),

                        Repeater::make('team_members')
                            ->label('أعضاء الفريق')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('الصورة')
                                    ->image()
                                    ->disk('public')
                                    ->directory('about-page/team')
                                    ->visibility('public')
                                    ->columnSpanFull(),

                                TextInput::make('name')
                                    ->label('الاسم')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('position')
                                    ->label('المنصب')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                            ])
                            ->defaultItems(3)
                            ->columns(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('الالتزام المهني')
                    ->schema([
                        Toggle::make('is_commitment_visible')
                            ->label('إظهار القسم')
                            ->default(true)
                            ->columnSpanFull(),

                        TextInput::make('commitment_badge')
                            ->label('شارة القسم')
                            ->maxLength(255)
                            ->default('الالتزام المهني'),

                        TextInput::make('commitment_title')
                            ->label('العنوان الرئيسي')
                            ->required()
                            ->maxLength(255)
                            ->default('معاييرنا هي'),

                        TextInput::make('commitment_title_highlight')
                            ->label('الكلمة المميزة')
                            ->required()
                            ->maxLength(255)
                            ->default('ميثاق شرفنا'),

                        Textarea::make('commitment_description')
                            ->label('الوصف')
                            ->rows(3)
                            ->columnSpanFull(),

                        Repeater::make('commitment_sections')
                            ->label('أقسام الالتزام')
                            ->schema([
                                TextInput::make('icon')
                                    ->label('الأيقونة (Material Icons)')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('title')
                                    ->label('العنوان')
                                    ->required()
                                    ->maxLength(255),

                                Repeater::make('items')
                                    ->label('النقاط')
                                    ->schema([
                                        Textarea::make('text')
                                            ->label('النص')
                                            ->required()
                                            ->rows(2)
                                            ->columnSpanFull(),
                                    ])
                                    ->defaultItems(3)
                                    ->afterStateHydrated(function ($component, $state) {
                                        if ($state === null || !is_array($state)) {
                                            $component->state([]);
                                        }
                                    })
                                    ->columnSpanFull(),
                            ])
                            ->defaultItems(4)
                            ->columns(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->afterStateHydrated(function ($component, $state) {
                                if ($state === null) {
                                    $component->state([]);
                                } elseif (is_array($state)) {
                                    foreach ($state as $index => $item) {
                                        if (!isset($item['items']) || $item['items'] === null) {
                                            $state[$index]['items'] = [];
                                        }
                                    }
                                    $component->state($state);
                                }
                            })
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('الامتثال القانوني')
                    ->schema([
                        Toggle::make('is_compliance_visible')
                            ->label('إظهار قسم الامتثال')
                            ->default(true)
                            ->columnSpanFull(),

                        TextInput::make('compliance_title')
                            ->label('عنوان القسم')
                            ->required()
                            ->maxLength(255)
                            ->default('الامتثال القانوني والتنظيمي')
                            ->columnSpanFull(),

                        Textarea::make('compliance_description')
                            ->label('الوصف')
                            ->rows(4)
                            ->columnSpanFull(),

                        TextInput::make('compliance_email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->default('compliance@balkispremium.com'),

                        Toggle::make('is_contact_visible')
                            ->label('إظهار قسم الاتصال')
                            ->default(true)
                            ->columnSpanFull(),

                        TextInput::make('contact_question')
                            ->label('سؤال الاتصال')
                            ->required()
                            ->maxLength(255)
                            ->default('هل لديك استفسار حول سياساتنا؟')
                            ->columnSpanFull(),

                        Textarea::make('contact_description')
                            ->label('وصف الاتصال')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
