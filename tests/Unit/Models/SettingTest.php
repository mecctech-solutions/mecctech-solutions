<?php

use App\Enums\SettingKey;
use App\Exceptions\InvalidSettingValueException;
use App\Models\Setting;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('it can get setting value', function () {
    // Given
    Setting::factory()->create([
        'key' => SettingKey::PORTFOLIO_ITEMS_PER_PAGE->value,
        'value' => 10,
    ]);

    // When
    $value = Setting::getValue(SettingKey::PORTFOLIO_ITEMS_PER_PAGE);

    // Then
    expect($value)->toEqual(10);
});

test('it returns default value when setting not found', function () {
    // When
    $value = Setting::getValue(SettingKey::PORTFOLIO_ITEMS_PER_PAGE);

    // Then
    expect($value)->toEqual(6);
});

test('it can set setting value', function () {
    // When
    Setting::setValue(SettingKey::PORTFOLIO_ITEMS_PER_PAGE, 15);

    // Then
    $this->assertDatabaseHas('settings', [
        'key' => SettingKey::PORTFOLIO_ITEMS_PER_PAGE->value,
        'value' => 15,
    ]);
});

test('it updates existing setting', function () {
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
});

test('it throws exception for non numeric portfolio items per page', function () {
    $this->expectException(InvalidSettingValueException::class);
    $this->expectExceptionMessage("Invalid value type for setting 'portfolio_items.items_per_page'. Expected numeric, got string.");

    Setting::setValue(SettingKey::PORTFOLIO_ITEMS_PER_PAGE, 'invalid');
});

test('it throws exception for portfolio items per page too low', function () {
    $this->expectException(InvalidSettingValueException::class);
    $this->expectExceptionMessage("Invalid value for setting 'portfolio_items.items_per_page'. Value must be between 1 and 50, got 0.");

    Setting::setValue(SettingKey::PORTFOLIO_ITEMS_PER_PAGE, 0);
});

test('it throws exception for portfolio items per page too high', function () {
    $this->expectException(InvalidSettingValueException::class);
    $this->expectExceptionMessage("Invalid value for setting 'portfolio_items.items_per_page'. Value must be between 1 and 50, got 51.");

    Setting::setValue(SettingKey::PORTFOLIO_ITEMS_PER_PAGE, 51);
});
