<?php

namespace App\Mcp\Concerns;

use Illuminate\Support\Facades\Validator;
use Laravel\Mcp\Server\Tools\ToolResult;

trait HandlesBlogToolRequests
{
    protected function missingAbility(string $ability): ?ToolResult
    {
        if (request()->user()?->tokenCan($ability)) {
            return null;
        }

        return ToolResult::error("The authenticated token is missing the required '{$ability}' ability.");
    }

    /**
     * @param  array<string, mixed>  $arguments
     * @param  array<string, mixed>  $rules
     * @return array<string, mixed>|ToolResult
     */
    protected function validateArguments(array $arguments, array $rules): array|ToolResult
    {
        $validator = Validator::make($arguments, $rules);

        if ($validator->fails()) {
            return ToolResult::error($validator->errors()->toJson());
        }

        return $validator->validated();
    }
}
