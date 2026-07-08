<?php

namespace App\Mcp\Tools;

use App\Actions\UnpublishBlogPost as UnpublishBlogPostAction;
use App\Data\BlogPostData;
use App\Mcp\Concerns\HandlesBlogToolRequests;
use App\Models\BlogPost;
use Generator;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\Title;
use Laravel\Mcp\Server\Tools\ToolInputSchema;
use Laravel\Mcp\Server\Tools\ToolResult;

#[Title('Unpublish Blog Post')]
class UnpublishBlogPost extends Tool
{
    use HandlesBlogToolRequests;

    public function description(): string
    {
        return 'Unpublish a blog post by id, reverting it to a draft by clearing its published_at. '
            .'The post is removed from the public site but its content is kept.';
    }

    public function schema(ToolInputSchema $schema): ToolInputSchema
    {
        $schema->integer('id')->description('The id of the blog post to unpublish.')->required();

        return $schema;
    }

    /**
     * @param  array<string, mixed>  $arguments
     */
    public function handle(array $arguments): ToolResult|Generator
    {
        if ($missing = $this->missingAbility('blog:write')) {
            return $missing;
        }

        $validated = $this->validateArguments($arguments, [
            'id' => ['required', 'integer', 'exists:blog_posts,id'],
        ]);

        if ($validated instanceof ToolResult) {
            return $validated;
        }

        $blogPost = BlogPost::query()->findOrFail((int) $validated['id']);

        $blogPost = UnpublishBlogPostAction::run($blogPost);

        return ToolResult::json(BlogPostData::fromModel($blogPost)->toArray());
    }
}
