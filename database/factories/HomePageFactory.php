<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HomePage>
 */
class HomePageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_active' => true,
            'main_background_image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDgY6giqkj21tUvclk3yFwACm-TA3MpuiAmhESMAAJH30FG5E4lt2_XTywcqzvo_tHIfTmiA9hjqoMbJe96DTcRbx07K9FiJVUTN6gWYKdvrICMQGbdOZRqq6JE4lG8olMYHgocw45mNjTi4geQCEsHg1YKHdiaEdWZDKs9I_MkCqBnAMRFfDK013HRnHSCcnlUknLqOP0_mkrOjfvmq6hKdsaJtL205T0fFp44s8SqQPysOWE2-gtWdJ5s0_C7mMn83RH_WPbkPkj7',
            'statistics' => [
                [
                    'value' => '١٥+',
                    'label' => 'سنة خبرة',
                    'icon' => 'calendar_today',
                ],
                [
                    'value' => '٥٠٠+',
                    'label' => 'مشروع ناجح',
                    'icon' => 'check_circle',
                ],
                [
                    'value' => '١٠٠٠+',
                    'label' => 'عميل راضٍ',
                    'icon' => 'people',
                ],
                [
                    'value' => '٢٤/٧',
                    'label' => 'دعم مستمر',
                    'icon' => 'support_agent',
                ],
            ],
            'statistics_badge_text' => 'إنجازاتنا',
            'statistics_title' => 'أرقام تتحدث',
            'statistics_subtitle' => null,
            'statistics_description' => 'نحن نفخر بإنجازاتنا وشراكاتنا الاستراتيجية مع نخبة المستثمرين ورجال الأعمال في المنطقة',
            'footer_brand_name' => 'بلقيس القابضة',
            'footer_brand_description' => 'شركة رائدة في مجال الاستثمار العقاري وإدارة الثروات في تركيا، نقدم حلولاً متكاملة للمستثمرين الباحثين عن الفخامة والعائد المجزي.',
            'footer_linkedin_url' => '#',
            'footer_twitter_url' => '#',
            'footer_instagram_url' => '#',
            'footer_facebook_url' => '#',
            'footer_youtube_url' => '#',
            'footer_snapchat_url' => '#',
            'footer_tiktok_url' => '#',
            'footer_about_url' => '#',
            'footer_projects_url' => '#',
            'footer_services_url' => '#',
            'footer_blog_url' => '#',
            'footer_tourism_url' => '#',
            'footer_realestate_url' => '#',
            'footer_investment_url' => '#',
            'footer_phone' => '+90 212 555 0123',
            'footer_email' => 'info@balkispg.com',
            'footer_working_hours' => 'الاثنين - الجمعة: 9:00 - 18:00',
            'footer_copyright_text' => 'بلقيس القابضة. جميع الحقوق محفوظة.',
            'footer_privacy_policy_url' => '#',
            'footer_terms_url' => '#',
        ];
    }
}
