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
    Route::get('cars_show/{id}', 'CarsController@show')->name('cars.show');
    Route::get('cars_create', 'CarsController@create')->name('cars.create');
    Route::post('cars_store', 'CarsController@store')->name('cars.store');
    Route::get('cars_edit/{id}', 'CarsController@edit')->name('cars.edit');
    Route::put('cars_update/{id}', 'CarsController@update')->name('cars.update');
    Route::delete('cars_destroy/{id}', 'CarsController@destroy')->name('cars.destroy');
    Route::get('cars_copy/{id}', 'CarsController@copy')->name('cars.copy');
    Route::post('cars_image', 'CarsController@image_upload')->name('cars.image');
    Route::delete('pictures_destroy/{id}', 'CarsController@destroyPictures')->name('pictures.destroy');    
});