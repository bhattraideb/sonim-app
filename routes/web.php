<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('/create', 'CompanyController@store')->name('company.store');
Route::middleware('auth:web')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::group(['prefix' => 'company'], function() {
        Route::get('/', 'CompanyController@index')->name('companies.list');
        Route::get('/admins/{id}', 'CompanyAdminController@index')->name('company.admin.list');
        Route::get('/add', 'CompanyController@create')->name('company.create');
        Route::post('/create', 'CompanyController@store')->name('company.store');
        Route::get('/edit/{id}', 'CompanyController@edit')->name('company.edit');
        Route::post('/update', 'CompanyController@update')->name('company.update');
        Route::get('/delete/{id}', 'CompanyController@destroy')->name('company.delete');

        Route::group(['prefix' => 'admin'], function() {
            Route::get('/', 'CompanyAdminController@index')->name('admin.list');
            Route::get('/add', 'CompanyAdminController@create')->name('admin.create');
            Route::post('/create', 'CompanyAdminController@store')->name('admin.store');
            Route::get('/edit/{id}', 'CompanyAdminController@edit')->name('admin.edit');
            Route::post('/update', 'CompanyAdminController@update')->name('admin.update');
            Route::get('/delete/{id}', 'CompanyAdminController@destroy')->name('admin.delete');
        });
    });
    Route::get('auth/logout', 'Auth\LoginController@logout')->name('logout');
});

