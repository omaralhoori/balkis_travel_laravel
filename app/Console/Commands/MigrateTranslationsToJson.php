<?php

namespace App\Console\Commands;

use App\Models\AboutPage;
use App\Models\BlogPost;
use App\Models\HomePage;
use App\Models\HomePageService;
use App\Models\Program;
use App\Models\Testimonial;
use App\Models\Translation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateTranslationsToJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:translations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate translations from translations table to JSON columns';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Starting translation migration...');

        $this->migratePrograms();
        $this->migrateBlogPosts();
        $this->migrateAboutPages();
        $this->migrateHomePages();
        $this->migrateHomePageServices();
        $this->migrateTestimonials();

        $this->info('Translation migration completed successfully!');

        return Command::SUCCESS;
    }

    protected function migratePrograms(): void
    {
        $this->info('Migrating Programs...');
        $translatableFields = ['title', 'description', 'category'];
        $chunkSize = 100;
        $processed = 0;

        Program::chunk($chunkSize, function ($programs) use ($translatableFields, &$processed) {
            foreach ($programs as $program) {
                $updates = [];

                foreach ($translatableFields as $field) {
                    $translations = $this->buildTranslationsArray($program, $field);
                    if (! empty($translations)) {
                        $updates["{$field}_translations"] = json_encode($translations);
                    }
                }

                if (! empty($updates)) {
                    DB::table('programs')
                        ->where('id', $program->id)
                        ->update($updates);
                }

                $processed++;
            }
        });

        $this->info("Migrated {$processed} programs.");
    }

    protected function migrateBlogPosts(): void
    {
        $this->info('Migrating BlogPosts...');
        $translatableFields = [
            'title',
            'excerpt',
            'content',
            'category',
            'meta_title',
            'meta_description',
            'meta_keywords',
        ];
        $chunkSize = 100;
        $processed = 0;

        BlogPost::chunk($chunkSize, function ($blogPosts) use ($translatableFields, &$processed) {
            foreach ($blogPosts as $blogPost) {
                $updates = [];

                foreach ($translatableFields as $field) {
                    $translations = $this->buildTranslationsArray($blogPost, $field);
                    if (! empty($translations)) {
                        $updates["{$field}_translations"] = json_encode($translations);
                    }
                }

                if (! empty($updates)) {
                    DB::table('blog_posts')
                        ->where('id', $blogPost->id)
                        ->update($updates);
                }

                $processed++;
            }
        });

        $this->info("Migrated {$processed} blog posts.");
    }

    protected function migrateAboutPages(): void
    {
        $this->info('Migrating AboutPages...');
        $translatableFields = [
            'hero_title',
            'hero_title_highlight',
            'hero_description',
            'vision_title',
            'vision_description',
            'mission_title',
            'mission_description',
            'timeline_badge',
            'timeline_title',
            'values_title',
            'team_badge',
            'team_title',
            'commitment_badge',
            'commitment_title',
            'commitment_title_highlight',
            'commitment_description',
            'compliance_title',
            'compliance_description',
            'contact_question',
            'contact_description',
        ];
        $processed = 0;

        AboutPage::chunk(50, function ($aboutPages) use ($translatableFields, &$processed) {
            foreach ($aboutPages as $aboutPage) {
                $updates = [];

                foreach ($translatableFields as $field) {
                    $translations = $this->buildTranslationsArray($aboutPage, $field);
                    if (! empty($translations)) {
                        $updates["{$field}_translations"] = json_encode($translations);
                    }
                }

                if (! empty($updates)) {
                    DB::table('about_pages')
                        ->where('id', $aboutPage->id)
                        ->update($updates);
                }

                $processed++;
            }
        });

        $this->info("Migrated {$processed} about pages.");
    }

    /**
     * Build translations array for a specific field
     * Returns array like: ['ar' => 'value', 'en' => 'translated_value', ...]
     */
    protected function buildTranslationsArray($model, string $field): array
    {
        $translations = [];

        // Get the Arabic value from the main column (default locale)
        $arabicValue = $model->getRawOriginal($field) ?? $model->getAttribute($field);
        if ($arabicValue !== null) {
            $translations['ar'] = $arabicValue;
        }

        // Get translations from the translations table
        $translationRecords = Translation::where('translatable_type', get_class($model))
            ->where('translatable_id', $model->id)
            ->where('field', $field)
            ->get();

        foreach ($translationRecords as $translation) {
            if ($translation->value !== null) {
                $translations[$translation->locale] = $translation->value;
            }
        }

        return $translations;
    }

    protected function migrateHomePages(): void
    {
        $this->info('Migrating HomePages...');
        $translatableFields = [
            'main_title',
            'main_subtitle',
            'main_description',
            'main_badge_text',
            'cta_button_text',
            'video_button_text',
            'statistics_title',
            'statistics_subtitle',
            'statistics_description',
            'statistics_badge_text',
            'map_location_title',
            'map_address_line1',
            'map_address_line2',
            'footer_brand_name',
            'footer_brand_description',
            'footer_copyright_text',
        ];
        $processed = 0;

        HomePage::chunk(50, function ($homePages) use ($translatableFields, &$processed) {
            foreach ($homePages as $homePage) {
                $updates = [];

                foreach ($translatableFields as $field) {
                    $translations = $this->buildTranslationsArray($homePage, $field);
                    if (! empty($translations)) {
                        $updates["{$field}_translations"] = json_encode($translations);
                    }
                }

                if (! empty($updates)) {
                    DB::table('home_pages')
                        ->where('id', $homePage->id)
                        ->update($updates);
                }

                $processed++;
            }
        });

        $this->info("Migrated {$processed} home pages.");
    }

    protected function migrateHomePageServices(): void
    {
        $this->info('Migrating HomePageServices...');
        $translatableFields = [
            'title',
            'subtitle',
            'description',
            'badge_text',
            'card_title',
            'card_description',
            'cta_button_text',
        ];
        $chunkSize = 100;
        $processed = 0;

        HomePageService::chunk($chunkSize, function ($services) use ($translatableFields, &$processed) {
            foreach ($services as $service) {
                $updates = [];

                foreach ($translatableFields as $field) {
                    $translations = $this->buildTranslationsArray($service, $field);
                    if (! empty($translations)) {
                        $updates["{$field}_translations"] = json_encode($translations);
                    }
                }

                if (! empty($updates)) {
                    DB::table('home_page_services')
                        ->where('id', $service->id)
                        ->update($updates);
                }

                $processed++;
            }
        });

        $this->info("Migrated {$processed} home page services.");
    }

    protected function migrateTestimonials(): void
    {
        $this->info('Migrating Testimonials...');
        $translatableFields = [
            'name',
            'position',
            'company',
            'testimonial',
        ];
        $chunkSize = 100;
        $processed = 0;

        Testimonial::chunk($chunkSize, function ($testimonials) use ($translatableFields, &$processed) {
            foreach ($testimonials as $testimonial) {
                $updates = [];

                foreach ($translatableFields as $field) {
                    $translations = $this->buildTranslationsArray($testimonial, $field);
                    if (! empty($translations)) {
                        $updates["{$field}_translations"] = json_encode($translations);
                    }
                }

                if (! empty($updates)) {
                    DB::table('testimonials')
                        ->where('id', $testimonial->id)
                        ->update($updates);
                }

                $processed++;
            }
        });

        $this->info("Migrated {$processed} testimonials.");
    }
}
