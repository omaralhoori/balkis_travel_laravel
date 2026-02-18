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
        Schema::table('about_pages', function (Blueprint $table) {
            $table->boolean('is_hero_visible')->default(true)->after('hero_background_image');
            $table->boolean('is_vision_mission_visible')->default(true)->after('mission_description');
            $table->boolean('is_timeline_visible')->default(true)->after('timeline_items');
            $table->boolean('is_values_visible')->default(true)->after('core_values');
            $table->boolean('is_team_visible')->default(true)->after('team_members');
            $table->boolean('is_commitment_visible')->default(true)->after('commitment_sections');
            $table->boolean('is_compliance_visible')->default(true)->after('compliance_email');
            $table->boolean('is_contact_visible')->default(true)->after('contact_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropColumn([
                'is_hero_visible',
                'is_vision_mission_visible',
                'is_timeline_visible',
                'is_values_visible',
                'is_team_visible',
                'is_commitment_visible',
                'is_compliance_visible',
                'is_contact_visible',
            ]);
        });
    }
};
