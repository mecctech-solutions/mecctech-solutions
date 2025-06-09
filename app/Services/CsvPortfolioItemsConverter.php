<?php

namespace App\Services;

use App\Data\PortfolioItemData;
use Illuminate\Support\Collection;

class CsvPortfolioItemsConverter
{
    /**
     * @return Collection<int, PortfolioItemData>
     */
    public static function import(string $path): Collection
    {
        $file = fopen($path, 'r');

        $portfolioItems = [];
        $rowNumber = 0;

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) !== 23) {
                throw new \InvalidArgumentException('Excel file should have 23 columns');
            }

            if ($rowNumber === 0) {
                $rowNumber++;

                continue;
            }

            $images = [];

            if ($row[6] !== '') {
                $images[] = [
                    'url' => 'images/'.$row[6],
                    'position' => 1,
                ];
            }

            if ($row[7] !== '') {
                $images[] = [
                    'url' => 'images/'.$row[7],
                    'position' => 2,
                ];
            }

            if ($row[8] !== '') {
                $images[] = [
                    'url' => 'images/'.$row[8],
                    'position' => 3,
                ];
            }

            if ($row[9] !== '') {
                $images[] = [
                    'url' => 'images/'.$row[9],
                    'position' => 4,
                ];
            }

            if ($row[10] !== '') {
                $images[] = [
                    'url' => 'images/'.$row[10],
                    'position' => 5,
                ];
            }

            if ($row[11] !== '') {
                $images[] = [
                    'url' => 'images/'.$row[11],
                    'position' => 6,
                ];
            }

            if ($row[12] !== '') {
                $images[] = [
                    'url' => 'images/'.$row[12],
                    'position' => 7,
                ];
            }

            $tags = [];

            if ($row[13] !== '') {
                $tags[]['name'] = $row[13];
            }

            if ($row[14] !== '') {
                $tags[]['name'] = $row[14];
            }

            if ($row[15] !== '') {
                $tags[]['name'] = $row[15];
            }

            if ($row[16] !== '') {
                $tags[]['name'] = $row[16];
            }

            // Bullet points
            $bulletPoints = [];
            if ($row[17] !== '' && $row[18] !== '') {
                $bulletPoints[] = [
                    'text_nl' => $row[17],
                    'text_en' => $row[18],
                    'position' => 1,
                ];
            }

            if ($row[19] !== '' && $row[20] !== '') {
                $bulletPoints[] = [
                    'text_nl' => $row[19],
                    'text_en' => $row[20],
                    'position' => 2,
                ];
            }

            if ($row[21] !== '' && $row[22] !== '') {
                $bulletPoints[] = [
                    'text_nl' => $row[21],
                    'text_en' => $row[22],
                    'position' => 3,
                ];
            }

            $portfolioItem = [
                'title_en' => $row[0],
                'title_nl' => $row[1],
                'main_image_url' => 'images/'.$row[2],
                'position' => $rowNumber,
                'visible' => true,
                'description_en' => $row[3],
                'description_nl' => $row[4],
                'website_url' => $row[5],
                'images' => $images,
                'tags' => $tags,
                'bullet_points' => $bulletPoints,
                'has_case_study' => false,
                'case_study_slug' => null,
            ];

            $portfolioItems[] = PortfolioItemData::from($portfolioItem);

            $rowNumber++;

        }

        return PortfolioItemData::collect($portfolioItems, Collection::class);
    }
}
