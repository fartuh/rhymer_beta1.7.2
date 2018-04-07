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

Route::get('/', 'IndexController@index')->name('index');

Route::get('/account/{id}', 'IndexController@findaccount')->name('findaccount');

Route::get('/rhyme/{id}', 'IndexController@rhyme')->name('rhyme');

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/account', 'IndexController@account')->name('account');
    Route::get('/logout', 'IndexController@logout')->name('logout');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
