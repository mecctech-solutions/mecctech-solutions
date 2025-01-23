<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected array $excludedFields = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot'
    ];

    protected function normalizeDataForComparison(
        array $data,
        array $exclude = []
    ): array {
        $exclude = array_merge($this->excludedFields, $exclude);
        return $this->removeExcludedFields($data, $exclude);
    }

    private function removeExcludedFields(array $data, array $exclude): array
    {
        foreach ($exclude as $field) {
            unset($data[$field]);
        }

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->removeExcludedFields($value, $exclude);
            }
        }

        return $data;
    }
}
