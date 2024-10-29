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

Route::prefix('admin')->middleware('auth-type')->group(
    function () {

        Route::post('/register', 'Api\RegisterController@register');
        Route::post('/login', 'Api\LoginController@login');

        Route::post('/password/reset/send', 'Api\ResetPasswordController@send');
        Route::post('/password/reset/resend', 'Api\ResetPasswordController@send');
        Route::post('/password/reset/verify', 'Api\ResetPasswordController@verify');
        Route::post('/password/reset', 'Api\ResetPasswordController@reset');

        Route::post('verification/send', 'Api\VerificationController@send');
        Route::post('verification/resend', 'Api\VerificationController@send');
        Route::post('verification/verify', 'Api\VerificationController@verify');

    }
);


Route::prefix('admin')->middleware('auth:sanctum')->group(
    function () {
        Route::get('profile', 'Api\ProfileController@show');
        Route::post('profile/update', 'Api\ProfileController@update');
        Route::post('profile/delete', 'Api\ProfileController@delete');

        Route::post('password/update', 'Api\ProfileController@password');
        Route::post('preferred-locale/update', 'Api\ProfileController@preferredLocale');
        Route::post('fcm/update', 'Api\ProfileController@fcm');

        Route::post('logout', 'Api\ProfileController@logout');

        Route::post('authenticable/update/send', 'Api\ChangeAuthenticable@send');
        Route::post('authenticable/update/verify', 'Api\ChangeAuthenticable@verify');

    }
);
