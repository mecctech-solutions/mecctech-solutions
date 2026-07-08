<?php

namespace App\Http\Requests\Mcp;

class PublishBlogPostRequest extends McpFormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:blog_posts,id'],
            'published_at' => ['nullable', 'date'],
        ];
    }
}
