<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exclusive_services', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->string('slug')->nullable()->unique();
            $table->json('description')->nullable();
            $table->string('image')->nullable();
            $table->string('display_image')->nullable();
            $table->json('services')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exclusive_services');
    }
};
