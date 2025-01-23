<?php

namespace Tests\Feature\Controllers;

use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class ChangeLanguageTest extends TestCase
{
    /** @test */
    public function it_should_change_language()
    {
        // Given
        $newLanguage = 'nl';
        self::assertEquals('en', app()->getLocale());

        // When
        $this->get(route('locale.change', ['locale' => $newLanguage]));

        // Then
        self::assertEquals($newLanguage, app()->getLocale());
    }

    /** @test */
    public function it_should_change_language_in_inertia_data()
    {
        // Given
        $newLanguage = 'nl';
        self::assertEquals('en', app()->getLocale());

        // When
        $this->get(route('locale.change', ['locale' => $newLanguage]));

        // Then
        $this->get(route('home'))
            ->assertInertia(fn(AssertableInertia $assert) => $assert
                ->where('locale', $newLanguage)
            );

    }
}
