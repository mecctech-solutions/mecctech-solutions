<?php

namespace app\Services;

use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItemFactory;
use App\PortfolioManagement\Infrastructure\Exceptions\PortfolioItemsConverterOperationException;
use Illuminate\Support\Collection;

class CsvPortfolioItemsConverter
{
    public static function toExcel(PortfolioItem $portfolioItem)
    {

    }

    /**
     * @throws PortfolioItemsConverterOperationException
     */
    public static function toEntity(string $path): Collection
    {
        $file = fopen($path, 'r');

        $portfolioItems = collect();
        $rowNumber = 0;

        while (($row = fgetcsv($file)) !== FALSE)
        {
            if (sizeof($row) !== 23)
            {
                throw new PortfolioItemsConverterOperationException("Excel file should have 23 columns");
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

            // Bullet points
            $bulletPoints = [];
            if ($row[17] !== "" && $row[18] !== "")
            {
                $bulletPoints[] = [
                    "dutch" => $row[17],
                    "english" => $row[18]
                ];
            }


            if ($row[19] !== "" && $row[20] !== "")
            {
                $bulletPoints[] = [
                    "dutch" => $row[19],
                    "english" => $row[20]
                ];
            }

            if ($row[21] !== "" && $row[22] !== "")
            {
                $bulletPoints[] = [
                    "dutch" => $row[21],
                    "english" => $row[22]
                ];
            }

            $portfolioItem = [
                "title" => [
                    "english" => $row[0],
                    "dutch" => $row[1]
                ],
                "main_image" => [
                    "url" => 'images/'.$row[2]
                ],
                "position" => $rowNumber,
                "description" => [
                    "english" => $row[3],
                    "dutch" => $row[4]
                ],
                "website_url" => $row[5],
                "images" => $images,
                "tags" => $tags,
                "bullet_points" => $bulletPoints
            ];

            $portfolioItems->push(PortfolioItemFactory::fromArray($portfolioItem));

            $rowNumber++;

        }

        return $portfolioItems;
    }
}
