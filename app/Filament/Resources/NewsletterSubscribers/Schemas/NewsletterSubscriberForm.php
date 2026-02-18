<?php

namespace App\Filament\Resources\NewsletterSubscribers\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NewsletterSubscriberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('معلومات المشترك')
                    ->schema([
                        TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('name')
                            ->label('الاسم')
                            ->maxLength(255)
                            ->nullable()
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('نشط')
                            ->default(true)
                            ->helperText('المشترك النشط سيستلم النشرة البريدية'),

                        DateTimePicker::make('subscribed_at')
                            ->label('تاريخ الاشتراك')
                            ->default(now())
                            ->required()
                            ->displayFormat('d/m/Y H:i')
                            ->native(false),

                        DateTimePicker::make('unsubscribed_at')
                            ->label('تاريخ إلغاء الاشتراك')
                            ->nullable()
                            ->displayFormat('d/m/Y H:i')
                            ->native(false),
                    ])
                    ->columns(2),
            ]);
    }
}
