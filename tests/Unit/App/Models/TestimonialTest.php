<?php

use App\Models\Client;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('it returns image full url with storage when it exists', function () {
    // Arrange
    $fileName = 'test.jpg';
    Storage::put($fileName, 'test');

    $testimonial = Testimonial::factory()->create([
        'image_url' => $fileName,
    ]);

    // Act & Assert
    expect($testimonial->image_full_url)->toEqual(url('/storage/'.$fileName));

    // Cleanup
    Storage::delete($fileName);
});

test('it returns image full url without storage when it does not exist', function () {
    // Arrange
    Storage::fake('public');
    $testimonial = Testimonial::factory()->create([
        'image_url' => 'test.jpg',
    ]);

    // Act & Assert
    expect($testimonial->image_full_url)->toEqual(url('test.jpg'));
});

test('it belongs to a client', function () {
    // Arrange
    $client = Client::factory()->create();
    $testimonial = Testimonial::factory()->create([
        'client_id' => $client->id,
    ]);

    // Act & Assert
    expect($testimonial->client)->toBeInstanceOf(Client::class);
    expect($testimonial->client->id)->toEqual($client->id);
});
