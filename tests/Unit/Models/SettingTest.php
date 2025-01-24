<?php

namespace Tests\Unit\Models;

use App\Enums\SettingKey;
use App\Exceptions\InvalidSettingValueException;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_get_setting_value(): void
    {
        // Given
        Setting::factory()->create([
            'key' => SettingKey::PORTFOLIO_ITEMS_PER_PAGE->value,
            'value' => 10,
        ]);

        // When
        $value = Setting::getValue(SettingKey::PORTFOLIO_ITEMS_PER_PAGE);

        // Then
        $this->assertEquals(10, $value);
    }

    public function test_it_returns_default_value_when_setting_not_found(): void
    {
        // When
        $value = Setting::getValue(SettingKey::PORTFOLIO_ITEMS_PER_PAGE);

        // Then
        $this->assertEquals(6, $value);
    }

    public function test_it_can_set_setting_value(): void
    {
        // When
        Setting::setValue(SettingKey::PORTFOLIO_ITEMS_PER_PAGE, 15);

        // Then
        $this->assertDatabaseHas('settings', [
            'key' => SettingKey::PORTFOLIO_ITEMS_PER_PAGE->value,
            'value' => 15,
        ]);
    }

    public function test_it_updates_existing_setting(): void
    {
        // Given
        Setting::factory()->create([
            'key' => SettingKey::PORTFOLIO_ITEMS_PER_PAGE->value,
            'value' => 10,
        ]);

        // When
        Setting::setValue(SettingKey::PORTFOLIO_ITEMS_PER_PAGE, 20);

        // Then
        $this->assertDatabaseHas('settings', [
            'key' => SettingKey::PORTFOLIO_ITEMS_PER_PAGE->value,
            'value' => 20,
        ]);
        $this->assertDatabaseCount('settings', 1);
    }

    public function test_it_throws_exception_for_non_numeric_portfolio_items_per_page(): void
    {
        $this->expectException(InvalidSettingValueException::class);
        $this->expectExceptionMessage("Invalid value type for setting 'portfolio_items.items_per_page'. Expected numeric, got string.");

        Setting::setValue(SettingKey::PORTFOLIO_ITEMS_PER_PAGE, 'invalid');
    }

    public function test_it_throws_exception_for_portfolio_items_per_page_too_low(): void
    {
        $this->expectException(InvalidSettingValueException::class);
        $this->expectExceptionMessage("Invalid value for setting 'portfolio_items.items_per_page'. Value must be between 1 and 50, got 0.");

        Setting::setValue(SettingKey::PORTFOLIO_ITEMS_PER_PAGE, 0);
    }

    public function test_it_throws_exception_for_portfolio_items_per_page_too_high(): void
    {
        $this->expectException(InvalidSettingValueException::class);
        $this->expectExceptionMessage("Invalid value for setting 'portfolio_items.items_per_page'. Value must be between 1 and 50, got 51.");

        Setting::setValue(SettingKey::PORTFOLIO_ITEMS_PER_PAGE, 51);
    }
} 