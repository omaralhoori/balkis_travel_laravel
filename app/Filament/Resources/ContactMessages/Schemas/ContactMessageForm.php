<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('معلومات المرسل')
                    ->schema([
                        TextInput::make('name')
                            ->label('الاسم')
                            ->disabled()
                            ->dehydrated(),

                        TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->disabled()
                            ->dehydrated()
                            ->copyable(),

                        TextInput::make('phone')
                            ->label('رقم الهاتف')
                            ->disabled()
                            ->dehydrated()
                            ->copyable(),
                    ])
                    ->columns(3),

                Section::make('الرسالة')
                    ->schema([
                        Textarea::make('message')
                            ->label('الرسالة')
                            ->rows(6)
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull(),
                    ]),

                Section::make('الحالة')
                    ->schema([
                        Toggle::make('is_read')
                            ->label('تمت القراءة')
                            ->default(false)
                            ->afterStateUpdated(function ($record, $state) {
                                if ($state && ! $record->read_at) {
                                    $record->update(['read_at' => now()]);
                                }
                            }),
                    ]),
            ]);
    }
}
