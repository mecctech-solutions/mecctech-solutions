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

Route::get("portfolio-items/all");
Route::get("portfolio-items/with-tag");
