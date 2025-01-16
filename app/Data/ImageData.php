<?php

namespace App\Data;

use App\Actions\DetermineFullFileUrl;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class ImageData extends Data
{
    #[Computed]
    public string $full_url;

    public function __construct(
        public string $url,
    )
    {
        $this->full_url = DetermineFullFileUrl::run($this->url);
    }
}
