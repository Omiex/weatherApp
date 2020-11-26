<?php

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
Route::get('/', App\Http\Controllers\HomeController::class); // get weather with default location
Route::get('/{lat}/{lon}', [App\Http\Controllers\HomeController::class, 'index'])
	->where(['lat' => '[-0-9.]+', 'lon' => '[-0-9.]+']); // get weather with spesific location
