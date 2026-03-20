<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

it('rejects php files for portfolio csv import using the same rules as Filament', function () {
    $phpFile = UploadedFile::fake()->create('shell.php', 100, 'application/x-php');

    $validator = Validator::make(
        ['file' => $phpFile],
        ['file' => ['file', 'mimes:csv,txt']],
    );

    expect($validator->fails())->toBeTrue();
});

it('accepts csv files for portfolio csv import using the same rules as Filament', function () {
    $csvFile = UploadedFile::fake()->create('data.csv', 100, 'text/csv');

    $validator = Validator::make(
        ['file' => $csvFile],
        ['file' => ['file', 'mimes:csv,txt']],
    );

    expect($validator->passes())->toBeTrue();
});

it('rejects php files for portfolio images using the same rules as Filament image upload', function () {
    $phpFile = UploadedFile::fake()->create('shell.php', 100, 'application/x-php');

    $validator = Validator::make(
        ['image' => $phpFile],
        ['image' => ['image']],
    );

    expect($validator->fails())->toBeTrue();
});

it('accepts jpeg files for portfolio images using the same rules as Filament image upload', function () {
    $image = UploadedFile::fake()->image('photo.jpg');

    $validator = Validator::make(
        ['image' => $image],
        ['image' => ['image']],
    );

    expect($validator->passes())->toBeTrue();
});
