<?php

use App\Actions\GetAllPortfolioItems;
use App\Actions\ImportPortfolioItems;
use App\CustomerRelationshipManagement\Presentation\Http\Api\CustomerRelationshipManagementController;
use App\PortfolioManagement\Presentation\Http\Api\PortfolioManagementController;
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

Route::get('/customerrelationshipmanagement', [CustomerRelationshipManagementController::class, 'index']);
Route::get("portfolio-items", GetAllPortfolioItems::class)
    ->name("all-portfolio-items")
    ->middleware('cors');

Route::post("portfolio-items/add-multiple", [PortfolioManagementController::class, "addMultiplePortfolioItems"])
    ->name("add-portfolio-items")
    ->middleware('cors');

Route::post("portfolio-items/import", ImportPortfolioItems::class)
    ->name("import-portfolio-items");
