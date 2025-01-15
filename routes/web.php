<?php

use App\Actions\SubmitContactRequest;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/partners', function () {
    return view('partners');
});

Route::get('/case-study', function () {
    return view('portfolio.details');
});

Route::post('/submit-contact-request', SubmitContactRequest::class)
    ->name('submit-contact-request');

Route::get('language/{language}', function ($language) {
    session()->put('locale', $language);
    return;
})->name('language');
