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
        Schema::table('home_pages', function (Blueprint $table) {
            $table->string('map_image')->nullable()->after('statistics_description');
            $table->string('map_location_title')->nullable()->after('map_image');
            $table->string('map_address_line1')->nullable()->after('map_location_title');
            $table->string('map_address_line2')->nullable()->after('map_address_line1');
            $table->string('map_url')->nullable()->after('map_address_line2');
            $table->decimal('map_latitude', 10, 8)->nullable()->after('map_url');
            $table->decimal('map_longitude', 11, 8)->nullable()->after('map_latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->dropColumn([
                'map_image',
                'map_location_title',
                'map_address_line1',
                'map_address_line2',
                'map_url',
                'map_latitude',
                'map_longitude',
            ]);
        });
    }
};
