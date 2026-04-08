<?php

namespace App\Filament\Resources\Accommodations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;

class AccommodationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                 ImageColumn::make('images')
                    ->disk('public')
                    ->circular()
                    ->stacked()
                    ->limit(3)
                    ->translateLabel(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->translateLabel(),

                TextColumn::make('city')
                    ->searchable()
                    ->sortable()
                    ->translateLabel(),

                TextColumn::make('type')
                    ->formatStateUsing(function (string $state): string {
                        return match ($state) {
                            'hotel' => __('Hotel'),
                            'hotel_apartment' => __('Hotel Apartment'),
                            'cottage' => __('Cottage'),
                            default => $state,
                        };
                    })
                    ->sortable()
                    ->translateLabel(),

                TextColumn::make('rating')
                    ->sortable()
                    ->translateLabel(),

                TextColumn::make('order')
                    ->sortable()
                    ->translateLabel(),

                ToggleColumn::make('is_active')
                    ->translateLabel(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
    }
}
