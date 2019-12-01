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

Route::get('/', 'MainController@index')->name('home');

Route::get('/view/{category}/{post}', 'Post\PostController@view');

Route::get('/category/{category?}', 'Category\CategoryController@index');

Route::resource('comment', 'Comment\CommentController');