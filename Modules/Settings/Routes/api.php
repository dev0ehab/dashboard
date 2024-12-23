<?php

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

use Illuminate\Support\Facades\Route;

Route::get('settings', 'Api\SettingController@index');
Route::apiResource('contact-us', 'Api\ContactusController')->only('store');

Route::middleware(['auth:sanctum', 'auth-model:admin'])->group(
    function () {
        Route::put('settings', 'Api\SettingController@update');
        Route::apiResource('contact-us', 'Api\ContactusController')->except('store');
    }
);

