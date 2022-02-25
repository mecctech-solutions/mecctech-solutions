<?php

namespace App\PortfolioManagement\Infrastructure\Converters\Csv\PortfolioItems;

use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItemFactory;
use App\PortfolioManagement\Infrastructure\Exceptions\PortfolioItemsConverterOperationException;
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
            if (sizeof($row) !== 15)
            {
                throw new PortfolioItemsConverterOperationException("Excel file should have 15 columns");
            }

            if ($rowNumber === 0)
            {
                $rowNumber++;
                continue;
            }

            $images = [];

            if ($row[4] !== null)
            {
                $images[] = [
                    "url" => 'images/'.$row[4]
                ];
            }

            if ($row[5] !== null)
            {
                $images[] = [
                    "url" => 'images/'.$row[5]
                ];
            }

            if ($row[6] !== null)
            {
                $images[] = [
                    "url" => 'images/'.$row[6]
                ];
            }

            if ($row[7] !== null)
            {
                $images[] = [
                    "url" => 'images/'.$row[7]
                ];
            }

            if ($row[8] !== null)
            {
                $images[] = [
                    "url" => 'images/'.$row[8]
                ];
            }

            if ($row[9] !== null)
            {
                $images[] = [
                    "url" => 'images/'.$row[9]
                ];
            }

            if ($row[10] !== null)
            {
                $images[] = [
                    "url" => 'images/'.$row[10]
                ];
            }

            $tags = [];

            if ($row[11] !== null)
            {
                $tags[] = $row[11];
            }

            if ($row[12] !== null)
            {
                $tags[] = $row[12];
            }

            if ($row[13] !== null)
            {
                $tags[] = $row[13];
            }

            if ($row[14] !== null)
            {
                $tags[] = $row[14];
            }

            $portfolioItem = [
                "title" => $row[0],
                "main_image" => [
                    "url" => 'images/'.$row[1]
                ],
                "description" => $row[2],
                "website_url" => $row[3],
                "images" => $images,
                "tags" => $tags
            ];

            $portfolioItems->push(PortfolioItemFactory::fromArray($portfolioItem));

            $rowNumber++;

        }

        return $portfolioItems;
    }
}
