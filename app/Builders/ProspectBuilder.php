<?php

namespace App\Builders;

use App\Enums\CompanyType;
use App\Enums\QualificationStatus;
use App\Models\Prospect;
use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Builder<Prospect>
 */
class ProspectBuilder extends Builder
{
    public function pendingQualification(): self
    {
        return $this->where('qualification_status', QualificationStatus::Pending);
    }

    public function suitable(): self
    {
        return $this->where('qualification_status', QualificationStatus::Suitable);
    }

    public function unsuitable(): self
    {
        return $this->where('qualification_status', QualificationStatus::Unsuitable);
    }

    public function ofType(CompanyType $type): self
    {
        return $this->where('type', $type);
    }

    public function search(string $term): self
    {
        return $this->where(function (Builder $query) use ($term): void {
            $query
                ->where('name', 'like', "%{$term}%")
                ->orWhere('domain', 'like', "%{$term}%")
                ->orWhere('website', 'like', "%{$term}%")
                ->orWhere('contact_first_name', 'like', "%{$term}%")
                ->orWhere('contact_last_name', 'like', "%{$term}%")
                ->orWhere('contact_email', 'like', "%{$term}%");
        });
    }
}
