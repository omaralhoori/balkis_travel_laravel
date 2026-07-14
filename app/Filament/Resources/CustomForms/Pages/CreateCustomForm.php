<?php

namespace App\Filament\Resources\CustomForms\Pages;

use App\Filament\Resources\CustomForms\CustomFormResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomForm extends CreateRecord
{
    protected static string $resource = CustomFormResource::class;
}
