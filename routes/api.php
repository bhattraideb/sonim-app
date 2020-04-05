<?php

use Illuminate\Http\Request;
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
Route::group(['middleware' => 'api'], function(){
    Route::group(['prefix' => 'v1'], function() {
        Route::group(['prefix' => 'users'], function() {
            Route::post('/register', 'API\V1\RestApiController@register');
            Route::post('/signin', 'API\V1\RestApiController@login');
            Route::put('/changepassword', 'API\V1\RestApiController@updatePassword');
            Route::get('/logout', 'API\V1\RestApiController@logout');
        });

        Route::group(['prefix' => 'company'], function() {
            Route::get('list', 'API\V1\RestApiController@getCompanies');
            Route::get('delete/{id}', 'API\V1\RestApiController@deleteCompany');
            Route::get('admins', 'API\V1\RestApiController@getAdmins');
        });

    });
});
