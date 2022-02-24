<?php

use App\PortfolioManagement\Presentation\Http\Api\PortfolioManagementController;
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

Route::get("portfolio-items/all", [PortfolioManagementController::class, "getAllPortfolioItems"])
    ->name("all-portfolio-items")
    ->middleware('cors');

Route::get("portfolio-items/with-tag", [PortfolioManagementController::class, "getPortfolioItemsWithTag"])
    ->name("portfolio-items-with-tag")
    ->middleware('cors');

Route::post("portfolio-items/add-multiple", [PortfolioManagementController::class, "addMultiplePortfolioItems"])
    ->name("add-portfolio-items")
    ->middleware('cors');

Route::post("portfolio-items/import", [PortfolioManagementController::class, "uploadPortfolioItems"])
    ->name("upload-portfolio-items");
