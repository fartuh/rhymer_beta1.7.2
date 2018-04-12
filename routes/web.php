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

Route::get('/profile/{id}', 'UsersController@profile')->name('profile');

Route::get('/rhyme/{id}', 'IndexController@rhyme')->name('rhyme');


Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/feed', 'UsersController@feed')->name('feed');
    Route::get('/logout', 'UsersController@logout')->name('logout');
    Route::get('/new/rhyme', 'RhymesController@newRhyme')->name('new');
    Route::get('/edit/rhyme/{id}', 'RhymesController@editRhyme')->name('edit');
    Route::get('/delete/rhyme/{id}', 'RhymesController@delete')->name('delete');
    Route::get('/subscribe/{id}', 'UsersController@subscribe')->name('subscribe');
    Route::get('/unsubscribe/{id}', 'UsersController@unsubscribe')->name('unsubscribe');
    Route::get('/subscribeon', 'UsersController@subscribeOn')->name('subscribeon');
    Route::get('/subscribers', 'UsersController@subscribers')->name('subscribers');
});


Auth::routes();

//POST

Route::post('/new/rhyme', 'RhymesController@newRhymePost')->name('newPost');
Route::post('/edit/rhyme', 'RhymesController@editRhymePost')->name('editPost');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
