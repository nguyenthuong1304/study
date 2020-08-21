<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::resource('categories', 'CategoryController');
    Route::get('categories_count_user', 'CategoryController@getCategoriesAndCountUser');
});

Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1'], function () {
    Route::resource('users', 'UserController');
    Route::resource('home', 'HomeController');
    Route::post('search', 'HomeController@search');
});

Route::group([
    'middleware' => 'api',
    'namespace' => 'Api\V1',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group([
    'middleware' => 'auth:api',
    'namespace' => 'Api\V1',
    'prefix' => 'v1',
], function () {
    Route::post('add-favorite/{user_id}', 'UserController@addFavorite');
});
