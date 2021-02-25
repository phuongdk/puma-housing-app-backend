<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/welcome', function () {
	return view('welcome');
});

Auth::routes();

// route cho admin và agent
Route::group(['middleware' => ['auth', 'role:admin,agent']], function () {
	Route::get('/', 'DashboardController@index');
	Route::resource('/properties', 'PropertiesController')->except(['show']);

	// routes ảnh
	Route::get('/upload/image', 'UploadController@image_get')->name('upload.image');
	Route::post('/upload/image', 'UploadController@image_create')->name('upload.image');
	Route::delete('/upload/image', 'UploadController@image_delete')->name('upload.image');

	// routes cho settings
	Route::get('/settings', 'SettingsController@index')->name('settings');
	Route::post('/settings', 'SettingsController@update')->name('settings');
});

// routes cho admin
Route::group(['middleware' => ['auth', 'role:admin']], function () {
	Route::resource('/users', 'UsersController')->except(['show', 'create', 'store', 'destroy']);
	Route::post('/users/update_role', 'UsersController@updateRole');

	Route::resource('/cities', 'CitiesController')->except(['show']);
	Route::resource('/property_categories', 'PropertyCategoriesController')->except(['show']);
	Route::resource('/news', 'NewsController')->except(['show']);
	Route::resource('/news_categories', 'NewsCategoriesController')->except(['show']);
	});
