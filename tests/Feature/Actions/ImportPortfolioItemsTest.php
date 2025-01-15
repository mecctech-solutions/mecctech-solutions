<?php

namespace Tests\Feature\Actions;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImportPortfolioItemsTest extends TestCase
{

    /** @test */
    public function it_should_be_able_to_call_the_route_for_importing_portfolio_items()
    {
        // Given
        $url = route("import-portfolio-items");

        // When
        $response = $this->post($url, [
            "portfolio_items" => UploadedFile::fake()->create(1)
        ]);

        $response->assertStatus(200);
    }
}
