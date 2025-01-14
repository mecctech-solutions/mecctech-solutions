<?php

use App\CustomerRelationshipManagement\Presentation\Http\CustomerRelationshipManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/customerrelationshipmanagement', [CustomerRelationshipManagementController::class, 'index']);
Route::post('/submit-contact-request', [CustomerRelationshipManagementController::class, 'submitContactRequest'])->name('submit-contact-request');
