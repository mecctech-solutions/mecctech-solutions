<?php

use App\Actions\AddPortfolioItems;
use App\Actions\GetAllPortfolioItems;
use App\Actions\ImportPortfolioItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("portfolio-items", GetAllPortfolioItems::class)
    ->name("all-portfolio-items")
    ->middleware('cors');

Route::post("portfolio-items/add-multiple", AddPortfolioItems::class)
    ->name("add-portfolio-items")
    ->middleware('cors');

Route::post("portfolio-items/import", ImportPortfolioItems::class)
    ->name("import-portfolio-items");
