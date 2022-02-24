<?php

namespace App\PortfolioManagement\Infrastructure\Converters\Csv\PortfolioItems;

use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItemFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PortfolioItemsConverter
{
    public static function toExcel(PortfolioItem $portfolioItem)
    {

    }

    public static function toEntity(UploadedFile $uploadedFile): Collection
    {
        $path = $uploadedFile->getRealPath();
        $file = fopen($path, 'r');

        $portfolioItems = collect();
        $rowNumber = 0;

        while (($row = fgetcsv($file)) !== FALSE)
        {
            if ($rowNumber === 0)
            {
                $rowNumber++;
                continue;
            }

            $portfolioItem = [
                "title" => $row[0],
                "main_image" => [
                    "url" => $row[1]
                ],
                "description" => $row[2],
                "website_url" => $row[3],
                "images" => [
                    0 => [
                        "url" => $row[4]
                    ],
                    1 => [
                        "url" => $row[5]
                    ],
                    2 => [
                        "url" => $row[6]
                    ],
                    3 => [
                        "url" => $row[7]
                    ]
                ],
                "tags" => [
                    $row[8], $row[9], $row[10]
                ]
            ];

            $portfolioItems->push(PortfolioItemFactory::fromArray($portfolioItem));

            $rowNumber++;

        }

        return $portfolioItems;
    }
}
