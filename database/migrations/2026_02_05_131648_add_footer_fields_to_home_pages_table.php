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
            // Brand Section
            $table->string('footer_brand_name')->nullable()->after('map_longitude');
            $table->text('footer_brand_description')->nullable()->after('footer_brand_name');

            // Social Media Links
            $table->string('footer_linkedin_url')->nullable()->after('footer_brand_description');
            $table->string('footer_twitter_url')->nullable()->after('footer_linkedin_url');
            $table->string('footer_instagram_url')->nullable()->after('footer_twitter_url');

            // Quick Links
            $table->string('footer_about_url')->nullable()->after('footer_instagram_url');
            $table->string('footer_projects_url')->nullable()->after('footer_about_url');
            $table->string('footer_services_url')->nullable()->after('footer_projects_url');
            $table->string('footer_blog_url')->nullable()->after('footer_services_url');

            // Contact Info
            $table->string('footer_phone')->nullable()->after('footer_blog_url');
            $table->string('footer_email')->nullable()->after('footer_phone');
            $table->string('footer_working_hours')->nullable()->after('footer_email');

            // Bottom Bar
            $table->string('footer_copyright_text')->nullable()->after('footer_working_hours');
            $table->string('footer_privacy_policy_url')->nullable()->after('footer_copyright_text');
            $table->string('footer_terms_url')->nullable()->after('footer_privacy_policy_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->dropColumn([
                'footer_brand_name',
                'footer_brand_description',
                'footer_linkedin_url',
                'footer_twitter_url',
                'footer_instagram_url',
                'footer_about_url',
                'footer_projects_url',
                'footer_services_url',
                'footer_blog_url',
                'footer_phone',
                'footer_email',
                'footer_working_hours',
                'footer_copyright_text',
                'footer_privacy_policy_url',
                'footer_terms_url',
            ]);
        });
    }
};
