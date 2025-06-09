<?php

use App\Actions\GetAllVisibleTags;
use App\Models\Tag;

it('should only return visible tags', function () {
    // Given
    $visibleTags = Tag::factory()->count(3)->create(['visible' => true]);
    $invisibleTags = Tag::factory()->count(3)->create(['visible' => false]);

    // When
    $visibleTags = GetAllVisibleTags::run();

    // Then
    expect($visibleTags)->toHaveCount(3);
});

it('should sort on position', function () {
    // Given
    Tag::factory()->create(['visible' => true]);

    // When
    $visibleTags = GetAllVisibleTags::run();

    // Then
    expect($this->normalizeDataForComparison($visibleTags->toArray()))->toEqual($this->normalizeDataForComparison(Tag::orderBy('position')->get()->toArray()));
});
