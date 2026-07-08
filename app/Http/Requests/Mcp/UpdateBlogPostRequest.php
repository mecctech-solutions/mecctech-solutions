<?php

namespace App\Http\Requests\Mcp;

class UpdateBlogPostRequest extends McpFormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:blog_posts,id'],
            'title_nl' => ['sometimes', 'string', 'max:255'],
            'title_en' => ['sometimes', 'string', 'max:255'],
            'content_nl' => ['sometimes', 'string'],
            'content_en' => ['sometimes', 'string'],
            'excerpt_nl' => ['sometimes', 'nullable', 'string'],
            'excerpt_en' => ['sometimes', 'nullable', 'string'],
            'slug' => ['sometimes', 'string', 'max:255'],
            'featured_image' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
