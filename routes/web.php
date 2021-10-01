<?php

use App\Http\Controllers\MedicalTestController;
use App\Http\Controllers\TestResultController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return redirect()->route('test-results.create');
});
Route::resource('medical-tests', MedicalTestController::class);
Route::resource('test-results', TestResultController::class);

