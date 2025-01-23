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

Route::post('countries/{country}/status', 'Api\CountryController@status');
Route::apiResource('countries', 'Api\CountryController');


Route::post('cities/{city}/status', 'Api\CityController@status');
Route::apiResource('cities', 'Api\CityController');


Route::post('states/{state}/status', 'Api\StateController@status');
Route::apiResource('states', 'Api\StateController');
