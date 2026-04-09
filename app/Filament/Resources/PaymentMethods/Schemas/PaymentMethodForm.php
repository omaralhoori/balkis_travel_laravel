<?php

namespace App\Filament\Resources\PaymentMethods\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PaymentMethodForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('اسم طريقة الدفع')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('وصف / تفاصيل')
                    ->rows(3)
                    ->columnSpanFull(),
                FileUpload::make('icon')
                    ->label('صورة / لوجو طريقة الدفع')
                    ->image()
                    ->disk('public')
                    ->directory('payment-methods')
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->label('الترتيب')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('تفعيل')
                    ->default(true),
            ]);
    }
}
