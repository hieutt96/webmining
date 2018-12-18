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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/find-name','HomeController@findName')->name('find-name');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/statuses/{screen_name}', 'HomeController@statuses')->name('statuses');

Route::get('/display/chart/{id}', 'HomeController@display');
