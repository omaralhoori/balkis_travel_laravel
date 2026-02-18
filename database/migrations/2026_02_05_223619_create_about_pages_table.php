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
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_title')->default('التميز في كل تفصيل');
            $table->string('hero_title_highlight')->default('التميز');
            $table->text('hero_description')->nullable();
            $table->string('hero_background_image')->nullable();
            
            // Vision & Mission
            $table->string('vision_icon')->default('visibility');
            $table->string('vision_title')->default('رؤيتنا');
            $table->text('vision_description')->nullable();
            $table->string('mission_icon')->default('rocket_launch');
            $table->string('mission_title')->default('رسالتنا');
            $table->text('mission_description')->nullable();
            
            // Timeline Section
            $table->string('timeline_badge')->default('مسيرتنا');
            $table->string('timeline_title')->default('تاريخ حافل بالنجاحات');
            $table->json('timeline_items')->nullable();
            
            // Core Values Section
            $table->string('values_title')->default('قيمنا الجوهرية');
            $table->json('core_values')->nullable();
            
            // Team Section
            $table->string('team_badge')->default('فريق العمل');
            $table->string('team_title')->default('القيادة التنفيذية');
            $table->json('team_members')->nullable();
            
            // Professional Commitment Section
            $table->string('commitment_badge')->default('الالتزام المهني');
            $table->string('commitment_title')->default('معاييرنا هي ميثاق شرفنا');
            $table->string('commitment_title_highlight')->default('ميثاق شرفنا');
            $table->text('commitment_description')->nullable();
            $table->json('commitment_sections')->nullable();
            
            // Compliance Section
            $table->string('compliance_title')->default('الامتثال القانوني والتنظيمي');
            $table->text('compliance_description')->nullable();
            $table->string('compliance_email')->default('compliance@balkispremium.com');
            $table->string('contact_question')->default('هل لديك استفسار حول سياساتنا؟');
            $table->text('contact_description')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
