<?php

namespace App\Actions;

use App\Data\CreateBlogPostData;
use App\Models\BlogPost;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateBlogPost
{
    use AsAction;

    public const PLACEHOLDER_FEATURED_IMAGE = 'images/use_case.svg';

    public function handle(CreateBlogPostData $data): BlogPost
    {
        $slugSource = $data->slug ?? $data->title_nl;

        return BlogPost::query()->create([
            'title_nl' => $data->title_nl,
            'title_en' => $data->title_en,
            'excerpt_nl' => $data->excerpt_nl,
            'excerpt_en' => $data->excerpt_en,
            'content_nl' => $data->content_nl,
            'content_en' => $data->content_en,
            'slug' => GenerateUniqueBlogPostSlug::run($slugSource),
            'featured_image' => $data->featured_image ?? self::PLACEHOLDER_FEATURED_IMAGE,
            'published_at' => null,
        ]);
    }
}
