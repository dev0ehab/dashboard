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
Route::post('menus/{menu}/status', 'Api\MenuController@status');
Route::apiResource('menus', 'Api\MenuController');


Route::post('allergens/{allergens}/status', 'Api\AllergenController@status');
Route::apiResource('allergens', 'Api\AllergenController');


Route::post('meal-categories/{meal_categories}/status', 'Api\MealCategoryController@status');
Route::apiResource('meal-categories', 'Api\MealCategoryController');




