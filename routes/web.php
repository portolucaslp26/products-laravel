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

Auth::routes();

Route::get('/', 'ProductController@index')->name('home');
Route::get('/{id}/show', 'ProductController@show')->name('show');
Route::get('/create', 'ProductController@create')->name('create');
Route::post('/', 'ProductController@store')->name('store');
Route::get('/{id}/edit', 'ProductController@edit')->name('edit');
Route::delete('/{id}/delete', 'ProductController@destroy')->name('destroy');
Route::put('/{id}', 'ProductController@update')->name('update');
Route::delete('/{id}/delete-image/{imageId}', 'ProductController@destroyImage')->name('destroyImage');





