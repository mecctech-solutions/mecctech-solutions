<?php

namespace App\Models;

use App\Actions\NormalizeDomain;
use App\Builders\ProspectBuilder;
use App\Enums\CompanyType;
use App\Enums\QualificationStatus;
use Carbon\CarbonInterface;
use Database\Factories\ProspectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;

/**
 * @property string $name
 * @property string $domain
 * @property string|null $website
 * @property CompanyType $type
 * @property string|null $contact_first_name
 * @property string|null $contact_last_name
 * @property string|null $contact_email
 * @property QualificationStatus $qualification_status
 * @property string|null $qualification_reason
 * @property CarbonInterface|null $qualified_at
 * @property string|null $notes
 */
class Prospect extends Model
{
    /** @use HasFactory<ProspectFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'domain',
        'website',
        'type',
        'contact_first_name',
        'contact_last_name',
        'contact_email',
        'qualification_status',
        'qualification_reason',
        'qualified_at',
        'notes',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => CompanyType::class,
            'qualification_status' => QualificationStatus::class,
            'qualified_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Prospect $prospect): void {
            $prospect->domain = NormalizeDomain::run(
                filled($prospect->website) ? $prospect->website : (string) $prospect->domain
            );
        });
    }

    /**
     * @return HasMany<OutreachAttempt, $this>
     */
    public function outreachAttempts(): HasMany
    {
        return $this->hasMany(OutreachAttempt::class);
    }

    /**
     * @return HasOne<OutreachAttempt, $this>
     */
    public function latestOutreachAttempt(): HasOne
    {
        return $this->hasOne(OutreachAttempt::class)->latestOfMany('sent_at');
    }

    public function isQualified(): bool
    {
        return $this->qualification_status !== QualificationStatus::Pending;
    }

    /**
     * @param  Builder  $query
     */
    public function newEloquentBuilder($query): ProspectBuilder
    {
        return new ProspectBuilder($query);
    }

    protected static function newFactory(): ProspectFactory
    {
        return ProspectFactory::new();
    }
}
