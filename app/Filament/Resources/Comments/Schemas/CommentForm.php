<?php

namespace App\Filament\Resources\Comments\Schemas;

use App\Models\BlogPost;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('معلومات التعليق')
                    ->schema([
                        Select::make('blog_post_id')
                            ->label('المقال')
                            ->relationship('blogPost', 'title')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->columnSpanFull(),

                        TextInput::make('name')
                            ->label('الاسم')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('message')
                            ->label('التعليق')
                            ->required()
                            ->rows(5)
                            ->maxLength(5000)
                            ->columnSpanFull(),

                        Toggle::make('is_approved')
                            ->label('معتمد')
                            ->default(false)
                            ->helperText('التعليقات المعتمدة فقط ستظهر في الموقع'),

                        DateTimePicker::make('approved_at')
                            ->label('تاريخ الاعتماد')
                            ->nullable()
                            ->displayFormat('d/m/Y H:i')
                            ->native(false),
                    ])
                    ->columns(2),
            ]);
    }
}
