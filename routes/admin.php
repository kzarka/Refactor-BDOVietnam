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

Route::namespace('Post')->group(function () {
    Route::get('post/manage', 'PostController@manage')->name('post.manage');

	Route::match(['get', 'post'], 'post/approve/', 'PostController@approve')->name('post.approve');

	Route::match(['get', 'post'], 'post/preview/{postId?}', 'PostController@preview')->name('post.preview');

	Route::resource('post', 'PostController');
});

Route::namespace('User')->group(function () {
	Route::match(['get', 'post'], 'user/profile/update', 'UserController@selfUpdate')->name('user.self_update');

	Route::get('profile/{id?}', 'UserController@profile')->name('user.profile');

	Route::post('user/ban', 'UserController@ban')->name('user.ban')->middleware('admin');

	Route::post('user/lift/{id}', 'UserController@lift')->name('user.lift')->middleware('admin');

	Route::get('user/notification', 'UserController@getNofication')->name('user.notification');

	Route::resource('user', 'UserController');
});

Route::namespace('Setting')->group(function () {
	Route::match(['get', 'post'], 'setting/sys_var', 'SystemVarController@update')->name('setting.sys_var');
});

Route::namespace('Comment')->group(function () {
	Route::resource('comment', 'CommentController');
});

Route::namespace('Log')->group(function () {
	Route::get('log/activity', 'ActivityController@index')->name('log.activity');
});