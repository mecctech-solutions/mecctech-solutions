<?php

namespace App\Models;

use App\Enums\CompanyType;
use Database\Factories\OutreachTemplateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property CompanyType|null $company_type
 * @property string $subject
 * @property string $body
 */
class OutreachTemplate extends Model
{
    /** @use HasFactory<OutreachTemplateFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'company_type',
        'subject',
        'body',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'company_type' => CompanyType::class,
        ];
    }

    /**
     * @return HasMany<OutreachAttempt, $this>
     */
    public function outreachAttempts(): HasMany
    {
        return $this->hasMany(OutreachAttempt::class);
    }

    protected static function newFactory(): OutreachTemplateFactory
    {
        return OutreachTemplateFactory::new();
    }
}
