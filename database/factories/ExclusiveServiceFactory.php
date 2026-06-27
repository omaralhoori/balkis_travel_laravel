<?php

namespace Database\Factories;

use App\Models\ExclusiveService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ExclusiveService>
 */
class ExclusiveServiceFactory extends Factory
{
    protected $model = ExclusiveService::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->words(3, true);

        return [
            'title' => ['ar' => $title, 'en' => $title],
            'slug' => Str::slug($title),
            'description' => ['ar' => fake()->paragraph(), 'en' => fake()->paragraph()],
            'image' => null,
            'display_image' => null,
            'services' => [
                ['title' => fake()->words(2, true), 'description' => fake()->sentence()],
                ['title' => fake()->words(2, true), 'description' => fake()->sentence()],
            ],
            'order' => fake()->numberBetween(0, 20),
            'is_active' => true,
        ];
    }
}
