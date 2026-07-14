<?php

namespace App\Filament\Resources\CustomForms\RelationManagers;

use App\Models\FormSubmission;
use App\Services\CustomFormSubmissionExporter;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubmissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'submissions';

    protected static ?string $title = 'الإرسالات والنتائج';

    protected static ?string $modelLabel = 'إرسال';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('تاريخ الإرسال')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('answers_summary')
                    ->label('ملخص الإجابات')
                    ->state(function (FormSubmission $record): string {
                        $pairs = collect($record->answers)
                            ->take(3)
                            ->map(fn ($value, $key): string => $key.': '.(is_array($value) ? implode(', ', $value) : (string) $value));

                        return $pairs->implode(' | ');
                    })
                    ->wrap()
                    ->limit(80),

                TextColumn::make('ip_address')
                    ->label('IP')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->headerActions([
                Action::make('exportCsv')
                    ->label('تصدير Excel')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn () => app(CustomFormSubmissionExporter::class)->exportCsv($this->getOwnerRecord())),

                Action::make('printReport')
                    ->label('تقرير PDF')
                    ->icon('heroicon-o-document-text')
                    ->url(fn () => route('custom_forms.admin.report', $this->getOwnerRecord()))
                    ->openUrlInNewTab(),

                Action::make('copyFormLink')
                    ->label('نسخ رابط النموذج')
                    ->icon('heroicon-o-link')
                    ->action(function (): void {
                        $this->js('navigator.clipboard.writeText('.json_encode($this->getOwnerRecord()->publicUrl()).');');
                    }),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('عرض')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('تاريخ الإرسال')
                            ->dateTime('d/m/Y H:i'),

                        KeyValueEntry::make('answers')
                            ->label('الإجابات')
                            ->state(fn (FormSubmission $record): array => collect($record->answers)
                                ->mapWithKeys(fn ($value, $key): array => [$key => is_array($value) ? implode(', ', $value) : (string) $value])
                                ->all()),
                    ]),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('لا توجد إرسالات بعد')
            ->emptyStateDescription('شارك رابط النموذج مع عملائك لبدء استقبال البيانات.');
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }
}
