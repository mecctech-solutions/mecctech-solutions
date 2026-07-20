<?php

namespace Database\Seeders;

use App\Actions\RenderOutreachTemplate;
use App\Enums\CompanyType;
use App\Enums\OutreachOutcome;
use App\Models\OutreachAttempt;
use App\Models\OutreachTemplate;
use App\Models\Prospect;
use Database\Factories\OutreachAttemptFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProspectSeeder extends Seeder
{
    /**
     * Every seeded prospect gets a domain under the reserved `.example` TLD, which
     * faker never generates. That marker lets the seeder wipe only its own records
     * up front, so re-running never crashes on the unique `prospects.domain` index
     * and never touches imported prospects.
     */
    public function run(): void
    {
        Prospect::query()->where('domain', 'like', '%.example')->delete();

        $this->seedQualificationQueue();
        $this->seedQualifiedProspects();
        $this->seedProspectsWithAttempts();
    }

    /**
     * The busiest screen: a queue of unreviewed prospects across all three types.
     */
    private function seedQualificationQueue(): void
    {
        foreach (CompanyType::cases() as $type) {
            Prospect::factory()
                ->count(5)
                ->ofType($type)
                ->sequence(fn (Sequence $sequence): array => [
                    'website' => "https://www.pending-{$type->value}-{$sequence->index}.example",
                ])
                ->create();
        }
    }

    private function seedQualifiedProspects(): void
    {
        Prospect::factory()
            ->count(4)
            ->suitable()
            ->sequence(fn (Sequence $sequence): array => [
                'website' => "https://www.suitable-{$sequence->index}.example",
            ])
            ->create();

        Prospect::factory()
            ->count(6)
            ->unsuitable()
            ->sequence(fn (Sequence $sequence): array => [
                'website' => "https://www.unsuitable-{$sequence->index}.example",
            ])
            ->create();
    }

    /**
     * A prospect in every attempt state so the panel demonstrates the full
     * outreach lifecycle: awaiting a response, due for follow-up, already
     * followed up, and one closed with each outcome.
     */
    private function seedProspectsWithAttempts(): void
    {
        $awaiting = $this->suitableProspect('awaiting-reply', CompanyType::DirectClient);
        $this->attemptFor($awaiting)->sentDaysAgo(3)->create();

        $dueForFollowUp = $this->suitableProspect('due-for-follow-up', CompanyType::Agency);
        $this->attemptFor($dueForFollowUp)->sentDaysAgo(20)->create();

        $followedUp = $this->suitableProspect('already-followed-up', CompanyType::StaffingAgency);
        $firstAttempt = $this->attemptFor($followedUp)->sentDaysAgo(24)->createOne();
        $this->attemptFor($followedUp)
            ->followUpTo($firstAttempt)
            ->sentDaysAgo(9)
            ->create();

        foreach (OutreachOutcome::cases() as $index => $outcome) {
            $prospect = $this->suitableProspect("outcome-{$outcome->value}", CompanyType::DirectClient);
            $this->attemptFor($prospect)
                ->sentDaysAgo(10 + $index)
                ->withOutcome($outcome)
                ->create();
        }
    }

    private function suitableProspect(string $slug, CompanyType $type): Prospect
    {
        return Prospect::factory()
            ->suitable()
            ->ofType($type)
            ->create([
                'website' => "https://www.{$slug}.example",
            ]);
    }

    /**
     * Snapshot the matching starter template's rendered subject and body onto the
     * attempt, mirroring what the compose action stores when the operator sends.
     */
    private function attemptFor(Prospect $prospect): OutreachAttemptFactory
    {
        $template = OutreachTemplate::query()
            ->where('company_type', $prospect->type)
            ->first();

        $factory = OutreachAttempt::factory()->for($prospect);

        if ($template === null) {
            return $factory;
        }

        $rendered = RenderOutreachTemplate::run($template, $prospect);

        return $factory->state([
            'outreach_template_id' => $template->id,
            'subject' => $rendered['subject'],
            'body' => $rendered['body'],
        ]);
    }
}
