<?php

namespace Tests\Unit\App\Models;

use App\Models\Client;
use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TestimonialTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_image_full_url_with_storage_when_it_exists(): void
    {
        // Arrange
        $fileName = 'test.jpg';
        Storage::put($fileName, 'test');

        $testimonial = Testimonial::factory()->create([
            'image_url' => $fileName,
        ]);

        // Act & Assert
        $this->assertEquals(url('/storage/'.$fileName), $testimonial->image_full_url);

        // Cleanup
        Storage::delete($fileName);
    }

    public function test_it_returns_image_full_url_without_storage_when_it_does_not_exist(): void
    {
        // Arrange
        Storage::fake('public');
        $testimonial = Testimonial::factory()->create([
            'image_url' => 'test.jpg',
        ]);

        // Act & Assert
        $this->assertEquals(url('test.jpg'), $testimonial->image_full_url);
    }

    public function test_it_belongs_to_a_client(): void
    {
        // Arrange
        $client = Client::factory()->create();
        $testimonial = Testimonial::factory()->create([
            'client_id' => $client->id,
        ]);

        // Act & Assert
        $this->assertInstanceOf(Client::class, $testimonial->client);
        $this->assertEquals($client->id, $testimonial->client->id);
    }
}
