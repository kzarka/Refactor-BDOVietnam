<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'DashboardController@index')->name('dashboard');

Route::get('game/load', 'Game\GameController@load');

Route::resource('game', 'Game\GameController');

Route::get('category/load', 'Category\CategoryController@load');

Route::resource('category', 'Category\CategoryController');

Route::match(['get', 'post'], 'post/approve/', 'Post\PostController@approve')->name('post.approve');

Route::resource('post', 'Post\PostController');