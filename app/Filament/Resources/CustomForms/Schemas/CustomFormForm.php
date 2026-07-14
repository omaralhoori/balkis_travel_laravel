<?php

namespace App\Filament\Resources\CustomForms\Schemas;

use App\Enums\FormFieldType;
use App\Models\CustomForm;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class CustomFormForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('custom_form_tabs')
                    ->tabs([
                        Tab::make('معلومات النموذج')
                            ->schema(self::generalTab()),
                        Tab::make('بناء الأسئلة')
                            ->schema(self::builderTab()),
                        Tab::make('التصميم')
                            ->schema(self::designTab()),
                        Tab::make('صفحة الشكر')
                            ->schema(self::thankYouTab()),
                        Tab::make('الإشعارات')
                            ->schema(self::notificationsTab()),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    protected static function generalTab(): array
    {
        return [
            Section::make('البيانات الأساسية')
                ->schema([
                    TextInput::make('title')
                        ->label('عنوان النموذج')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, ?string $state): void {
                            $set('slug', CustomForm::makeSlug($state));
                        })
                        ->columnSpanFull(),

                    TextInput::make('slug')
                        ->label('الرابط (Slug)')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true)
                        ->helperText('يُستخدم في رابط النموذج العام. مثال: /ar/forms/رحلة-عائلية')
                        ->columnSpanFull(),

                    Textarea::make('description')
                        ->label('وصف النموذج')
                        ->rows(3)
                        ->columnSpanFull(),

                    Toggle::make('is_active')
                        ->label('النموذج نشط')
                        ->default(true),
                ])
                ->columns(2),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    protected static function builderTab(): array
    {
        return [
            Section::make('أقسام النموذج والأسئلة')
                ->description('أضف أقساماً مثل: معلومات شخصية، عن الرحلة، ملاحظات إضافية. ثم أضف الأسئلة داخل كل قسم.')
                ->schema([
                    Repeater::make('sections')
                        ->relationship()
                        ->label('الأقسام')
                        ->orderColumn('order')
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'قسم جديد')
                        ->schema([
                            TextInput::make('title')
                                ->label('اسم القسم')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),

                            Repeater::make('fields')
                                ->relationship()
                                ->label('الأسئلة')
                                ->orderColumn('order')
                                ->reorderable()
                                ->collapsible()
                                ->cloneable()
                                ->itemLabel(fn (array $state): ?string => $state['label'] ?? 'سؤال جديد')
                                ->schema([
                                    TextInput::make('label')
                                        ->label('نص السؤال')
                                        ->required()
                                        ->maxLength(255)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(function (Set $set, ?string $state, Get $get): void {
                                            if (blank($get('field_key'))) {
                                                $set('field_key', CustomForm::makeFieldKey((string) $state));
                                            }
                                        })
                                        ->columnSpanFull(),

                                    TextInput::make('field_key')
                                        ->label('مفتاح الحقل')
                                        ->required()
                                        ->maxLength(100)
                                        ->alphaDash()
                                        ->helperText('يُستخدم في المنطق الشرطي ورسالة الواتساب: {{field_key}}')
                                        ->columnSpan(1),

                                    Select::make('type')
                                        ->label('نوع الإجابة')
                                        ->options(collect(FormFieldType::cases())->mapWithKeys(
                                            fn (FormFieldType $type): array => [$type->value => $type->label()]
                                        ))
                                        ->required()
                                        ->live()
                                        ->columnSpan(1),

                                    Toggle::make('is_required')
                                        ->label('إجباري')
                                        ->default(false)
                                        ->columnSpan(1),

                                    Textarea::make('help_text')
                                        ->label('نص مساعد')
                                        ->rows(2)
                                        ->columnSpanFull(),

                                    TagsInput::make('options')
                                        ->label('الخيارات')
                                        ->placeholder('أضف خياراً واضغط Enter')
                                        ->visible(fn (Get $get): bool => in_array($get('type'), [
                                            FormFieldType::Radio->value,
                                            FormFieldType::Checkbox->value,
                                            FormFieldType::Select->value,
                                        ], true))
                                        ->columnSpanFull(),

                                    Repeater::make('conditional_rules')
                                        ->label('المنطق الشرطي (إظهار السؤال عند)')
                                        ->helperText('اتركه فارغاً لإظهار السؤال دائماً. استخدم مفتاح سؤال سابق والقيمة المطلوبة.')
                                        ->schema([
                                            TextInput::make('field_key')
                                                ->label('مفتاح السؤال السابق')
                                                ->required()
                                                ->maxLength(100),

                                            Select::make('operator')
                                                ->label('الشرط')
                                                ->options([
                                                    'equals' => 'يساوي',
                                                    'not_equals' => 'لا يساوي',
                                                    'contains' => 'يحتوي',
                                                ])
                                                ->default('equals')
                                                ->required(),

                                            TextInput::make('value')
                                                ->label('القيمة')
                                                ->required()
                                                ->maxLength(255),
                                        ])
                                        ->defaultItems(0)
                                        ->collapsible()
                                        ->columnSpanFull(),
                                ])
                                ->columns(2)
                                ->columnSpanFull(),
                        ])
                        ->columnSpanFull(),
                ]),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    protected static function designTab(): array
    {
        return [
            Section::make('الهوية البصرية')
                ->schema([
                    FileUpload::make('logo_path')
                        ->label('شعار النموذج')
                        ->image()
                        ->disk('public')
                        ->directory('custom-forms/logos')
                        ->visibility('public')
                        ->imageEditor()
                        ->columnSpanFull(),

                    FileUpload::make('background_image_path')
                        ->label('صورة الخلفية')
                        ->image()
                        ->disk('public')
                        ->directory('custom-forms/backgrounds')
                        ->visibility('public')
                        ->imageEditor()
                        ->columnSpanFull(),

                    ColorPicker::make('primary_color')
                        ->label('اللون الأساسي')
                        ->default('#C6A264'),

                    ColorPicker::make('button_color')
                        ->label('لون الأزرار')
                        ->default('#765C39'),

                    ColorPicker::make('text_color')
                        ->label('لون النص')
                        ->default('#4A566C'),
                ])
                ->columns(3),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    protected static function thankYouTab(): array
    {
        return [
            Section::make('صفحة الشكر بعد الإرسال')
                ->schema([
                    TextInput::make('thank_you_title')
                        ->label('عنوان صفحة الشكر')
                        ->default('شكراً لك!')
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Textarea::make('thank_you_message')
                        ->label('رسالة صفحة الشكر')
                        ->rows(4)
                        ->columnSpanFull(),

                    TextInput::make('whatsapp_button_label')
                        ->label('نص زر الواتساب')
                        ->default('تواصل معنا عبر واتساب')
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Textarea::make('whatsapp_message_template')
                        ->label('قالب رسالة الواتساب')
                        ->helperText('استخدم {{field_key}} لإدراج إجابات العميل. مثال: مرحباً، اسمي {{full_name}} وأرغب بحجز رحلة عائلية.')
                        ->rows(6)
                        ->columnSpanFull(),
                ]),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    protected static function notificationsTab(): array
    {
        return [
            Section::make('تنبيهات البريد الإلكتروني')
                ->description('يُرسل إشعار فوري ببيانات العميل إلى البريدين عند كل إرسال.')
                ->schema([
                    TextInput::make('notification_email_primary')
                        ->label('البريد الإلكتروني الأول')
                        ->email()
                        ->maxLength(255),

                    TextInput::make('notification_email_secondary')
                        ->label('البريد الإلكتروني الثاني')
                        ->email()
                        ->maxLength(255),
                ])
                ->columns(2),
        ];
    }
}
