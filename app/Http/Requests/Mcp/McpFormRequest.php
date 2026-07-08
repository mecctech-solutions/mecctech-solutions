<?php

namespace App\Http\Requests\Mcp;

use Illuminate\Foundation\Http\FormRequest;

abstract class McpFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    abstract public function rules(): array;
}
