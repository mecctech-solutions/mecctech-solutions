<?php

namespace App\Actions;

use App\Models\OutreachAttempt;
use App\Models\OutreachTemplate;
use App\Models\Prospect;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateOutreachAttempt
{
    use AsAction;

    /**
     * Persist an unsent outreach attempt for a prospect from a template.
     *
     * The rendered `subject` and `body` are stored as a snapshot on the attempt
     * so that editing or deleting the template afterwards never rewrites what
     * was actually sent. The operator tweaks the copy per prospect before
     * sending, so `$subject` and `$body` may be passed to snapshot the edited
     * text instead of the freshly rendered template.
     */
    public function handle(
        Prospect $prospect,
        OutreachTemplate $template,
        ?OutreachAttempt $followUpTo = null,
        ?string $subject = null,
        ?string $body = null,
    ): OutreachAttempt {
        $rendered = RenderOutreachTemplate::run($template, $prospect);

        return $prospect->outreachAttempts()->create([
            'outreach_template_id' => $template->id,
            'follow_up_to_id' => $followUpTo?->id,
            'subject' => $subject ?? $rendered['subject'],
            'body' => $body ?? $rendered['body'],
            'sent_at' => null,
        ]);
    }
}
