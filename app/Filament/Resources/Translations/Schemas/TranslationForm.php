<?php

namespace App\Filament\Resources\Translations\Schemas;

use App\Models\AboutPage;
use App\Models\BlogPost;
use App\Models\HomePage;
use App\Models\HomePageService;
use App\Models\Program;
use App\Models\Testimonial;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TranslationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('معلومات الترجمة')
                    ->schema([
                        Select::make('translatable_type')
                            ->label('نوع النموذج')
                            ->options([
                                HomePage::class => 'الصفحة الرئيسية',
                                HomePageService::class => 'خدمة الصفحة الرئيسية',
                                BlogPost::class => 'مقال',
                                Program::class => 'برنامج',
                                AboutPage::class => 'صفحة عن المجموعة',
                                Testimonial::class => 'شهادة',
                            ])
                            ->required()
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('translatable_id', null)),

                        Select::make('translatable_id')
                            ->label('السجل')
                            ->options(function ($get) {
                                $type = $get('translatable_type');
                                if (! $type) {
                                    return [];
                                }

                                return match ($type) {
                                    HomePage::class => HomePage::all()->mapWithKeys(function ($item) {
                                        $title = $item->getRawOriginal('main_title') ?? $item->attributes['main_title'] ?? 'الصفحة الرئيسية';
                                        return [$item->id => "#{$item->id} - {$title}"];
                                    })->toArray(),
                                    HomePageService::class => HomePageService::all()->mapWithKeys(function ($item) {
                                        $title = $item->getRawOriginal('title') ?? $item->attributes['title'] ?? 'خدمة';
                                        $serviceKey = $item->service_key ?? '';
                                        $order = $item->order ?? 0;
                                        $info = $serviceKey ? " ({$serviceKey})" : '';
                                        return [$item->id => "#{$item->id} - {$title}{$info} - ترتيب: {$order}"];
                                    })->toArray(),
                                    BlogPost::class => BlogPost::all()->mapWithKeys(function ($item) {
                                        $title = $item->getRawOriginal('title') ?? $item->attributes['title'] ?? 'مقال';
                                        $category = $item->getRawOriginal('category') ?? $item->attributes['category'] ?? '';
                                        $date = $item->created_at ? $item->created_at->format('Y-m-d') : '';
                                        $info = $category ? " [{$category}]" : '';
                                        $dateInfo = $date ? " - {$date}" : '';
                                        return [$item->id => "#{$item->id} - {$title}{$info}{$dateInfo}"];
                                    })->toArray(),
                                    Program::class => Program::all()->mapWithKeys(function ($item) {
                                        $title = $item->getRawOriginal('title') ?? $item->attributes['title'] ?? 'برنامج';
                                        $category = $item->getRawOriginal('category') ?? $item->attributes['category'] ?? '';
                                        $order = $item->order ?? 0;
                                        $info = $category ? " [{$category}]" : '';
                                        return [$item->id => "#{$item->id} - {$title}{$info} - ترتيب: {$order}"];
                                    })->toArray(),
                                    AboutPage::class => AboutPage::all()->mapWithKeys(function ($item) {
                                        $title = $item->getRawOriginal('hero_title') ?? $item->attributes['hero_title'] ?? 'عن المجموعة';
                                        return [$item->id => "#{$item->id} - {$title}"];
                                    })->toArray(),
                                    Testimonial::class => Testimonial::all()->mapWithKeys(function ($item) {
                                        $name = $item->getRawOriginal('name') ?? $item->attributes['name'] ?? 'شهادة';
                                        $position = $item->getRawOriginal('position') ?? $item->attributes['position'] ?? '';
                                        $company = $item->getRawOriginal('company') ?? $item->attributes['company'] ?? '';
                                        $info = '';
                                        if ($position && $company) {
                                            $info = " ({$position} - {$company})";
                                        } elseif ($position) {
                                            $info = " ({$position})";
                                        } elseif ($company) {
                                            $info = " ({$company})";
                                        }
                                        return [$item->id => "#{$item->id} - {$name}{$info}"];
                                    })->toArray(),
                                    default => [],
                                };
                            })
                            ->required()
                            ->searchable()
                            ->reactive()
                            ->disabled(fn ($get) => ! $get('translatable_type'))
                            ->helperText('اختر السجل المراد ترجمته. الرقم في البداية هو ID السجل'),

                        Select::make('locale')
                            ->label('اللغة')
                            ->options([
                                'ar' => 'العربية',
                                'en' => 'English',
                                'tr' => 'Türkçe',
                            ])
                            ->required()
                            ->default('en')
                            ->searchable(),

                        Select::make('field')
                            ->label('اسم الحقل')
                            ->options(function ($get) {
                                $type = $get('translatable_type');
                                if (! $type) {
                                    return [];
                                }

                                return match ($type) {
                                    HomePage::class => [
                                        'main_title' => 'main_title - العنوان الرئيسي',
                                        'main_subtitle' => 'main_subtitle - العنوان الفرعي',
                                        'main_description' => 'main_description - الوصف الرئيسي',
                                        'main_badge_text' => 'main_badge_text - نص الشارة',
                                        'cta_button_text' => 'cta_button_text - نص زر CTA',
                                        'video_button_text' => 'video_button_text - نص زر الفيديو',
                                        'statistics_title' => 'statistics_title - عنوان الإحصائيات',
                                        'statistics_subtitle' => 'statistics_subtitle - العنوان الفرعي للإحصائيات',
                                        'statistics_description' => 'statistics_description - وصف الإحصائيات',
                                        'statistics_badge_text' => 'statistics_badge_text - نص شارة الإحصائيات',
                                        'map_location_title' => 'map_location_title - عنوان الموقع',
                                        'map_address_line1' => 'map_address_line1 - العنوان السطر الأول',
                                        'map_address_line2' => 'map_address_line2 - العنوان السطر الثاني',
                                        'footer_brand_name' => 'footer_brand_name - اسم العلامة التجارية',
                                        'footer_brand_description' => 'footer_brand_description - وصف العلامة التجارية',
                                        'footer_copyright_text' => 'footer_copyright_text - نص حقوق النشر',
                                    ],
                                    HomePageService::class => [
                                        'title' => 'title - العنوان',
                                        'subtitle' => 'subtitle - العنوان الفرعي',
                                        'description' => 'description - الوصف',
                                        'badge_text' => 'badge_text - نص الشارة',
                                        'card_title' => 'card_title - عنوان البطاقة',
                                        'card_description' => 'card_description - وصف البطاقة',
                                        'cta_button_text' => 'cta_button_text - نص زر CTA',
                                    ],
                                    BlogPost::class => [
                                        'title' => 'title - العنوان',
                                        'excerpt' => 'excerpt - الملخص',
                                        'content' => 'content - المحتوى',
                                        'category' => 'category - الفئة',
                                        'meta_title' => 'meta_title - عنوان SEO',
                                        'meta_description' => 'meta_description - وصف SEO',
                                        'meta_keywords' => 'meta_keywords - كلمات مفتاحية SEO',
                                    ],
                                    Program::class => [
                                        'title' => 'title - العنوان',
                                        'description' => 'description - الوصف',
                                        'category' => 'category - الفئة',
                                    ],
                                    AboutPage::class => [
                                        'hero_title' => 'hero_title - عنوان البطل',
                                        'hero_title_highlight' => 'hero_title_highlight - تمييز العنوان',
                                        'hero_description' => 'hero_description - وصف البطل',
                                        'vision_title' => 'vision_title - عنوان الرؤية',
                                        'vision_description' => 'vision_description - وصف الرؤية',
                                        'mission_title' => 'mission_title - عنوان الرسالة',
                                        'mission_description' => 'mission_description - وصف الرسالة',
                                        'timeline_badge' => 'timeline_badge - شارة الخط الزمني',
                                        'timeline_title' => 'timeline_title - عنوان الخط الزمني',
                                        'values_title' => 'values_title - عنوان القيم',
                                        'team_badge' => 'team_badge - شارة الفريق',
                                        'team_title' => 'team_title - عنوان الفريق',
                                        'commitment_badge' => 'commitment_badge - شارة الالتزام',
                                        'commitment_title' => 'commitment_title - عنوان الالتزام',
                                        'commitment_title_highlight' => 'commitment_title_highlight - تمييز عنوان الالتزام',
                                        'commitment_description' => 'commitment_description - وصف الالتزام',
                                        'compliance_title' => 'compliance_title - عنوان الامتثال',
                                        'compliance_description' => 'compliance_description - وصف الامتثال',
                                        'contact_question' => 'contact_question - سؤال الاتصال',
                                        'contact_description' => 'contact_description - وصف الاتصال',
                                    ],
                                    Testimonial::class => [
                                        'name' => 'name - الاسم',
                                        'position' => 'position - المنصب',
                                        'company' => 'company - الشركة',
                                        'testimonial' => 'testimonial - الشهادة',
                                    ],
                                    default => [],
                                };
                            })
                            ->required()
                            ->searchable()
                            ->reactive()
                            ->disabled(fn ($get) => ! $get('translatable_type'))
                            ->helperText('اختر الحقل المراد ترجمته من القائمة')
                            ->columnSpanFull(),

                        Textarea::make('value')
                            ->label('القيمة المترجمة')
                            ->rows(6)
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
