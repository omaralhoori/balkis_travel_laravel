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
        Schema::create('home_page_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_page_id')->constrained()->onDelete('cascade');
            $table->string('service_key')->unique(); // tourism, realestate, investment
            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            $table->string('badge_text');
            $table->string('badge_icon');
            $table->string('background_image')->nullable();
            $table->string('card_image')->nullable();
            $table->string('card_title');
            $table->string('card_description');
            $table->string('card_icon');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->json('stats')->nullable(); // [{"value": "15+", "label": "سنة خبرة"}]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_page_services');
    }
};
