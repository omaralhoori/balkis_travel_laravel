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
            $table->string('statistics_badge_text')->nullable()->after('statistics');
            $table->string('statistics_title')->nullable()->after('statistics_badge_text');
            $table->string('statistics_subtitle')->nullable()->after('statistics_title');
            $table->text('statistics_description')->nullable()->after('statistics_subtitle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->dropColumn([
                'statistics_badge_text',
                'statistics_title',
                'statistics_subtitle',
                'statistics_description',
            ]);
        });
    }
};
