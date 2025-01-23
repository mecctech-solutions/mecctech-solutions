<?php

use App\Models\Client;
use Illuminate\Support\Facades\Storage;

test('it returns logo full url with storage when it exists', function () {
    // Arrange
    $fileName = 'test.jpg';
    Storage::put($fileName, 'test');
    
    $client = Client::factory()->create([
        'logo_url' => $fileName
    ]);

    // Act & Assert
    expect($client->logo_full_url)->toBe(url('/storage/' . $fileName));

    // Cleanup
    Storage::delete($fileName);
});

test('it returns logo full url without storage when it does not exist', function () {
    // Arrange
    Storage::fake('public');
    $client = Client::factory()->create([
        'logo_url' => 'test.jpg'
    ]);

    // Act & Assert
    expect($client->logo_full_url)->toBe(url('test.jpg'));
});

test('it can have multiple testimonials', function () {
    // Arrange
    $client = Client::factory()
        ->has(\App\Models\Testimonial::factory()->count(3))
        ->create();

    // Act & Assert
    expect($client->testimonials)->toHaveCount(3);
}); 