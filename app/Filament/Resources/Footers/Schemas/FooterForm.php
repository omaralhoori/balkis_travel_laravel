<?php

namespace App\Filament\Resources\Footers\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FooterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('معلومات العلامة التجارية')
                    ->schema([
                        TextInput::make('footer_brand_name')
                            ->label('اسم الشركة')
                            ->maxLength(255)
                            ->nullable()
                            ->default('بلقيس القابضة')
                            ->helperText('اسم الشركة الذي يظهر في التذييل'),

                        Textarea::make('footer_brand_description')
                            ->label('وصف الشركة')
                            ->rows(3)
                            ->nullable()
                            ->default('شركة رائدة في مجال الاستثمار العقاري وإدارة الثروات في تركيا، نقدم حلولاً متكاملة للمستثمرين الباحثين عن الفخامة والعائد المجزي.')
                            ->helperText('وصف الشركة الذي يظهر في التذييل')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('روابط وسائل التواصل الاجتماعي')
                    ->schema([
                        TextInput::make('footer_linkedin_url')
                            ->label('رابط LinkedIn')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->helperText('رابط صفحة LinkedIn (اختياري)'),

                        TextInput::make('footer_twitter_url')
                            ->label('رابط Twitter')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->helperText('رابط صفحة Twitter (اختياري)'),

                        TextInput::make('footer_instagram_url')
                            ->label('رابط Instagram')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->helperText('رابط صفحة Instagram (اختياري)'),

                        TextInput::make('footer_facebook_url')
                            ->label('رابط Facebook')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->helperText('رابط صفحة Facebook (اختياري)'),

                        TextInput::make('footer_youtube_url')
                            ->label('رابط YouTube')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->helperText('رابط قناة YouTube (اختياري)'),

                        TextInput::make('footer_snapchat_url')
                            ->label('رابط Snapchat')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->helperText('رابط حساب Snapchat (اختياري)'),

                        TextInput::make('footer_tiktok_url')
                            ->label('رابط TikTok')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->helperText('رابط حساب TikTok (اختياري)'),
                    ])
                    ->columns(3),

                Section::make('الروابط السريعة')
                    ->schema([
                        TextInput::make('footer_about_url')
                            ->label('رابط عن الشركة')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->default('#')
                            ->helperText('رابط صفحة عن الشركة'),

                        TextInput::make('footer_projects_url')
                            ->label('رابط المشاريع')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->default('#')
                            ->helperText('رابط صفحة المشاريع'),

                        TextInput::make('footer_services_url')
                            ->label('رابط الخدمات')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->default('#')
                            ->helperText('رابط صفحة الخدمات'),

                        TextInput::make('footer_blog_url')
                            ->label('رابط المدونة')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->default('#')
                            ->helperText('رابط صفحة المدونة'),

                        TextInput::make('footer_tourism_url')
                            ->label('رابط بلقيس للسياحة')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->default('#')
                            ->helperText('رابط صفحة بلقيس للسياحة'),

                        TextInput::make('footer_realestate_url')
                            ->label('رابط بلقيس العقارية')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->default('#')
                            ->helperText('رابط صفحة بلقيس العقارية'),

                        TextInput::make('footer_investment_url')
                            ->label('رابط بلقيس للاستثمار')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->default('#')
                            ->helperText('رابط صفحة بلقيس للاستثمار'),
                    ])
                    ->columns(2),

                Section::make('معلومات التواصل')
                    ->schema([
                        TextInput::make('footer_phone')
                            ->label('رقم الهاتف')
                            ->maxLength(255)
                            ->nullable()
                            ->default('+90 212 555 0123')
                            ->helperText('رقم الهاتف للتواصل'),

                        TextInput::make('footer_email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->maxLength(255)
                            ->nullable()
                            ->default('info@balkispg.com')
                            ->helperText('البريد الإلكتروني للتواصل'),

                        TextInput::make('footer_working_hours')
                            ->label('ساعات العمل')
                            ->maxLength(255)
                            ->nullable()
                            ->default('الاثنين - الجمعة: 9:00 - 18:00')
                            ->helperText('ساعات العمل')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('القسم السفلي')
                    ->schema([
                        TextInput::make('footer_copyright_text')
                            ->label('نص حقوق النشر')
                            ->maxLength(255)
                            ->nullable()
                            ->default('بلقيس القابضة. جميع الحقوق محفوظة.')
                            ->helperText('سيتم إضافة السنة تلقائياً')
                            ->columnSpanFull(),

                        TextInput::make('footer_privacy_policy_url')
                            ->label('رابط سياسة الخصوصية')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->default('#')
                            ->helperText('رابط صفحة سياسة الخصوصية'),

                        TextInput::make('footer_terms_url')
                            ->label('رابط شروط الاستخدام')
                            ->url()
                            ->maxLength(500)
                            ->nullable()
                            ->default('#')
                            ->helperText('رابط صفحة شروط الاستخدام'),
                    ])
                    ->columns(2),
            ]);
    }
}
