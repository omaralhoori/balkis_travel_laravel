<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->json('trip_stages')->nullable()->after('overview');
            $table->json('includes')->nullable()->after('trip_stages');
            $table->integer('min_participants')->nullable()->after('includes');
            $table->integer('max_participants')->nullable()->after('min_participants');
            $table->string('duration')->nullable()->after('max_participants');
            $table->string('departure_location')->nullable()->after('duration');
            $table->string('return_location')->nullable()->after('departure_location');
            $table->string('accommodation_type')->nullable()->after('return_location');
            $table->string('meal_plan')->nullable()->after('accommodation_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn([
                'trip_stages',
                'includes',
                'min_participants',
                'max_participants',
                'duration',
                'departure_location',
                'return_location',
                'accommodation_type',
                'meal_plan',
            ]);
        });
    }
};
