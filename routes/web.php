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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('index');
Route::post('/products/search', 'App\Http\Controllers\ProductController@search')->name('search');

Route::get('/products/create', 'App\Http\Controllers\ProductController@create')->name('create');
Route::post('/products/store', 'App\Http\Controllers\ProductController@store')->name('store');

Route::get('/products/show/{id}', 'App\Http\Controllers\ProductController@show')->name('show');

Route::get('/products/edit/{id}', 'App\Http\Controllers\ProductController@edit')->name('edit');
Route::put('/products/update/{id}', 'App\Http\Controllers\ProductController@update')->name('update');

Route::post('/products/{id}/destroy', 'App\Http\Controllers\ProductController@destroy')->name('destroy');
