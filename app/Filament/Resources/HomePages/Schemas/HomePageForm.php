<?php

namespace App\Filament\Resources\HomePages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HomePageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('المحتوى الرئيسي')
                    ->schema([
                        TextInput::make('main_title')
                            ->label('العنوان')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('main_description')
                            ->label('الوصف')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),

                        FileUpload::make('main_background_image')
                            ->label('الصورة الرئيسية')
                            ->image()
                            ->disk('public')
                            ->directory('home-page')
                            ->visibility('public')
                            ->maxSize(2048) // 2MB in KB (matches PHP upload_max_filesize)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->imagePreviewHeight('250')
                            ->loadingIndicatorPosition('left')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->uploadProgressIndicatorPosition('left')
                            ->columnSpanFull(),

                        Repeater::make('destinations')
                            ->label('الوجهات المتاحة')
                            ->schema([
                                TextInput::make('name')
                                    ->label('اسم الوجهة')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('مثال: اسطنبول')
                                    ->helperText('اسم المدينة أو الوجهة السياحية'),
                            ])
                            ->defaultItems(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'وجهة جديدة')
                            ->columnSpanFull(),
                    ]),

                Section::make('معلومات Footer')
                    ->schema([
                        TextInput::make('footer_brand_name')
                            ->label('اسم العلامة التجارية')
                            ->maxLength(255)
                            ->nullable()
                            ->columnSpanFull(),

                        Textarea::make('footer_brand_description')
                            ->label('وصف العلامة التجارية')
                            ->rows(3)
                            ->nullable()
                            ->columnSpanFull(),

                        TextInput::make('footer_phone')
                            ->label('رقم الهاتف')
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_working_hours')
                            ->label('ساعات العمل')
                            ->maxLength(255)
                            ->nullable()
                            ->columnSpanFull(),

                        Textarea::make('footer_copyright_text')
                            ->label('نص حقوق النشر')
                            ->rows(2)
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('روابط Footer')
                    ->schema([
                        TextInput::make('footer_linkedin_url')
                            ->label('رابط LinkedIn')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_twitter_url')
                            ->label('رابط Twitter')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_instagram_url')
                            ->label('رابط Instagram')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_facebook_url')
                            ->label('رابط Facebook')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_youtube_url')
                            ->label('رابط YouTube')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_snapchat_url')
                            ->label('رابط Snapchat')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_tiktok_url')
                            ->label('رابط TikTok')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_about_url')
                            ->label('رابط من نحن')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_projects_url')
                            ->label('رابط المشاريع')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_services_url')
                            ->label('رابط الخدمات')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_blog_url')
                            ->label('رابط المدونة')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_tourism_url')
                            ->label('رابط السياحة')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_realestate_url')
                            ->label('رابط العقارات')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_investment_url')
                            ->label('رابط الاستثمار')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_privacy_policy_url')
                            ->label('رابط سياسة الخصوصية')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('footer_terms_url')
                            ->label('رابط شروط الاستخدام')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),
                    ])
                    ->columns(2),
            ]);
    }
}
