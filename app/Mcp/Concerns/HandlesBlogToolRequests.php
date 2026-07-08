<?php

namespace App\Mcp\Concerns;

use App\Enums\BlogAbility;
use App\Http\Requests\Mcp\McpFormRequest;
use Illuminate\Support\Facades\Validator;
use Laravel\Mcp\Server\Tools\ToolResult;

trait HandlesBlogToolRequests
{
    protected function missingAbility(BlogAbility $ability): ?ToolResult
    {
        if (request()->user()?->tokenCan($ability->value)) {
            return null;
        }

        return ToolResult::error("The authenticated token is missing the required '{$ability->value}' ability.");
    }

    /**
     * @param  array<string, mixed>  $arguments
     * @return array<string, mixed>|ToolResult
     */
    protected function validateArguments(array $arguments, McpFormRequest $request): array|ToolResult
    {
        $validator = Validator::make($arguments, $request->rules());

        if ($validator->fails()) {
            return ToolResult::error($validator->errors()->toJson());
        }

        return $validator->validated();
    }
}
