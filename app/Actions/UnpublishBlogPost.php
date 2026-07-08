<?php

namespace App\Actions;

use App\Models\BlogPost;
use Lorisleiva\Actions\Concerns\AsAction;

class UnpublishBlogPost
{
    use AsAction;

    public function handle(BlogPost $blogPost): BlogPost
    {
        $blogPost->published_at = null;
        $blogPost->save();

        return $blogPost;
    }
}
