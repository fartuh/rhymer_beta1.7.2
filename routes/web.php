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

//GET

Route::get('/', 'IndexController@index')->name('index');
Route::get('/rhymes', 'IndexController@index')->name('rhymes');
Route::get('/rhymes/tag/{tag}', 'SearchController@tag')->name('tag');

Route::get('/profile/{id}', 'IndexController@profile')->name('profile');

Route::get('/rhyme/{id}', 'IndexController@rhyme')->name('rhyme');


Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/logout', 'IndexController@logout')->name('logout');
    Route::get('/new/rhyme', 'IndexController@newRhyme')->name('new');
    Route::get('/edit/rhyme/{id}', 'IndexController@editRhyme')->name('edit');
    Route::get('/delete/rhyme/{id}', 'IndexController@delete')->name('delete');
});


Auth::routes();

//POST

Route::post('/new/rhyme', 'IndexController@newRhymePost')->name('newPost');
Route::post('/edit/rhyme', 'IndexController@editRhymePost')->name('editPost');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
