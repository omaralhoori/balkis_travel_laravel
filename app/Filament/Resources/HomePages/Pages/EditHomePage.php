<?php

namespace App\Filament\Resources\HomePages\Pages;

use App\Filament\Resources\HomePages\HomePageResource;
use App\Filament\Translatable\Actions\LocaleSwitcher;
use App\Filament\Translatable\Resources\Pages\EditRecord\Concerns\Translatable;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class EditHomePage extends EditRecord
{
    use Translatable;

    protected static string $resource = HomePageResource::class;

    protected static ?string $title = 'تعديل الصفحة الرئيسية';

    public function mount(int|string|null $record = null): void
    {
        if ($record === null) {
            $homePage = \App\Models\HomePage::getCurrent();
            $this->record = $homePage->getKey();
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

    protected function fillForm(): void
    {
        $this->activeLocale = $this->getDefaultTranslatableLocale();

        $record = $this->getRecord();
        $translatableAttributes = static::getResource()::getTranslatableAttributes();

        foreach ($this->getTranslatableLocales() as $locale) {
            $translatedData = [];

            foreach ($translatableAttributes as $attribute) {
                $translatedData[$attribute] = $record->getTranslation($attribute, $locale, useFallbackLocale: false);
            }

            if ($locale !== $this->activeLocale) {
                $this->otherLocaleData[$locale] = $this->mutateFormDataBeforeFill($translatedData);

                continue;
            }

            /** @internal Read the DocBlock above the following method. */
            $this->fillFormWithDataAndCallHooks($record, $translatedData);
        }
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }

    protected ?string $oldActiveLocale = null;

    public function updatingActiveLocale(): void
    {
        $this->oldActiveLocale = $this->activeLocale;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function updatedActiveLocale(): void
    {
        if (blank($this->oldActiveLocale ?? null)) {
            return;
        }

        $this->resetValidation();

        $translatableAttributes = static::getResource()::getTranslatableAttributes();

        // Save data for the old locale
        $oldLocaleData = Arr::only($this->data, $translatableAttributes);
        $this->otherLocaleData[$this->oldActiveLocale] = $oldLocaleData;

        // Load data for the new locale
        $newLocaleData = $this->otherLocaleData[$this->activeLocale] ?? [];

        // Prepare new data
        $newData = [
            ...Arr::except($this->data, $translatableAttributes),
            ...$newLocaleData,
        ];

        // Update translatable attributes with new locale translations
        foreach ($translatableAttributes as $attribute) {
            if (isset($newLocaleData[$attribute])) {
                $newData[$attribute] = $newLocaleData[$attribute];
            } else {
                $record = $this->getRecord();
                $newData[$attribute] = $record->getTranslation($attribute, $this->activeLocale, useFallbackLocale: false);
            }
        }

        // Use fillFormWithDataAndCallHooks to properly rebuild form state including Repeater
        // This method ensures all components including Repeater are properly reinitialized
        $record = $this->getRecord();
        $this->fillFormWithDataAndCallHooks($record, $newData);

        unset($this->otherLocaleData[$this->activeLocale]);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Handle main record translations first
        $translatableAttributes = static::getResource()::getTranslatableAttributes();

        $record->fill(Arr::except($data, $translatableAttributes));

        foreach (Arr::only($data, $translatableAttributes) as $key => $value) {
            $record->setTranslation($key, $this->activeLocale, $value);
        }

        $originalData = $this->data;

        $existingLocales = null;

        foreach ($this->otherLocaleData as $locale => $localeData) {
            $existingLocales ??= collect($translatableAttributes)
                ->map(fn (string $attribute): array => array_keys($record->getTranslations($attribute)))
                ->flatten()
                ->unique()
                ->all();

            $this->data = [
                ...$this->data,
                ...$localeData,
            ];

            try {
                $this->form->validate();
            } catch (\Illuminate\Validation\ValidationException $exception) {
                if (! array_key_exists($locale, $existingLocales)) {
                    continue;
                }

                $this->setActiveLocale($locale);

                throw $exception;
            }

            $localeData = $this->mutateFormDataBeforeSave($localeData);

            foreach (Arr::only($localeData, $translatableAttributes) as $key => $value) {
                $record->setTranslation($key, $locale, $value);
            }
        }

        $this->data = $originalData;

        $record->save();

        return $record;
    }
}
