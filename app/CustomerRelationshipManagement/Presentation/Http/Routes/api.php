<?php

use App\CustomerRelationshipManagement\Presentation\Http\Api\CustomerRelationshipManagementController;
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

Route::get('/customerrelationshipmanagement', [CustomerRelationshipManagementController::class, 'index']);
Route::post('/submit-contact-request', [CustomerRelationshipManagementController::class, 'submitContactRequest'])->name('submit-contact-request');