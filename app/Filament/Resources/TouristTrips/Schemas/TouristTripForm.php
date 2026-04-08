<?php

namespace App\Filament\Resources\TouristTrips\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TouristTripForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->translateLabel()
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->translateLabel()
                    ->image()
                    ->disk('public')
                    ->directory('tourist-trips'),
                RichEditor::make('includes')
                    ->translateLabel()
                    ->default(null)
                    ->columnSpanFull(),
                RichEditor::make('what_to_bring')
                    ->translateLabel()
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
