<?php

namespace App\Filament\Resources\Accommodations\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

class AccommodationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->translateLabel(),
                    
                TextInput::make('city')
                    ->required()
                    ->maxLength(255)
                    ->translateLabel(),

                Select::make('type')
                    ->options([
                        'hotel' => __('Hotel'),
                        'hotel_apartment' => __('Hotel Apartment'),
                        'cottage' => __('Cottage'),
                    ])
                    ->required()
                    ->translateLabel(),

                TextInput::make('rating')
                    ->numeric()
                    ->default(5.0)
                    ->minValue(1)
                    ->maxValue(5)
                    ->step(0.1)
                    ->required()
                    ->translateLabel(),

                RichEditor::make('description')
                    ->columnSpanFull()
                    ->translateLabel(),

                FileUpload::make('images')
                    ->multiple()
                    ->image()
                    ->disk('public')
                    ->directory('accommodations')
                    ->columnSpanFull()
                    ->translateLabel(),

                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->translateLabel(),

                Toggle::make('is_active')
                    ->default(true)
                    ->translateLabel(),
            ]);
    }
}
