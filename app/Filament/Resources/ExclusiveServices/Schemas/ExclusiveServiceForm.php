<?php

namespace App\Filament\Resources\ExclusiveServices\Schemas;

use App\Models\ExclusiveService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class ExclusiveServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('المعلومات الأساسية')
                    ->schema([
                        TextInput::make('title')
                            ->label('العنوان')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state): void {
                                $set('slug', ExclusiveService::makeSlug($state));
                            })
                            ->columnSpanFull(),

                        TextInput::make('slug')
                            ->label('الرابط (Slug)')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('يُستخدم في رابط الصفحة. يُترك فارغاً للإنشاء التلقائي من العنوان.')
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('الوصف')
                            ->rows(4)
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->label('الصورة الرئيسية')
                            ->image()
                            ->disk('public')
                            ->directory('exclusive-services')
                            ->visibility('public')
                            ->imageEditor()
                            ->helperText('تظهر في أعلى صفحة التفاصيل'),

                        FileUpload::make('display_image')
                            ->label('صورة العرض')
                            ->image()
                            ->disk('public')
                            ->directory('exclusive-services')
                            ->visibility('public')
                            ->imageEditor()
                            ->helperText('تظهر في بطاقة الخدمة بالصفحة الرئيسية'),

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

                Section::make('الخدمات')
                    ->schema([
                        Repeater::make('services')
                            ->label('قائمة الخدمات')
                            ->schema([
                                TextInput::make('title')
                                    ->label('عنوان الخدمة')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->label('وصف الخدمة')
                                    ->rows(2)
                                    ->nullable(),
                            ])
                            ->defaultItems(0)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'خدمة جديدة')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }
}
