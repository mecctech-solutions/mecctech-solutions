<?php

namespace Database\Factories;

use App\Enums\OutreachOutcome;
use App\Models\OutreachAttempt;
use App\Models\Prospect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OutreachAttempt>
 */
class OutreachAttemptFactory extends Factory
{
    protected $model = OutreachAttempt::class;

    public function definition(): array
    {
        return [
            'prospect_id' => Prospect::factory(),
            'outreach_template_id' => null,
            'follow_up_to_id' => null,
            'subject' => fake()->sentence(),
            'body' => fake()->paragraphs(2, true),
            'sent_at' => now()->subDays(fake()->numberBetween(0, 30)),
            'outcome' => null,
            'outcome_note' => null,
            'outcome_at' => null,
        ];
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'sent_at' => null,
        ]);
    }

    public function sentDaysAgo(int $days): static
    {
        return $this->state(fn (array $attributes) => [
            'sent_at' => now()->subDays($days),
        ]);
    }

    public function withOutcome(OutreachOutcome $outcome): static
    {
        return $this->state(fn (array $attributes) => [
            'outcome' => $outcome,
            'outcome_note' => fake()->optional()->sentence(),
            'outcome_at' => now(),
        ]);
    }

    public function followUpTo(OutreachAttempt $attempt): static
    {
        return $this->state(fn (array $attributes) => [
            'prospect_id' => $attempt->prospect_id,
            'follow_up_to_id' => $attempt->id,
        ]);
    }
}
