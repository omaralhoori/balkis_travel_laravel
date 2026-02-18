<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::create([
            'name' => 'أحمد يلماز',
            'position' => 'الرئيس التنفيذي',
            'company' => 'شركة البناء',
            'testimonial' => 'التعامل مع هذه المجموعة كان نقطة تحول في استثماراتنا العقارية في إسطنبول. الاحترافية والدقة في التفاصيل تفوق التوقعات.',
            'rating' => 5,
            'avatar' => null,
            'order' => 1,
            'is_active' => true,
        ]);

        Testimonial::create([
            'name' => 'ليلى الشريف',
            'position' => 'مديرة الاستثمار',
            'company' => 'مجموعة الأفق',
            'testimonial' => 'خدمة استثنائية ورؤية ثاقبة للسوق التركي. لقد ساعدونا في تحقيق عوائد ممتازة خلال فترة قصيرة جداً.',
            'rating' => 5,
            'avatar' => null,
            'order' => 2,
            'is_active' => true,
        ]);

        Testimonial::create([
            'name' => 'عمر فاروق',
            'position' => 'مستثمر عقاري',
            'company' => null,
            'testimonial' => 'فريق عمل محترف يقدم حلولاً مبتكرة تناسب تطلعات المستثمر الأجنبي. أنصح بشدة بالتعامل معهم.',
            'rating' => 5,
            'avatar' => null,
            'order' => 3,
            'is_active' => true,
        ]);

        Testimonial::create([
            'name' => 'نورة العلي',
            'position' => 'سيدة أعمال',
            'company' => null,
            'testimonial' => 'المصداقية والشفافية هي العنوان الأبرز لهذه الشركة. تجربتي معهم كانت أكثر من رائعة في جميع المراحل.',
            'rating' => 5,
            'avatar' => null,
            'order' => 4,
            'is_active' => true,
        ]);
    }
}
