<?php

use Illuminate\Http\Request;

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



Route::group(['prefix' => 'v1','guard' => 'api' ], function(){

    Route::post('login', 'API\AuthController@login');
    Route::post('logout', 'API\AuthController@logout');
    Route::post('refresh', 'API\AuthController@refresh');
    Route::get('user', 'API\AuthController@me')->middleware('jwt.auth');

    // Utils
    Route::get('cities', 'API\UtilController@getCities');
    Route::get('city/{city_id}/districts', 'API\UtilController@getDistricts');
    Route::get('district/{district_id}/wards', 'API\UtilController@getWards');

    // Upload medias

    Route::post('uploads', 'API\MediaController@upload');

});