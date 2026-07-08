<?php

namespace App\Mcp\Tools;

use App\Actions\PublishBlogPost as PublishBlogPostAction;
use App\Data\BlogPostData;
use App\Enums\BlogAbility;
use App\Http\Requests\Mcp\PublishBlogPostRequest;
use App\Mcp\Concerns\HandlesBlogToolRequests;
use App\Models\BlogPost;
use Generator;
use Illuminate\Support\Carbon;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\Title;
use Laravel\Mcp\Server\Tools\ToolInputSchema;
use Laravel\Mcp\Server\Tools\ToolResult;

#[Title('Publish Blog Post')]
class PublishBlogPost extends Tool
{
    use HandlesBlogToolRequests;

    public function description(): string
    {
        return 'Publish a blog post by id. Without published_at the post goes live immediately; '
            .'provide a future ISO 8601 published_at to schedule it to go live at that moment.';
    }

    public function schema(ToolInputSchema $schema): ToolInputSchema
    {
        $schema->integer('id')->description('The id of the blog post to publish.')->required();
        $schema->string('published_at')->description('Optional ISO 8601 datetime; defaults to now. A future value schedules publication.');

        return $schema;
    }

    /**
     * @param  array<string, mixed>  $arguments
     */
    public function handle(array $arguments): ToolResult|Generator
    {
        if ($missing = $this->missingAbility(BlogAbility::Write)) {
            return $missing;
        }

        $validated = $this->validateArguments($arguments, new PublishBlogPostRequest);

        if ($validated instanceof ToolResult) {
            return $validated;
        }

        $blogPost = BlogPost::query()->findOrFail((int) $validated['id']);

        $publishedAt = isset($validated['published_at'])
            ? Carbon::parse($validated['published_at'])
            : null;

        $blogPost = PublishBlogPostAction::run($blogPost, $publishedAt);

        return ToolResult::json(BlogPostData::fromModel($blogPost)->toArray());
    }
}
