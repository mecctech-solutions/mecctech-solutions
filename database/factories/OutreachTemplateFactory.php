<?php

namespace Database\Factories;

use App\Enums\CompanyType;
use App\Models\OutreachTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OutreachTemplate>
 */
class OutreachTemplateFactory extends Factory
{
    protected $model = OutreachTemplate::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'company_type' => null,
            'subject' => 'A quick idea for {{company_name}}',
            'body' => "Hi {{contact_first_name}},\n\n"
                .'I came across {{website}} and had an idea for {{company_name}}.'
                ."\n\nKind regards,\nMecctech Solutions",
        ];
    }

    public function forType(CompanyType $type): static
    {
        return $this->state(fn (array $attributes) => [
            'company_type' => $type,
        ]);
    }
}
