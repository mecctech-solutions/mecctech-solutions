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
     * The subject and body are snapshotted on the attempt so that editing or
     * deleting the template afterwards never rewrites what was actually sent.
     * The operator tweaks the copy per prospect, so `$subject` and `$body` may
     * be passed to snapshot the edited text instead of the rendered template.
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
            'subject' => $subject ?? $rendered->subject,
            'body' => $body ?? $rendered->body,
            'sent_at' => null,
        ]);
    }
}
