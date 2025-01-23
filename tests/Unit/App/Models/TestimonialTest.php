<?php

use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

test('it returns image full url with storage when it exists', function () {
    // Arrange
    $fileName = 'test.jpg';
    Storage::put($fileName, 'test');
    
    $testimonial = Testimonial::factory()->create([
        'image_url' => $fileName
    ]);

    // Act & Assert
    expect($testimonial->image_full_url)->toBe(url('/storage/' . $fileName));

    // Cleanup
    Storage::delete($fileName);
});

test('it returns image full url without storage when it does not exist', function () {
    // Arrange
    Storage::fake('public');
    $testimonial = Testimonial::factory()->create([
        'image_url' => 'test.jpg'
    ]);

    // Act & Assert
    expect($testimonial->image_full_url)->toBe(url('test.jpg'));
}); 