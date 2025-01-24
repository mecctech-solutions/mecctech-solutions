<?php

namespace App\Enums;

use App\Exceptions\InvalidSettingValueException;

enum SettingKey: string
{
    case PORTFOLIO_ITEMS_PER_PAGE = 'portfolio_items.items_per_page';

    public function defaultValue(): mixed
    {
        return match($this) {
            self::PORTFOLIO_ITEMS_PER_PAGE => 6,
        };
    }

    public function validate(mixed $value): void
    {
        match($this) {
            self::PORTFOLIO_ITEMS_PER_PAGE => $this->validatePortfolioItemsPerPage($value),
        };
    }

    private function validatePortfolioItemsPerPage(mixed $value): void
    {
        if (!is_numeric($value)) {
            throw InvalidSettingValueException::invalidType($this, 'numeric', $value);
        }

        $intValue = (int) $value;
        if ($intValue < 1 || $intValue > 50) {
            throw InvalidSettingValueException::invalidRange($this, $value, 1, 50);
        }
    }
} 