<?php

namespace App\Actions;

use App\Models\OutreachTemplate;
use App\Models\Prospect;
use Lorisleiva\Actions\Concerns\AsAction;

class RenderOutreachTemplate
{
    use AsAction;

    /**
     * Substitute the whitelisted placeholders in a template's subject and body
     * with a prospect's details.
     *
     * Placeholders are replaced via a whitelist regex, never Blade. Template
     * content is stored in the database and edited through the admin panel;
     * compiling it as Blade would turn any stored markup into executable PHP,
     * so admin-panel XSS or a stolen session would become remote code execution.
     * An unknown placeholder is left untouched so it stays visible in the
     * preview rather than silently vanishing.
     *
     * @return array{subject: string, body: string}
     */
    public function handle(OutreachTemplate $template, Prospect $prospect): array
    {
        $replacements = [
            'company_name' => $prospect->name,
            'contact_first_name' => $prospect->contact_first_name ?? '',
            'contact_last_name' => $prospect->contact_last_name ?? '',
            'website' => $prospect->website ?? '',
            'domain' => $prospect->domain,
        ];

        return [
            'subject' => $this->substitute($template->subject, $replacements),
            'body' => $this->substitute($template->body, $replacements),
        ];
    }

    /**
     * @param  array<string, string>  $replacements
     */
    private function substitute(string $content, array $replacements): string
    {
        return (string) preg_replace_callback(
            '/\{\{\s*(\w+)\s*\}\}/',
            static fn (array $matches): string => $replacements[$matches[1]] ?? $matches[0],
            $content
        );
    }
}
