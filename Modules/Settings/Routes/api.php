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
Route::get('show-settings', 'Api\SettingController@index')->name('settings.index');
Route::get('show-about-us', 'Api\SettingController@aboutUs')->name('settings.aboutUs');
Route::get('show-static-pages', 'Api\SettingController@staticPages')->name('settings.static-pages');
Route::get('show-seo', 'Api\SettingController@seo')->name('settings.seo');
Route::get('show-terms-conditions', 'Api\SettingController@terms')->name('settings.terms');
Route::get('show-contacts', 'Api\SettingController@contacts')->name('settings.contacts');
Route::get('show-pixels', 'Api\SettingController@pixels')->name('settings.pixels');

Route::post('contact-us-post', 'Api\SettingController@contactUsPost');
Route::post('activate-model', 'Api\SettingController@activateModel');
