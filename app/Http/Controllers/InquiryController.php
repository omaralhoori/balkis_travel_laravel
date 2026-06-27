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

        // Set locale for translations
        app()->setLocale($locale);

        // Check if it's a program inquiry
        if (isset($data['program_id']) && isset($data['program_title'])) {
            $message = '📋 *'.__('Program Inquiry', [], $locale)."*\n\n";
            $message .= '🏷️ *'.__('Program', [], $locale).":* {$data['program_title']}\n\n";
            $message .= '👤 *'.__('Full Name', [], $locale).":* {$data['name']}\n";
            $message .= '📞 *'.__('Phone Number', [], $locale).":* {$data['phone']}\n";
            $message .= '📧 *'.__('Email', [], $locale).":* {$data['email']}\n";

            return $message;
        }

        // Default tourism inquiry format
        $destinations = json_decode($data['selected_destinations'] ?? '[]', true);
        $services = is_string($data['services'] ?? null)
            ? json_decode($data['services'], true) ?? []
            : ($data['services'] ?? []);

        $message = '🌍 *'.__('New Tourism Inquiry', [], $locale)."*\n\n";
        $message .= '📍 *'.__('Required Destinations', [], $locale).":*\n";
        if (! empty($destinations)) {
            foreach ($destinations as $destination) {
                if (is_array($destination)) {
                    $name = $destination['name'] ?? '';
                    $days = $destination['days'] ?? null;
                    $line = "• {$name}";
                    if (! empty($days)) {
                        $line .= ' — '.$days.' '.__('days', [], $locale);
                    }
                    $message .= $line."\n";
                } else {
                    $message .= "• {$destination}\n";
                }
            }
        } else {
            $message .= '• '.__('No destinations selected', [], $locale)."\n";
        }

        $message .= "\n👥 *".__('Number of Travelers', [], $locale).":*\n";
        $message .= '• '.__('Adults', [], $locale).": {$data['adults']}\n";
        $message .= '• '.__('Children', [], $locale).": {$data['children']}\n";

        if (! empty($data['child_ages'])) {
            $validAges = array_filter($data['child_ages'], function ($val) {
                return $val !== null && $val !== '';
            });
            if (! empty($validAges)) {
                $message .= '  📝 *'.__('Children Ages', [], $locale).':* '.implode(', ', $validAges)."\n";
            }
        }

        $message .= "\n📅 *".__('Trip Dates', [], $locale).":*\n";
        $message .= '• '.__('From Date', [], $locale).": {$data['arrival_date']}\n";
        $message .= '• '.__('To Date', [], $locale).": {$data['departure_date']}\n";

        if (! empty($services)) {
            $message .= "\n✨ *".__('Required Services', [], $locale).":*\n";
            $serviceNames = [
                'accommodation' => __('Accommodation', [], $locale),
                'car_rental' => __('Car Rental', [], $locale),
                'tourist_trips' => __('Tourist Trips', [], $locale),
            ];
            $accommodationLabels = [
                'hotel' => __('Hotel', [], $locale),
                'apartment_hotel' => __('Apartment Hotel', [], $locale),
                'cottage' => __('Cottage', [], $locale),
            ];
            foreach ($services as $service) {
                $message .= '• '.($serviceNames[$service] ?? $service)."\n";

                if ($service === 'accommodation') {
                    $accommodationDays = json_decode($data['accommodation_days'] ?? '[]', true) ?: [];
                    foreach ($accommodationDays as $entry) {
                        if (! is_array($entry)) {
                            continue;
                        }
                        $day = $entry['day'] ?? null;
                        $type = $entry['type'] ?? null;
                        if ($day === null || $type === null) {
                            continue;
                        }
                        $typeLabel = $accommodationLabels[$type] ?? $type;
                        $city = $entry['city'] ?? null;
                        $dayLabel = __('Day', [], $locale).' '.$day;
                        if (! empty($city)) {
                            $dayLabel .= ' ('.$city.')';
                        }
                        $message .= '   - '.$dayLabel.': '.$typeLabel."\n";
                    }
                }

                if ($service === 'car_rental' && ! empty($data['car_rental_type'])) {
                    $carTypeTranslated = $data['car_rental_type'] === 'with_driver'
                        ? __('With Driver', [], $locale)
                        : __('Without Driver', [], $locale);
                    $message .= '   - '.__('Car Rental Type', [], $locale).': '.$carTypeTranslated."\n";
                }

                if ($service === 'tourist_trips' && ! empty($data['trip_type'])) {
                    $tripTypeTranslated = $data['trip_type'] === 'VIP' ? __('VIP (Private)', [], $locale) : __('Group', [], $locale);
                    $message .= '   - '.__('Trip Type', [], $locale).': '.$tripTypeTranslated."\n";
                }
            }
        }

        return $message;
    }
}
