<?php

namespace App\Mcp\Tools;

use App\Actions\GetAllBlogPosts;
use App\Enums\BlogAbility;
use App\Http\Requests\Mcp\ListBlogPostsRequest;
use App\Mcp\Concerns\HandlesBlogToolRequests;
use Generator;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\Title;
use Laravel\Mcp\Server\Tools\ToolInputSchema;
use Laravel\Mcp\Server\Tools\ToolResult;

#[Title('List Blog Posts')]
class ListBlogPosts extends Tool
{
    use HandlesBlogToolRequests;

    public function description(): string
    {
        return 'List blog posts (including drafts) with pagination. Optionally filter by status '
            .'(all, draft, published) and search on the Dutch or English title. Returns a paginated '
            .'result with data and pagination metadata (current_page, last_page, total, per_page).';
    }

    public function schema(ToolInputSchema $schema): ToolInputSchema
    {
        $schema->string('search')->description('Optional search term matched against title_nl and title_en.');
        $schema->string('status')->description('Filter by status: all (default), draft, or published.');
        $schema->integer('page')->description('Page number, defaults to 1.');
        $schema->integer('per_page')->description('Results per page (1-100), defaults to 15.');

        return $schema;
    }

    /**
     * @param  array<string, mixed>  $arguments
     */
    public function handle(array $arguments): ToolResult|Generator
    {
        if ($missing = $this->missingAbility(BlogAbility::Read)) {
            return $missing;
        }

        $validated = $this->validateArguments($arguments, new ListBlogPostsRequest);

        if ($validated instanceof ToolResult) {
            return $validated;
        }

        $paginator = GetAllBlogPosts::run(
            $validated['search'] ?? null,
            $validated['status'] ?? 'all',
            $validated['per_page'] ?? null,
            $validated['page'] ?? null,
        );

        return ToolResult::json($paginator->toArray());
    }
}
