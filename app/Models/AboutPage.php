<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutPage extends Model
{
    use HasTranslations;

    /** @var array<string> */
    public array $translatable = [
        'hero_title',
        'hero_title_highlight',
        'hero_description',
        'vision_title',
        'vision_description',
        'mission_title',
        'mission_description',
        'timeline_badge',
        'timeline_title',
        'timeline_items',
        'values_title',
        'core_values',
        'team_badge',
        'team_title',
        'team_members',
        'commitment_badge',
        'commitment_title_highlight',
        'commitment_title',
        'commitment_description',
        'commitment_sections',
        'compliance_title',
        'compliance_description',
        'contact_question',
        'contact_description',
    ];

    protected $fillable = [
        'hero_title',
        'hero_title_highlight',
        'hero_description',
        'hero_background_image',
        'is_hero_visible',
        'vision_icon',
        'vision_title',
        'vision_description',
        'mission_icon',
        'mission_title',
        'mission_description',
        'is_vision_mission_visible',
        'timeline_badge',
        'timeline_title',
        'timeline_items',
        'is_timeline_visible',
        'values_title',
        'core_values',
        'is_values_visible',
        'team_badge',
        'team_title',
        'team_members',
        'is_team_visible',
        'commitment_badge',
        'commitment_title',
        'commitment_title_highlight',
        'commitment_description',
        'commitment_sections',
        'is_commitment_visible',
        'compliance_title',
        'compliance_description',
        'compliance_email',
        'is_compliance_visible',
        'contact_question',
        'contact_description',
        'is_contact_visible',
    ];

    protected $casts = [
        'timeline_items' => 'array',
        'core_values' => 'array',
        'team_members' => 'array',
        'commitment_sections' => 'array',
        'is_hero_visible' => 'boolean',
        'is_vision_mission_visible' => 'boolean',
        'is_timeline_visible' => 'boolean',
        'is_values_visible' => 'boolean',
        'is_team_visible' => 'boolean',
        'is_commitment_visible' => 'boolean',
        'is_compliance_visible' => 'boolean',
        'is_contact_visible' => 'boolean',
    ];

    public function getHeroBackgroundImageUrlAttribute(): ?string
    {
        if (! $this->hero_background_image) {
            return 'https://lh3.googleusercontent.com/aida-public/AB6AXuAB9BBRm56rmgNJx_Kcp9tcTfI5S_HLGq8KveH-Lk0zA2tpWj6LJQhlm7YSWc0Fhdgcsj-Pj36vW7lE7pCVj6lw7-7Fwh5OZNFGehnT8gK7FqZX9JmRYiJxYA918pyJiwmHg-Kq2KLZ2XB2iz4Q2Eafk2a48gPix7DDvopx-TaW_uStJ9UKuonftdmqVln2E7eimIj3mR8N3bGP2IGjR1ayBs-R1b-A6Kw2k-4-yIQLD2mwFvluGzyAiyELUieWRxfb5XFp3U-rAx9k';
        }

        return asset('storage/'.$this->hero_background_image);
    }

    public function getTeamMemberImageUrl(array $member): ?string
    {
        if (! isset($member['image']) || ! $member['image']) {
            return null;
        }

        return asset('storage/'.$member['image']);
    }

    public static function getCurrent(): self
    {
        return static::firstOrCreate([], [
            'hero_title' => 'التميز في كل تفصيل',
            'hero_title_highlight' => 'التميز',
            'hero_description' => 'مجموعة بلقيس المميزة: عقود من الريادة في صياغة مفهوم جديد للفخامة والاستثمار الاستراتيجي في قلب تركيا.',
            'vision_icon' => 'visibility',
            'vision_title' => 'رؤيتنا',
            'vision_description' => 'أن نكون الخيار الأول والوجهة الأكثر موثوقية للمستثمرين الباحثين عن التفرد والتميز في تركيا، من خلال وضع معايير جديدة في قطاع الخدمات الفاخرة وإدارة الأصول.',
            'mission_icon' => 'rocket_launch',
            'mission_title' => 'رسالتنا',
            'mission_description' => 'توفير حلول استثمارية متكاملة تتجاوز التوقعات، تجمع بين المعرفة العميقة بالسوق المحلي والمعايير العالمية للخدمة، لضمان نمو وازدهار ثروات عملائنا.',
            'timeline_badge' => 'مسيرتنا',
            'timeline_title' => 'تاريخ حافل بالنجاحات',
            'values_title' => 'قيمنا الجوهرية',
            'team_badge' => 'فريق العمل',
            'team_title' => 'القيادة التنفيذية',
            'commitment_badge' => 'الالتزام المهني',
            'commitment_title' => 'معاييرنا هي',
            'commitment_title_highlight' => 'ميثاق شرفنا',
            'commitment_description' => 'تلتزم مجموعة بلقيس المميزة بأعلى مستويات الاحترافية والنزاهة الأخلاقية. إن سياسة العمل لدينا ليست مجرد قواعد، بل هي انعكاس لقيمنا في التميز والجودة والالتزام تجاه عملائنا وشركائنا في تركيا وحول العالم.',
            'compliance_title' => 'الامتثال القانوني والتنظيمي',
            'compliance_description' => 'تؤكد مجموعة بلقيس المميزة على التزامها المطلق بكافة القوانين والأنظمة المعمول بها في الجمهورية التركية. نحن نعمل بتنسيق كامل مع الجهات التنظيمية لضمان قانونية وسلامة كافة الاستثمارات والتحويلات المالية، مما يوفر لعملائنا بيئة استثمارية آمنة ومستقرة تماماً.',
            'compliance_email' => 'compliance@balkispremium.com',
            'contact_question' => 'هل لديك استفسار حول سياساتنا؟',
            'contact_description' => 'فريق الامتثال لدينا متاح للإجابة على كافة تساؤلاتكم المهنية.',
        ]);
    }
}
