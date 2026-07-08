<?php

namespace App\Http\Requests\Mcp;

class UnpublishBlogPostRequest extends McpFormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:blog_posts,id'],
        ];
    }
}
