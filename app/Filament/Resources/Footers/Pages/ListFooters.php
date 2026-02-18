<?php

namespace App\Filament\Resources\Footers\Pages;

use App\Filament\Resources\Footers\FooterResource;
use Filament\Resources\Pages\ListRecords;

class ListFooters extends ListRecords
{
    protected static string $resource = FooterResource::class;

    public function mount(): void
    {
        $homePage = \App\Models\HomePage::getCurrent();
        $this->redirect(EditFooter::getUrl(['record' => $homePage->getKey()]), navigate: true);
    }
}
