<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->boolean('welcome_popup_enabled')->default(false)->after('stats_programs_count');
            $table->json('welcome_popup_message')->nullable()->after('welcome_popup_enabled');
            $table->foreignId('welcome_popup_custom_form_id')
                ->nullable()
                ->after('welcome_popup_message')
                ->constrained('custom_forms')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->dropForeign(['welcome_popup_custom_form_id']);
            $table->dropColumn([
                'welcome_popup_enabled',
                'welcome_popup_message',
                'welcome_popup_custom_form_id',
            ]);
        });
    }
};
