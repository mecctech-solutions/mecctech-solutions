<?php

namespace App\Mcp\Tools;

use App\Actions\CreateBlogPost as CreateBlogPostAction;
use App\Data\BlogPostData;
use App\Data\CreateBlogPostData;
use App\Enums\BlogAbility;
use App\Http\Requests\Mcp\CreateBlogPostRequest;
use App\Mcp\Concerns\HandlesBlogToolRequests;
use Generator;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\Title;
use Laravel\Mcp\Server\Tools\ToolInputSchema;
use Laravel\Mcp\Server\Tools\ToolResult;

#[Title('Create Blog Post')]
class CreateBlogPost extends Tool
{
    use HandlesBlogToolRequests;

    public function description(): string
    {
        return 'Create a new blog post as a draft. Provide both Dutch (nl) and English (en) content; '
            .'the post is created unpublished, use publish-blog-post to make it live. '
            .'The slug is generated automatically from title_nl unless provided, and featured_image '
            .'falls back to a placeholder when omitted.';
    }

    public function schema(ToolInputSchema $schema): ToolInputSchema
    {
        $schema->string('title_nl')->description('Dutch title.')->required();
        $schema->string('title_en')->description('English title.')->required();
        $schema->string('content_nl')->description('Dutch body (HTML).')->required();
        $schema->string('content_en')->description('English body (HTML).')->required();
        $schema->string('excerpt_nl')->description('Optional Dutch excerpt.');
        $schema->string('excerpt_en')->description('Optional English excerpt.');
        $schema->string('slug')->description('Optional URL slug; auto-generated from title_nl when omitted.');
        $schema->string('featured_image')->description('Optional path to an existing image on the public disk.');

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

        $validated = $this->validateArguments($arguments, new CreateBlogPostRequest);

        if ($validated instanceof ToolResult) {
            return $validated;
        }

        $blogPost = CreateBlogPostAction::run(CreateBlogPostData::from($validated));

        return ToolResult::json(BlogPostData::fromModel($blogPost)->toArray());
    }
}
