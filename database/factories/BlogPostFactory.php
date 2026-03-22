<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<BlogPost>
 */
class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition(): array
    {
        $titleNl = fake()->sentence();

        return [
            'title_nl' => $titleNl,
            'title_en' => fake()->sentence(),
            'slug' => Str::slug($titleNl).'-'.uniqid(),
            'excerpt_nl' => fake()->optional()->paragraph(),
            'excerpt_en' => fake()->optional()->paragraph(),
            'content_nl' => '<p>'.fake()->paragraphs(2, true).'</p>',
            'content_en' => '<p>'.fake()->paragraphs(2, true).'</p>',
            'featured_image' => 'images/use_case.svg',
            'published_at' => now()->subDay(),
        ];
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'published_at' => null,
        ]);
    }

    public function scheduled(): static
    {
        return $this->state(fn (array $attributes) => [
            'published_at' => now()->addWeek(),
        ]);
    }
}
