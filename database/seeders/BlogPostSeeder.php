<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        BlogPost::query()->where('slug', 'like', 'sample-blog-post-%')->delete();
        BlogPost::query()->where('slug', 'like', 'draft-sample-%')->delete();

        foreach (range(1, 15) as $index) {
            BlogPost::factory()->create([
                'title_nl' => "Voorbeeld blogartikel {$index}",
                'title_en' => "Sample blog post {$index}",
                'slug' => 'sample-blog-post-'.$index,
                'excerpt_nl' => 'Korte intro voor dit voorbeeldartikel in het Nederlands.',
                'excerpt_en' => 'A short intro for this sample post in English.',
                'published_at' => now()->subDays($index),
            ]);
        }

        foreach (range(1, 2) as $index) {
            BlogPost::factory()
                ->draft()
                ->create([
                    'title_nl' => "Concept artikel {$index}",
                    'title_en' => "Draft post {$index}",
                    'slug' => 'draft-sample-'.$index,
                ]);
        }
    }
}
