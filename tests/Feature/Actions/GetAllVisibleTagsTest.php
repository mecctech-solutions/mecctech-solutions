<?php

namespace Tests\Feature\Actions;

use App\Actions\GetAllVisibleTags;
use App\Models\Tag;
use Tests\TestCase;

class GetAllVisibleTagsTest extends TestCase
{
    /** @test */
    public function it_should_only_return_visible_tags()
    {
        // Given
        $visibleTags = Tag::factory()->count(3)->create(['visible' => true]);
        $invisibleTags = Tag::factory()->count(3)->create(['visible' => false]);

        // When
        $visibleTags = GetAllVisibleTags::run();

        // Then
        $this->assertCount(3, $visibleTags);
    }

    /** @test */
    public function it_should_sort_on_position()
    {
        // Given
        Tag::factory()->create(['visible' => true]);

        // When
        $visibleTags = GetAllVisibleTags::run();

        // Then
        $this->assertEquals($this->normalizeDataForComparison(Tag::orderBy('position')->get()->toArray()), $this->normalizeDataForComparison($visibleTags->toArray()));
    }
}
