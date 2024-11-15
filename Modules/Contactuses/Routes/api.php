<?php

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

Route::apiResource('contact-us', 'Api\ContactusController')->only('store');
Route::middleware(['auth:sanctum', 'auth-model:admin'])->group(
    function () {
        Route::apiResource('contact-us', 'Api\ContactusController')->except('store');
    }
);

