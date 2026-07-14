<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_forms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('background_image_path')->nullable();
            $table->string('primary_color')->default('#C6A264');
            $table->string('button_color')->default('#765C39');
            $table->string('text_color')->default('#4A566C');
            $table->string('thank_you_title')->nullable();
            $table->text('thank_you_message')->nullable();
            $table->string('whatsapp_button_label')->nullable();
            $table->text('whatsapp_message_template')->nullable();
            $table->string('notification_email_primary')->nullable();
            $table->string('notification_email_secondary')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_forms');
    }
};
