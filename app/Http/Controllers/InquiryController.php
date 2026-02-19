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
        $locale = app()->getLocale();
        $destinations = json_decode($data['selected_destinations'] ?? '[]', true);
        $services = is_string($data['services'] ?? null)
            ? json_decode($data['services'], true) ?? []
            : ($data['services'] ?? []);

        // Set locale for translations
        app()->setLocale($locale);

        $message = '🌍 *'.__('New Tourism Inquiry', [], $locale)."*\n\n";
        $message .= '📍 *'.__('Required Destinations', [], $locale).":*\n";
        if (! empty($destinations)) {
            foreach ($destinations as $destination) {
                $message .= "• {$destination}\n";
            }
        } else {
            $message .= '• '.__('No destinations selected', [], $locale)."\n";
        }

        $message .= "\n👥 *".__('Number of Travelers', [], $locale).":*\n";
        $message .= '• '.__('Adults', [], $locale).": {$data['adults']}\n";
        $message .= '• '.__('Children', [], $locale).": {$data['children']}\n";

        $message .= "\n📅 *".__('Trip Dates', [], $locale).":*\n";
        $message .= '• '.__('From Date', [], $locale).": {$data['arrival_date']}\n";
        $message .= '• '.__('To Date', [], $locale).": {$data['departure_date']}\n";

        if (! empty($services)) {
            $message .= "\n✨ *".__('Select Required Services', [], $locale).":*\n";
            $serviceNames = [
                'flight' => __('Flight', [], $locale),
                'accommodation' => __('Accommodation', [], $locale),
                'car_rental' => __('Car Rental', [], $locale),
                'tourist_trips' => __('Tourist Trips', [], $locale),
            ];
            foreach ($services as $service) {
                $message .= '• '.($serviceNames[$service] ?? $service)."\n";
            }
        }

        return $message;
    }
}
