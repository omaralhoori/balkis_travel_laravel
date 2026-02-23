<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tables and their translatable columns.
     *
     * @var array<string, array<string>>
     */
    private array $translatables = [
        'blog_posts' => ['title', 'excerpt', 'content', 'meta_title', 'meta_description', 'meta_keywords'],
        'programs' => ['title', 'description', 'category', 'overview'],
        'testimonials' => ['testimonial', 'position'],
        'home_pages' => [
            'main_title',
            'main_description',
            'footer_brand_name',
            'footer_brand_description',
        ],
        'home_page_services' => [
            'title', 'subtitle', 'description', 'badge_text',
            'card_title', 'card_description', 'cta_button_text',
        ],
        'about_pages' => [
            'hero_title', 'hero_description',
            'vision_title', 'vision_description',
            'mission_title', 'mission_description',
            'timeline_title', 'values_title', 'team_title',
            'commitment_title', 'commitment_description',
            'compliance_title', 'compliance_description',
            'contact_question', 'contact_description',
        ],
    ];

    public function up(): void
    {
        foreach ($this->translatables as $table => $columns) {
            // Step 1: Make all target columns nullable TEXT first (safe for any content)
            Schema::table($table, function (Blueprint $blueprint) use ($columns) {
                foreach ($columns as $column) {
                    $blueprint->longText($column)->nullable()->change();
                }
            });

            // Step 2: Convert existing plain-text values into JSON {"ar": "value"}
            $rows = DB::table($table)->get();

            foreach ($rows as $row) {
                $updates = [];

                foreach ($columns as $column) {
                    $value = $row->{$column};

                    if ($value === null || $value === '') {
                        // Store empty as valid JSON null or empty object
                        $updates[$column] = $value === '' ? json_encode(['ar' => ''], JSON_UNESCAPED_UNICODE) : null;

                        continue;
                    }

                    // Check if already valid JSON with locale keys
                    $decoded = json_decode($value, true);
                    if (is_array($decoded) && (isset($decoded['ar']) || isset($decoded['en']) || isset($decoded['tr']))) {
                        continue;
                    }

                    $updates[$column] = json_encode(['ar' => $value], JSON_UNESCAPED_UNICODE);
                }

                if (! empty($updates)) {
                    DB::table($table)->where('id', $row->id)->update($updates);
                }
            }

            // Step 3: Now safely change to JSON type (data is already valid JSON)
            Schema::table($table, function (Blueprint $blueprint) use ($columns) {
                foreach ($columns as $column) {
                    $blueprint->json($column)->nullable()->change();
                }
            });
        }
    }

    public function down(): void
    {
        foreach ($this->translatables as $table => $columns) {
            // Extract Arabic value back out of JSON
            $rows = DB::table($table)->get();

            foreach ($rows as $row) {
                $updates = [];

                foreach ($columns as $column) {
                    $value = $row->{$column};

                    if ($value === null) {
                        continue;
                    }

                    $decoded = json_decode($value, true);
                    if (is_array($decoded) && isset($decoded['ar'])) {
                        $updates[$column] = $decoded['ar'];
                    }
                }

                if (! empty($updates)) {
                    DB::table($table)->where('id', $row->id)->update($updates);
                }
            }

            Schema::table($table, function (Blueprint $blueprint) use ($columns) {
                foreach ($columns as $column) {
                    if (in_array($column, ['content'])) {
                        $blueprint->longText($column)->nullable()->change();
                    } elseif (in_array($column, [
                        'excerpt', 'description', 'main_description', 'meta_description',
                        'meta_keywords', 'testimonial', 'hero_description', 'vision_description',
                        'mission_description', 'commitment_description', 'compliance_description',
                        'contact_description', 'statistics_description',
                    ])) {
                        $blueprint->text($column)->nullable()->change();
                    } else {
                        $blueprint->string($column)->nullable()->change();
                    }
                }
            });
        }
    }
};
