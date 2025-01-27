<?php

use App\Actions\SubmitContactRequest;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
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

Route::post('/submit-contact-request', SubmitContactRequest::class)
    ->name('submit-contact-request');

Route::get('locale/', function (Request $request) {
    $request->validate([
        'locale' => 'required|string|in:en,nl',
    ]);

    $language = $request->get('locale');
    session(['locale' => $language]);
    app()->setLocale($language);

    return redirect()->back();
})->name('locale.change');

Route::get('/case-studies/{caseStudy:slug}', [CaseStudyController::class, 'show'])->name('case-studies.show');
