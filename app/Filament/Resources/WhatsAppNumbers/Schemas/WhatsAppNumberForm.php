<?php

namespace App\Filament\Resources\WhatsAppNumbers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WhatsAppNumberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('معلومات الرقم')
                    ->schema([
                        TextInput::make('number')
                            ->label('رقم الواتساب')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('مثال: +905551234567 أو 905551234567')
                            ->helperText('أدخل رقم الواتساب مع رمز الدولة (بدون مسافات أو شرطات)'),

                        TextInput::make('name')
                            ->label('اسم الرقم (اختياري)')
                            ->maxLength(255)
                            ->placeholder('مثال: رقم المبيعات الرئيسي')
                            ->helperText('اسم وصفي للرقم للمساعدة في التعرف عليه'),

                        TextInput::make('order')
                            ->label('الترتيب')
                            ->numeric()
                            ->default(0)
                            ->required()
                            ->helperText('الترتيب الذي سيظهر به الرقم في الدوران (الأقل = الأول)'),

                        Toggle::make('is_active')
                            ->label('نشط')
                            ->default(true)
                            ->helperText('فقط الأرقام النشطة سيتم استخدامها في الدوران'),
                    ])
                    ->columns(2),
            ]);
    }
}
