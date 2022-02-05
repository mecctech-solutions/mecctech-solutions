<?php

namespace App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems;

/**
 * @property string $title
 * @property string $main_image_url;
 * @property string $description;
 * @property string $website_url
 */
class EloquentImage extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "images";
    protected $guarded = [];


}
