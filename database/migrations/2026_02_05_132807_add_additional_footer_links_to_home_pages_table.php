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
            // Additional Social Media Links
            $table->string('footer_facebook_url')->nullable()->after('footer_instagram_url');
            $table->string('footer_youtube_url')->nullable()->after('footer_facebook_url');
            $table->string('footer_snapchat_url')->nullable()->after('footer_youtube_url');
            $table->string('footer_tiktok_url')->nullable()->after('footer_snapchat_url');

            // Additional Quick Links
            $table->string('footer_tourism_url')->nullable()->after('footer_blog_url');
            $table->string('footer_realestate_url')->nullable()->after('footer_tourism_url');
            $table->string('footer_investment_url')->nullable()->after('footer_realestate_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->dropColumn([
                'footer_facebook_url',
                'footer_youtube_url',
                'footer_snapchat_url',
                'footer_tiktok_url',
                'footer_tourism_url',
                'footer_realestate_url',
                'footer_investment_url',
            ]);
        });
    }
};
