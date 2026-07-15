<?php

namespace App\Enums;

enum FormFieldType: string
{
    case Text = 'text';
    case Textarea = 'textarea';
    case Email = 'email';
    case Phone = 'phone';
    case Number = 'number';
    case Date = 'date';
    case DateTime = 'datetime';
    case Radio = 'radio';
    case Checkbox = 'checkbox';
    case Select = 'select';

    public function label(): string
    {
        return match ($this) {
            self::Text => 'نص قصير',
            self::Textarea => 'نص طويل',
            self::Email => 'بريد إلكتروني',
            self::Phone => 'رقم جوال',
            self::Number => 'رقم',
            self::Date => 'تاريخ',
            self::DateTime => 'تاريخ مع وقت',
            self::Radio => 'اختيار واحد',
            self::Checkbox => 'اختيارات متعددة',
            self::Select => 'قائمة منسدلة',
        };
    }

    public function hasOptions(): bool
    {
        return in_array($this, [self::Radio, self::Checkbox, self::Select], true);
    }
}
