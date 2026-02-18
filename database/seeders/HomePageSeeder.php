<?php

namespace Database\Seeders;

use App\Models\HomePage;
use App\Models\HomePageService;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homePage = HomePage::firstOrCreate([], [
            'main_title' => 'مجموعة بلقيس',
            'main_subtitle' => 'للاستثمارات الفاخرة',
            'main_description' => 'اكتشف قمة السياحة الفاخرة في تركيا، والعقارات المتميزة، والاستثمارات الاستراتيجية. نحن نصنع تجارب لا تُنسى ومستقبلاً واعداً.',
            'main_badge_text' => 'التميز والفخامة',
            'main_badge_icon' => 'stars',
            'main_background_image' => null,
            'cta_button_text' => 'استكشف خدماتنا',
            'video_button_text' => 'شاهد الفيديو',
        ]);

        // Tourism Service
        HomePageService::firstOrCreate(
            ['service_key' => 'tourism'],
            [
                'home_page_id' => $homePage->id,
                'title' => 'مجموعة بلقيس',
                'subtitle' => 'للسياحة الفاخرة',
                'description' => 'اكتشف قمة السياحة الفاخرة في تركيا. رحلات حصرية، فنادق فاخرة، وتجارب لا تُنسى في أجمل مدن العالم. نحن نصنع ذكريات تبقى معك مدى الحياة.',
                'badge_text' => 'التميز والفخامة',
                'badge_icon' => 'stars',
                'background_image' => null,
                'card_image' => null,
                'card_title' => 'السياحة',
                'card_description' => 'رحلات فاخرة وتجارب فريدة في إسطنبول',
                'card_icon' => 'flight',
                'order' => 1,
                'is_active' => true,
                'stats' => [
                    ['value' => '١٥+', 'label' => 'سنة خبرة'],
                    ['value' => '٥٠٠+', 'label' => 'مشروع ناجح'],
                    ['value' => '٢٤/٧', 'label' => 'دعم كبار الشخصيات'],
                ],
            ]
        );

        // Real Estate Service
        HomePageService::firstOrCreate(
            ['service_key' => 'realestate'],
            [
                'home_page_id' => $homePage->id,
                'title' => 'مجموعة بلقيس',
                'subtitle' => 'للعقارات الفاخرة',
                'description' => 'استثمر في عقارات تركيا المتميزة. فلل فاخرة، شقق راقية، وقصور بإطلالات خلابة. نضمن لك أفضل العوائد الاستثمارية مع ضمانات حكومية كاملة.',
                'badge_text' => 'الاستثمار الذكي',
                'badge_icon' => 'home_work',
                'background_image' => null,
                'card_image' => null,
                'card_title' => 'العقارات',
                'card_description' => 'فلل وقصور بإطلالات خلابة',
                'card_icon' => 'home_work',
                'order' => 2,
                'is_active' => true,
                'stats' => [
                    ['value' => '١٠٠٠+', 'label' => 'عقار متاح'],
                    ['value' => '٩٥%', 'label' => 'معدل الرضا'],
                    ['value' => 'ضمان', 'label' => 'حكومي كامل'],
                ],
            ]
        );

        // Investment Service
        HomePageService::firstOrCreate(
            ['service_key' => 'investment'],
            [
                'home_page_id' => $homePage->id,
                'title' => 'مجموعة بلقيس',
                'subtitle' => 'للاستثمارات الاستراتيجية',
                'description' => 'فرص استثمارية حصرية بعوائد عالية ومضمونة. استثمر في قطاعات متعددة مع فريق من الخبراء الماليين والقانونيين لضمان نجاح استثماراتك.',
                'badge_text' => 'النمو المستدام',
                'badge_icon' => 'trending_up',
                'background_image' => null,
                'card_image' => null,
                'card_title' => 'الاستثمار',
                'card_description' => 'فرص استثمارية بعوائد عالية',
                'card_icon' => 'trending_up',
                'order' => 3,
                'is_active' => true,
                'stats' => [
                    ['value' => '٢٠%+', 'label' => 'عائد سنوي'],
                    ['value' => '١٠٠+', 'label' => 'مستثمر راضٍ'],
                    ['value' => 'مضمون', 'label' => 'عوائد آمنة'],
                ],
            ]
        );
    }
}
