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

Route::middleware(['auth:sanctum', 'auth-model:admin'])->group(
    function () {
        Route::apiResource('roles', 'Api\RoleController');
        Route::post('roles/{admin}/block', 'Api\RoleController@block');
        Route::post('roles/{admin}/unblock', 'Api\RoleController@unblock');
        Route::apiResource('permissions', 'Api\PermissionController')->only(['index']);
    }
);
