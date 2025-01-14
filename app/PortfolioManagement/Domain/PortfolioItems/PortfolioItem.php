<?php

namespace App\PortfolioManagement\Domain\PortfolioItems;

use App\SharedKernel\CleanArchitecture\ValueObject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class PortfolioItem extends ValueObject implements Arrayable
{

    private Title $title;
    private Description $description;
    private string $websiteUrl;

    private int $position;
    private Image $mainImage;

    /**
     * @var Collection<Image>
     */
    private Collection $images;

    /**
     * @var Collection<string>
     */
    private Collection $tags;

    /**
     * @var Collection<BulletPoint>
     */
    private Collection $bulletPoints;

    public function __construct(Title $title, Image $mainImage, Description $description, string $websiteUrl, int $position, Collection $images, Collection $tags, Collection $bulletPoints)
    {
        $this->title = $title;
        $this->mainImage = $mainImage;
        $this->description = $description;
        $this->websiteUrl = $websiteUrl;
        $this->position = $position;
        $this->images = $images;
        $this->tags = $tags;
        $this->bulletPoints = $bulletPoints;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function mainImage(): Image
    {
        return $this->mainImage;
    }

    public function description(): Description
    {
        return $this->description;
    }

    public function websiteUrl(): string
    {
        return $this->websiteUrl;
    }

    public function position(): int
    {
        return $this->position;
    }

    public function images(): Collection
    {
        return $this->images;
    }

    public function tags(): Collection
    {
        return $this->tags;
    }

    public function bulletPoints()
    {
        return $this->bulletPoints;
    }

    public function hasTag(string $tag): bool
    {
        foreach ($this->tags as $presentTag)
        {
            if ($tag === $presentTag)
            {
                return true;
            }
        }

        return false;
    }

    public function asArray(): array
    {
        $imagesAsArray = [];
        $tagsAsArray = [];
        $bulletPointsAsArray = [];

        foreach ($this->images as $image)
        {
            $imagesAsArray[] = $image->asArray();
        }

        foreach ($this->tags as $tag)
        {
            $tagsAsArray[] = $tag;
        }

        return [
            "title" => [
                "dutch" => $this->title->dutch(),
                "english" => $this->title->english()
            ],
            "main_image" => $this->mainImage->asArray(),
            "description" => [
                "dutch" => $this->description->dutch(),
                "english" => $this->description->english()
            ],
            "website_url" => $this->websiteUrl,
            "position" => $this->position,
            "images" => $imagesAsArray,
            "tags" => $tagsAsArray,
            'bullet_points' => $this->bulletPoints->toArray()
        ];
    }

    public function toArray()
    {
        return $this->asArray();
    }
}
