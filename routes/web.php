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

Route::get('logout', 'Auth\LoginController@logout');

Auth::routes();

Route::get('/', 'MainController@index')->name('home');

Route::get('/view/{category}/{post}', 'Post\PostController@view')->middleware('view.post.filter');

Route::get('/category/{category?}', 'Category\CategoryController@index');

Route::get('/' .DEFAULT_TAG_URL_PREFIX. '/{tag?}', 'Tag\TagController@index')->name('tag');

Route::get('/' .DEFAULT_AUTHOR_URL_PREFIX. '/{author}', 'User\AuthorController@index');

Route::resource('comment', 'Comment\CommentController');

Route::get('/search', 'MainController@search')->name('search');