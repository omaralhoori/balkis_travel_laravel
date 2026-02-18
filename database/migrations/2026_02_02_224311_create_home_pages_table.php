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
        if (! Schema::hasTable('home_pages')) {
            Schema::create('home_pages', function (Blueprint $table) {
                $table->id();

                // Home Page Fields (from home.blade.php and HomePageForm)
                $table->string('main_title')->nullable();
                $table->text('main_description')->nullable();
                $table->string('main_background_image')->nullable();
                $table->json('destinations')->nullable();

                // Footer Section (from footer.blade.php)
                $table->string('footer_brand_name')->nullable();
                $table->text('footer_brand_description')->nullable();
                $table->string('footer_linkedin_url')->nullable();
                $table->string('footer_twitter_url')->nullable();
                $table->string('footer_instagram_url')->nullable();
                $table->string('footer_facebook_url')->nullable();
                $table->string('footer_youtube_url')->nullable();
                $table->string('footer_snapchat_url')->nullable();
                $table->string('footer_tiktok_url')->nullable();
                $table->string('footer_about_url')->nullable();
                $table->string('footer_projects_url')->nullable();
                $table->string('footer_services_url')->nullable();
                $table->string('footer_blog_url')->nullable();
                $table->string('footer_tourism_url')->nullable();
                $table->string('footer_realestate_url')->nullable();
                $table->string('footer_investment_url')->nullable();
                $table->string('footer_phone')->nullable();
                $table->string('footer_email')->nullable();
                $table->string('footer_working_hours')->nullable();
                $table->text('footer_copyright_text')->nullable();
                $table->string('footer_privacy_policy_url')->nullable();
                $table->string('footer_terms_url')->nullable();

                $table->timestamps();
            });
        } else {
            // If table exists, modify it to match the new structure
            Schema::table('home_pages', function (Blueprint $table) {
                // Add destinations if it doesn't exist
                if (! Schema::hasColumn('home_pages', 'destinations')) {
                    $table->json('destinations')->nullable()->after('main_background_image');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};
