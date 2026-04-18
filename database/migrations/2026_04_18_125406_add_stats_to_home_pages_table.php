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
            $table->integer('stats_clients_count')->default(0)->after('about_us');
            $table->integer('stats_services_count')->default(0)->after('stats_clients_count');
            $table->integer('stats_years_count')->default(0)->after('stats_services_count');
            $table->integer('stats_programs_count')->default(0)->after('stats_years_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->dropColumn(['stats_clients_count', 'stats_services_count', 'stats_years_count', 'stats_programs_count']);
        });
    }
};
