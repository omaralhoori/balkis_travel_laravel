<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tourist_trips', function (Blueprint $table) {
            $table->json('description')->nullable()->after('title');
            $table->json('location')->nullable()->after('description');
            $table->json('duration')->nullable()->after('location');
            $table->json('meeting_point')->nullable()->after('duration');
            $table->string('price')->nullable()->after('meeting_point');
            $table->json('gallery_images')->nullable()->after('image');
            $table->json('highlights')->nullable()->after('what_to_bring');
            $table->json('itinerary')->nullable()->after('highlights');
        });
    }

    public function down(): void
    {
        Schema::table('tourist_trips', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'location',
                'duration',
                'meeting_point',
                'price',
                'gallery_images',
                'highlights',
                'itinerary',
            ]);
        });
    }
};
