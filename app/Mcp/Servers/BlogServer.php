<?php

namespace App\Mcp\Servers;

use App\Mcp\Tools\CreateBlogPost;
use App\Mcp\Tools\GetBlogPost;
use App\Mcp\Tools\ListBlogPosts;
use App\Mcp\Tools\PublishBlogPost;
use App\Mcp\Tools\UnpublishBlogPost;
use App\Mcp\Tools\UpdateBlogPost;
use Laravel\Mcp\Server;

class BlogServer extends Server
{
    public string $serverName = 'Blog Server';

    public string $serverVersion = '0.0.1';

    public string $instructions = 'Manage blog posts on the MeccTech Solutions website. '
        .'Every post is bilingual: always provide both Dutch (nl) and English (en) title and content. '
        .'Newly created posts are drafts; use publish-blog-post to make them live and unpublish-blog-post '
        .'to revert them to draft. Deleting posts is intentionally not supported.';

    public array $tools = [
        CreateBlogPost::class,
        UpdateBlogPost::class,
        GetBlogPost::class,
        ListBlogPosts::class,
        PublishBlogPost::class,
        UnpublishBlogPost::class,
    ];

    public array $resources = [];

    public array $prompts = [];
}
