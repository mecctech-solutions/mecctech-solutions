<?php

namespace App\Mcp\Tools;

use App\Data\BlogPostData;
use App\Mcp\Concerns\HandlesBlogToolRequests;
use App\Models\BlogPost;
use Generator;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\Title;
use Laravel\Mcp\Server\Tools\ToolInputSchema;
use Laravel\Mcp\Server\Tools\ToolResult;

#[Title('Get Blog Post')]
class GetBlogPost extends Tool
{
    use HandlesBlogToolRequests;

    public function description(): string
    {
        return 'Fetch a single blog post by id, including drafts. Returns both language versions '
            .'and the publication status (published_at is null when the post is a draft).';
    }

    public function schema(ToolInputSchema $schema): ToolInputSchema
    {
        $schema->integer('id')->description('The id of the blog post to fetch.')->required();

        return $schema;
    }

    /**
     * @param  array<string, mixed>  $arguments
     */
    public function handle(array $arguments): ToolResult|Generator
    {
        if ($missing = $this->missingAbility('blog:read')) {
            return $missing;
        }

        $validated = $this->validateArguments($arguments, [
            'id' => ['required', 'integer', 'exists:blog_posts,id'],
        ]);

        if ($validated instanceof ToolResult) {
            return $validated;
        }

        $blogPost = BlogPost::query()->findOrFail((int) $validated['id']);

        return ToolResult::json(BlogPostData::fromModel($blogPost)->toArray());
    }
}
