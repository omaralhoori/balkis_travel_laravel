<?php

namespace App\Http\Controllers;

use App\Models\WhatsAppNumber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function redirect(Request $request): RedirectResponse
    {
        $numbers = WhatsAppNumber::getActiveNumbers();
        
        if ($numbers->isEmpty()) {
            return redirect()->back()->with('error', 'لا توجد أرقام واتساب متاحة');
        }

        // الحصول على الفهرس الحالي من Session
        $currentIndex = session('whatsapp_number_index', -1);
        
        // الانتقال للرقم التالي
        $nextIndex = ($currentIndex + 1) % $numbers->count();
        
        // حفظ الفهرس الجديد في Session
        session(['whatsapp_number_index' => $nextIndex]);
        
        $number = $numbers->get($nextIndex);
        
        $message = $request->get('text');
        
        return redirect($number->getWhatsAppUrl($message));
    }
}
