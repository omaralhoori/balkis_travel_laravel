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
            $table->integer('tourist_guide_offset')->default(0)->after('destinations');
            $table->timestamp('tourist_guide_last_rotated_at')->nullable()->after('tourist_guide_offset');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->dropColumn(['tourist_guide_offset', 'tourist_guide_last_rotated_at']);
        });
    }
};
