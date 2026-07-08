<?php

namespace App\Actions;

use App\Models\BlogPost;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class PublishBlogPost
{
    use AsAction;

    public function handle(BlogPost $blogPost, ?CarbonInterface $publishedAt = null): BlogPost
    {
        $blogPost->published_at = $publishedAt ?? Carbon::now();
        $blogPost->save();

        return $blogPost;
    }
}
