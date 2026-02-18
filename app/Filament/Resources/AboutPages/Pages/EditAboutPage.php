<?php

namespace App\Filament\Resources\AboutPages\Pages;

use App\Filament\Resources\AboutPages\AboutPageResource;
use App\Filament\Translatable\Actions\LocaleSwitcher;
use App\Filament\Translatable\Resources\Pages\EditRecord\Concerns\Translatable;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Arr;

class EditAboutPage extends EditRecord
{
    use Translatable;

    protected static string $resource = AboutPageResource::class;

    protected static ?string $title = 'تعديل صفحة عن المجموعة';

    public function mount(int|string|null $record = null): void
    {
        if ($record === null) {
            $aboutPage = \App\Models\AboutPage::getCurrent();
            $this->record = $aboutPage->getKey();
        } else {
            $this->record = $record;
        }

        parent::mount($this->record);
    }

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return static::getUrl();
    }

    public function getBreadcrumbs(): array
    {
        return [
            static::getUrl() => static::getTitle(),
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Ensure nested Repeater data is properly initialized
        $nestedRepeaterFields = ['commitment_sections'];
        
        foreach ($nestedRepeaterFields as $field) {
            if (isset($data[$field]) && is_array($data[$field])) {
                foreach ($data[$field] as $index => $item) {
                    if (isset($item['items'])) {
                        // Ensure items is always an array
                        if (!is_array($item['items'])) {
                            $data[$field][$index]['items'] = [];
                        }
                    } else {
                        // Initialize items if missing
                        $data[$field][$index]['items'] = [];
                    }
                }
            } elseif (!isset($data[$field])) {
                // Initialize field if missing
                $data[$field] = [];
            }
        }

        return $data;
    }

    public function updatedActiveLocale(): void
    {
        if (blank($this->oldActiveLocale ?? null)) {
            return;
        }

        $this->resetValidation();

        $translatableAttributes = static::getResource()::getTranslatableAttributes();

        // Save current locale data
        $this->otherLocaleData[$this->oldActiveLocale] = Arr::only($this->data, $translatableAttributes);

        // Get new locale data
        $newLocaleData = $this->otherLocaleData[$this->activeLocale] ?? [];

        // Prepare new data with proper initialization
        $newData = [
            ...Arr::except($this->data, $translatableAttributes),
            ...$this->mutateFormDataBeforeFill($newLocaleData),
        ];

        // Use fillFormWithDataAndCallHooks to properly rebuild form state including nested Repeaters
        $record = $this->getRecord();
        $this->fillFormWithDataAndCallHooks($record, $newData);

        unset($this->otherLocaleData[$this->activeLocale]);
    }
}
