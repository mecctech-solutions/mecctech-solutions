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
            if (sizeof($row) !== 17)
            {
                throw new PortfolioItemsConverterOperationException("Excel file should have 17 columns");
            }

            if ($rowNumber === 0)
            {
                $rowNumber++;
                continue;
            }

            $images = [];

            if ($row[6] !== "")
            {
                $images[] = [
                    "url" => 'images/'.$row[6]
                ];
            }

            if ($row[7] !== "")
            {
                $images[] = [
                    "url" => 'images/'.$row[7]
                ];
            }

            if ($row[8] !== "")
            {
                $images[] = [
                    "url" => 'images/'.$row[8]
                ];
            }

            if ($row[9] !== "")
            {
                $images[] = [
                    "url" => 'images/'.$row[9]
                ];
            }

            if ($row[10] !== "")
            {
                $images[] = [
                    "url" => 'images/'.$row[10]
                ];
            }

            if ($row[11] !== "")
            {
                $images[] = [
                    "url" => 'images/'.$row[11]
                ];
            }

            if ($row[12] !== "")
            {
                $images[] = [
                    "url" => 'images/'.$row[12]
                ];
            }

            $tags = [];

            if ($row[13] !== "")
            {
                $tags[] = $row[13];
            }

            if ($row[14] !== "")
            {
                $tags[] = $row[14];
            }

            if ($row[15] !== "")
            {
                $tags[] = $row[15];
            }

            if ($row[16] !== "")
            {
                $tags[] = $row[16];
            }

            $portfolioItem = [
                "title" => [
                    "english" => $row[0],
                    "dutch" => $row[1]
                ],
                "main_image" => [
                    "url" => 'images/'.$row[2]
                ],
                "description" => [
                    "english" => $row[3],
                    "dutch" => $row[4]
                ],
                "website_url" => $row[5],
                "images" => $images,
                "tags" => $tags
            ];

            $portfolioItems->push(PortfolioItemFactory::fromArray($portfolioItem));

            $rowNumber++;

        }

        return $portfolioItems;
    }
}
