<?php

namespace App\Mcp\Tools;

use App\Actions\UpdateBlogPost as UpdateBlogPostAction;
use App\Data\BlogPostData;
use App\Mcp\Concerns\HandlesBlogToolRequests;
use App\Models\BlogPost;
use Generator;
use Illuminate\Support\Arr;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\Title;
use Laravel\Mcp\Server\Tools\ToolInputSchema;
use Laravel\Mcp\Server\Tools\ToolResult;

#[Title('Update Blog Post')]
class UpdateBlogPost extends Tool
{
    use HandlesBlogToolRequests;

    public function description(): string
    {
        return 'Update the content of an existing blog post identified by id. This is a partial (patch) '
            .'update: only the fields you provide are changed, the rest are left untouched. '
            .'Publication status is not changed here; use publish-blog-post or unpublish-blog-post for that.';
    }

    public function schema(ToolInputSchema $schema): ToolInputSchema
    {
        $schema->integer('id')->description('The id of the blog post to update.')->required();
        $schema->string('title_nl')->description('Dutch title.');
        $schema->string('title_en')->description('English title.');
        $schema->string('content_nl')->description('Dutch body (HTML).');
        $schema->string('content_en')->description('English body (HTML).');
        $schema->string('excerpt_nl')->description('Dutch excerpt.');
        $schema->string('excerpt_en')->description('English excerpt.');
        $schema->string('slug')->description('URL slug; re-checked for uniqueness when provided.');
        $schema->string('featured_image')->description('Path to an existing image on the public disk.');

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
            'title_nl' => ['sometimes', 'string', 'max:255'],
            'title_en' => ['sometimes', 'string', 'max:255'],
            'content_nl' => ['sometimes', 'string'],
            'content_en' => ['sometimes', 'string'],
            'excerpt_nl' => ['sometimes', 'nullable', 'string'],
            'excerpt_en' => ['sometimes', 'nullable', 'string'],
            'slug' => ['sometimes', 'string', 'max:255'],
            'featured_image' => ['sometimes', 'string', 'max:255'],
        ]);

        if ($validated instanceof ToolResult) {
            return $validated;
        }

        $blogPost = BlogPost::query()->findOrFail((int) $validated['id']);
        $attributes = Arr::except($validated, ['id']);

        $blogPost = UpdateBlogPostAction::run($blogPost, $attributes);

        return ToolResult::json(BlogPostData::fromModel($blogPost)->toArray());
    }
}
