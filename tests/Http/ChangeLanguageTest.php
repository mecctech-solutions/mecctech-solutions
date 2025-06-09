<?php

use Inertia\Testing\AssertableInertia;

it('should change language', function () {
    // Given
    $newLanguage = 'nl';
    self::assertEquals('en', app()->getLocale());

    // When
    $this->get(route('locale.change', ['locale' => $newLanguage]));

    // Then
    self::assertEquals($newLanguage, app()->getLocale());
});

it('should change language in inertia data', function () {
    // Given
    $newLanguage = 'nl';
    self::assertEquals('en', app()->getLocale());

    // When
    $this->get(route('locale.change', ['locale' => $newLanguage]));

    // Then
    $this->get(route('home'))
        ->assertInertia(fn (AssertableInertia $assert) => $assert
            ->where('locale', $newLanguage)
        );
});
