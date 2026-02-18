<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsAppNumber extends Model
{
    protected $fillable = [
        'number',
        'name',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public static function getActiveNumbers(): \Illuminate\Database\Eloquent\Collection
    {
        return static::where('is_active', true)
            ->orderBy('order')
            ->orderBy('id')
            ->get();
    }

    public static function getNextNumber(int $currentIndex = 0): ?self
    {
        $numbers = static::getActiveNumbers();
        
        if ($numbers->isEmpty()) {
            return null;
        }

        $nextIndex = ($currentIndex + 1) % $numbers->count();
        
        return $numbers->get($nextIndex);
    }

    public function getWhatsAppUrl(?string $message = null): string
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $this->number);
        $url = "https://wa.me/{$cleanNumber}";
        
        if ($message) {
            $url .= '?text=' . urlencode($message);
        }
        
        return $url;
    }
}
