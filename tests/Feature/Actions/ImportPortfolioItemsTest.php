<?php

use Illuminate\Http\UploadedFile;

it('should be able to call the route', function () {
    // Given
    $url = route('import-portfolio-items');

    // When
    $response = $this->post($url, [
        'portfolio_items' => UploadedFile::fake()->create(1),
    ]);

    $response->assertStatus(200);
});
