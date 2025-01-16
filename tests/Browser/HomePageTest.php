<?php

namespace Tests\Browser;

use App\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomePageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_should_only_show_tags_that_are_visible(): void
    {
        $visibleTag = Tag::factory()->create([
            'visible' => true,
        ]);

        $invisibleTag = Tag::factory()->create([
            'visible' => false,
        ]);

        $this->browse(function (Browser $browser) use ($visibleTag, $invisibleTag) {
            $browser
                ->visit(route('home'))
                ->assertSee($visibleTag->name)
                ->assertDontSee($invisibleTag->name);
        });
    }
}
