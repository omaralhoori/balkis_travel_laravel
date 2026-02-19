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
            $table->string('location')->nullable()->after('url');
            $table->string('area')->nullable()->after('location');
            $table->string('rooms')->nullable()->after('area');
            $table->string('annual_return')->nullable()->after('rooms');
            $table->boolean('citizenship_eligible')->default(false)->after('annual_return');
            $table->string('price')->nullable()->after('citizenship_eligible');
            $table->json('gallery_images')->nullable()->after('price');
            $table->json('features')->nullable()->after('gallery_images');
            $table->text('overview')->nullable()->after('features');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn([
                'location',
                'area',
                'rooms',
                'annual_return',
                'citizenship_eligible',
                'price',
                'gallery_images',
                'features',
                'overview',
            ]);
        });
    }
};
