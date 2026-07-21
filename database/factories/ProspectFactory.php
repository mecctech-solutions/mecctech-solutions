<?php

namespace Database\Factories;

use App\Enums\CompanyType;
use App\Enums\QualificationStatus;
use App\Models\Prospect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Prospect>
 */
class ProspectFactory extends Factory
{
    protected $model = Prospect::class;

    public function definition(): array
    {
        $domain = fake()->unique()->domainName();

        return [
            'name' => fake()->company(),
            'domain' => $domain,
            'website' => 'https://www.'.$domain,
            'type' => fake()->randomElement(CompanyType::cases()),
            'contact_first_name' => fake()->firstName(),
            'contact_last_name' => fake()->lastName(),
            'contact_email' => fake()->safeEmail(),
            'qualification_status' => QualificationStatus::Pending,
            'qualification_reason' => null,
            'qualified_at' => null,
            'notes' => fake()->optional()->sentence(),
        ];
    }

    public function suitable(): static
    {
        return $this->state(fn (array $attributes) => [
            'qualification_status' => QualificationStatus::Suitable,
            'qualification_reason' => fake()->randomElement([
                'Has an active vacancies page',
                'Right size and sector',
                'Uses outdated tech stack',
            ]),
            'qualified_at' => now(),
        ]);
    }

    public function unsuitable(): static
    {
        return $this->state(fn (array $attributes) => [
            'qualification_status' => QualificationStatus::Unsuitable,
            'qualification_reason' => fake()->randomElement([
                'Too large',
                'Already has an in-house team',
                'No relevant services',
            ]),
            'qualified_at' => now(),
        ]);
    }

    public function ofType(CompanyType $type): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => $type,
        ]);
    }
}
