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
Route::resource('profile', 'profileController');
Route::resource('home', 'homeController');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/updatePhoto', 'ProfileController@updatePhoto')->name('updatePhoto');
Route::post('/follow', 'ProfileController@follow')->name('follow');
Route::post('/unfollow', 'ProfileController@unfollow')->name('unfollow');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/unknown_profile', 'UnknownProfileController@index')->name('unknownProfile');




Route::get('/glossary', 'GlossaryController@index')->name('glossary');

