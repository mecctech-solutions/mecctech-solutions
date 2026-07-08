<?php

namespace App\Http\Requests\Mcp;

class CreateBlogPostRequest extends McpFormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title_nl' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'content_nl' => ['required', 'string'],
            'content_en' => ['required', 'string'],
            'excerpt_nl' => ['nullable', 'string'],
            'excerpt_en' => ['nullable', 'string'],
            'slug' => ['nullable', 'string', 'max:255'],
            'featured_image' => ['nullable', 'string', 'max:255'],
        ];
    }
}
