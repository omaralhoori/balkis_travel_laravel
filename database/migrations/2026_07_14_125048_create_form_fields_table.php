<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custom_form_id')->constrained()->cascadeOnDelete();
            $table->foreignId('form_section_id')->constrained()->cascadeOnDelete();
            $table->string('label');
            $table->string('field_key');
            $table->string('type');
            $table->text('help_text')->nullable();
            $table->json('options')->nullable();
            $table->json('conditional_rules')->nullable();
            $table->boolean('is_required')->default(false);
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();

            $table->unique(['custom_form_id', 'field_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};
