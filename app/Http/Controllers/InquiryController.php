<?php

namespace App\Http\Controllers;

use App\Http\Requests\InquiryRequest;
use App\Models\WhatsAppNumber;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class InquiryController extends Controller
{
    public function store(InquiryRequest $request): JsonResponse
    {
        $whatsappNumbers = WhatsAppNumber::getActiveNumbers();

        if ($whatsappNumbers->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => __('No WhatsApp numbers configured'),
            ], 400);
        }

        // Get next WhatsApp number using Round-Robin
        $lastIndex = Cache::get('whatsapp_last_index', 0);
        $nextIndex = ($lastIndex + 1) % $whatsappNumbers->count();
        $selectedNumber = $whatsappNumbers->get($nextIndex);

        // Update last index in cache
        Cache::forever('whatsapp_last_index', $nextIndex);

        // Prepare message
        $message = $this->formatMessage($request->validated());

        // Create WhatsApp URL using model method
        $whatsappUrl = $selectedNumber->getWhatsAppUrl($message);

        return response()->json([
            'success' => true,
            'message' => __('Inquiry submitted successfully'),
            'whatsapp_url' => $whatsappUrl,
        ]);
    }

    /**
     * Format the inquiry data into a WhatsApp message
     */
    private function formatMessage(array $data): string
    {
        $destinations = json_decode($data['selected_destinations'] ?? '[]', true);
        $services = is_string($data['services'] ?? null)
            ? json_decode($data['services'], true) ?? []
            : ($data['services'] ?? []);

        $message = "🌍 *استفسار جديد عن رحلة سياحية*\n\n";
        $message .= "📍 *الوجهات المطلوبة:*\n";
        if (! empty($destinations)) {
            foreach ($destinations as $destination) {
                $message .= "• {$destination}\n";
            }
        } else {
            $message .= "• لم يتم تحديد وجهات\n";
        }

        $message .= "\n👥 *عدد المسافرين:*\n";
        $message .= "• بالغين: {$data['adults']}\n";
        $message .= "• أطفال: {$data['children']}\n";

        $message .= "\n📅 *تواريخ الرحلة:*\n";
        $message .= "• من: {$data['arrival_date']}\n";
        $message .= "• إلى: {$data['departure_date']}\n";

        if (! empty($services)) {
            $message .= "\n✨ *الخدمات المطلوبة:*\n";
            $serviceNames = [
                'flight' => 'طيران',
                'accommodation' => 'إقامة',
                'car_rental' => 'تأجير سيارات',
                'tourist_trips' => 'رحلات سياحية',
            ];
            foreach ($services as $service) {
                $message .= '• '.($serviceNames[$service] ?? $service)."\n";
            }
        }

        return $message;
    }
}
