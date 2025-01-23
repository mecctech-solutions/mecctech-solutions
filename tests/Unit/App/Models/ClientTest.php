<?php

namespace Tests\Unit\App\Models;

use App\Models\Client;
use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_logo_full_url_with_storage_when_it_exists(): void
    {
        // Arrange
        $fileName = 'test.jpg';
        Storage::put($fileName, 'test');

        $client = Client::factory()->create([
            'logo_url' => $fileName
        ]);

        // Act & Assert
        $this->assertEquals(url('/storage/' . $fileName), $client->logo_full_url);

        // Cleanup
        Storage::delete($fileName);
    }

    public function test_it_returns_logo_full_url_without_storage_when_it_does_not_exist(): void
    {
        // Arrange
        Storage::fake('public');
        $client = Client::factory()->create([
            'logo_url' => 'test.jpg'
        ]);

        // Act & Assert
        $this->assertEquals(url('test.jpg'), $client->logo_full_url);
    }

    public function test_it_can_have_multiple_testimonials(): void
    {
        // Arrange
        $client = Client::factory()
            ->has(Testimonial::factory()->count(3))
            ->create();

        // Act & Assert
        $this->assertCount(3, $client->testimonials);
        $this->assertInstanceOf(Testimonial::class, $client->testimonials->first());
    }
}
