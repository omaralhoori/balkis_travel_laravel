<?php

namespace App\Filament\Resources\HomePages\Pages;

use App\Filament\Resources\HomePages\HomePageResource;
use Filament\Resources\Pages\ListRecords;

class ListHomePage extends ListRecords
{
    protected static string $resource = HomePageResource::class;

    protected static ?string $title = 'الصفحة الرئيسية';

    public function mount(): void
    {
        // Redirect to edit page since we only have one record
        $this->redirect(HomePageResource::getUrl('edit'));
    }
}

