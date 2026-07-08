<?php

namespace App\Console\Commands;

use App\Enums\BlogAbility;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IssueBlogTokenCommand extends Command
{
    protected $signature = 'mcp:issue-blog-token
        {--email=agents@mecctech-solutions.nl : Email of the agent service account}
        {--name=MCP Agent : Name used when the service account is created}
        {--token-name=claude-code : Label for the issued token}';

    protected $description = 'Issue a Sanctum token for the blog MCP server, creating the agent service account if needed';

    public function handle(): int
    {
        $email = (string) $this->option('email');

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => (string) $this->option('name'),
                'password' => Hash::make(Str::random(40)),
            ],
        );

        $abilities = array_map(fn (BlogAbility $ability): string => $ability->value, BlogAbility::cases());

        $token = $user->createToken((string) $this->option('token-name'), $abilities)->plainTextToken;

        $this->info("Token issued for {$email} with abilities: ".implode(', ', $abilities));
        $this->newLine();
        $this->line($token);
        $this->newLine();
        $this->comment('Copy the token now — it will not be shown again.');

        return self::SUCCESS;
    }
}
