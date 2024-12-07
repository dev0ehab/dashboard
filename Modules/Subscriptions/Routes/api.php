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

Route::post('plan-categories/{plan_category}/status', 'Api\PlanCategoryController@status');
Route::apiResource('plan-categories', 'Api\PlanCategoryController');


Route::post('plans/{plan}/status', 'Api\PlanController@status');
Route::apiResource('plans', 'Api\PlanController');
