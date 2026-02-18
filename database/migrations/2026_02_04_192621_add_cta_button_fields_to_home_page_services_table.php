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
        Schema::table('home_page_services', function (Blueprint $table) {
            $table->string('cta_button_text')->nullable()->after('card_url');
            $table->string('cta_button_url')->nullable()->after('cta_button_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_page_services', function (Blueprint $table) {
            $table->dropColumn(['cta_button_text', 'cta_button_url']);
        });
    }
};
