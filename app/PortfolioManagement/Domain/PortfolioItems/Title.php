<?php

namespace App\PortfolioManagement\Domain\PortfolioItems;

use Illuminate\Contracts\Support\Arrayable;

class Title implements Arrayable
{
    private string $dutch;
    private string $english;

    /**
     * @param string $dutch
     * @param string $english
     */
    public function __construct(string $dutch, string $english)
    {
        $this->dutch = $dutch;
        $this->english = $english;
    }

    public function dutch(): string
    {
        return $this->dutch;
    }

    public function english(): string
    {
        return $this->english;
    }

    public function toArray()
    {
        return [
            "dutch" => $this->dutch,
            "english" => $this->english
        ];
    }
}
