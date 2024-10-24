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

Route::prefix('admin')->middleware('auth-type')->group(
    function () {

        Route::post('/register', 'Api\RegisterController@register');
        Route::post('/login', 'Api\LoginController@login');

        Route::post('/password/forget', 'Api\ResetPasswordController@forget');
        Route::post('/password/code', 'Api\ResetPasswordController@code');
        Route::post('/password/reset', 'Api\ResetPasswordController@reset');

        Route::post('verification/send', 'Api\VerificationController@send');
        Route::post('verification/resend', 'Api\VerificationController@send');
        Route::post('verification/verify', 'Api\VerificationController@verify');

    }
);


Route::prefix('admin')->middleware('auth:sanctum')->group(
    function () {
        Route::get('profile', 'Api\ProfileController@show');
        Route::post('profile', 'Api\ProfileController@update');

        Route::post('preferred-locale', 'Api\ProfileController@preferredLocale');
        Route::post('fcm', 'Api\ProfileController@fcm');

        Route::post('logout', 'Api\ProfileController@logout');

        Route::post('change-authenticable', 'Api\ChangeAuthenticable@send');
        Route::post('change-authenticable/verify', 'Api\ChangeAuthenticable@verify');

    }
);
