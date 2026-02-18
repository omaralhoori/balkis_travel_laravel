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
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();
            $table->string('main_title')->default('مجموعة بلقيس');
            $table->string('main_subtitle')->default('للاستثمارات الفاخرة');
            $table->text('main_description')->nullable();
            $table->string('main_badge_text')->default('التميز والفخامة');
            $table->string('main_badge_icon')->default('stars');
            $table->string('main_background_image')->nullable();
            $table->string('cta_button_text')->default('استكشف خدماتنا');
            $table->string('video_button_text')->default('شاهد الفيديو');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};
