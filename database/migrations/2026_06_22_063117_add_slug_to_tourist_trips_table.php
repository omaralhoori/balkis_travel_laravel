<?php

use App\Models\TouristTrip;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tourist_trips', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
        });

        TouristTrip::query()->orderBy('id')->get()->each(function (TouristTrip $trip): void {
            $trip->slug = $trip->generateUniqueSlug((string) $trip->getTranslation('title', config('app.locale', 'ar')));
            $trip->saveQuietly();
        });
    }

    public function down(): void
    {
        Schema::table('tourist_trips', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
