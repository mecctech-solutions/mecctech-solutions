<?php

namespace App\Actions;

use App\Data\RenderedOutreachTemplateData;
use App\Models\OutreachTemplate;
use App\Models\Prospect;
use Lorisleiva\Actions\Concerns\AsAction;

class RenderOutreachTemplate
{
    use AsAction;

    public const COMPANY_NAME = 'company_name';

    public const CONTACT_FIRST_NAME = 'contact_first_name';

    public const CONTACT_LAST_NAME = 'contact_last_name';

    public const WEBSITE = 'website';

    public const DOMAIN = 'domain';

    private const PLACEHOLDER_PATTERN = '/\{\{\s*(\w+)\s*\}\}/';

    /**
     * Template content is admin-editable and stored in the database, so
     * compiling it as Blade would make admin-panel XSS or a stolen session
     * escalate into remote code execution.
     */
    public function handle(OutreachTemplate $template, Prospect $prospect): RenderedOutreachTemplateData
    {
        $valuePerPlaceholder = $this->valuePerPlaceholder($prospect);

        return new RenderedOutreachTemplateData(
            subject: $this->replaceRecognisedPlaceholders($template->subject, $valuePerPlaceholder),
            body: $this->replaceRecognisedPlaceholders($template->body, $valuePerPlaceholder),
        );
    }

    /**
     * @return array<int, string>
     */
    public static function recognisedPlaceholderNames(): array
    {
        return [
            self::COMPANY_NAME,
            self::CONTACT_FIRST_NAME,
            self::CONTACT_LAST_NAME,
            self::WEBSITE,
            self::DOMAIN,
        ];
    }

    /**
     * @return array<string, string>
     */
    private function valuePerPlaceholder(Prospect $prospect): array
    {
        return [
            self::COMPANY_NAME => $prospect->name,
            self::CONTACT_FIRST_NAME => $prospect->contact_first_name ?? '',
            self::CONTACT_LAST_NAME => $prospect->contact_last_name ?? '',
            self::WEBSITE => $prospect->website ?? '',
            self::DOMAIN => $prospect->domain,
        ];
    }

    /**
     * @param  array<string, string>  $valuePerPlaceholder
     */
    private function replaceRecognisedPlaceholders(string $content, array $valuePerPlaceholder): string
    {
        return (string) preg_replace_callback(
            self::PLACEHOLDER_PATTERN,
            static function (array $matches) use ($valuePerPlaceholder): string {
                [$unrecognisedPlaceholderIsLeftAsIs, $placeholderName] = $matches;

                return $valuePerPlaceholder[$placeholderName] ?? $unrecognisedPlaceholderIsLeftAsIs;
            },
            $content
        );
    }
}
