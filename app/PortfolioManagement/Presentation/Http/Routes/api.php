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

Route::get("portfolio-items", [PortfolioManagementController::class, "getPortfolioItems"])
    ->name("all-portfolio-items")
    ->middleware('cors');

Route::post("portfolio-items/add-multiple", [PortfolioManagementController::class, "addMultiplePortfolioItems"])
    ->name("add-portfolio-items")
    ->middleware('cors');

Route::post("portfolio-items/import", [PortfolioManagementController::class, "importPortfolioItems"])
    ->name("import-portfolio-items");
