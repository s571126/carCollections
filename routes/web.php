<?php

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


// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'CarsController@index');
    Route::get('cars/{id}', 'CarsController@show')->name('cars.show');
    Route::get('cars/create', 'CarsController@create')->name('cars.create');
    Route::post('cars', 'CarsController@store')->name('cars.store');
    Route::get('cars/{id}/edit', 'CarsController@edit')->name('cars.edit');
    Route::put('cars/{id}', 'CarsController@update')->name('cars.update');
    Route::delete('cars/{id}', 'CarsController@destroy')->name('cars.destroy');
});