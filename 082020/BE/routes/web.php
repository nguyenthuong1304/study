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

Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::resource('users', 'UserController')->except('update');
    Route::resource('category', 'CategoryController')->except('edit', 'create');
    Route::post('user_update/{id}', 'UserController@update')->name('update-user');
    Route::get('user_tag/{user_id}', 'UserController@userTag');
    Route::post('user_tag/{user_id}', 'UserController@addHashtag')->name('addHashTag');
    Route::resource('hashtag', 'HashTagController');
    Route::post('upload-images/{user_id}', 'UserController@uploadImages')->name('upload-multi');
});

Route::get('/login', function() {
    return view('auth.login');
})->name('login');

Auth::routes();
