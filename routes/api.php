<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
		return $request->user();
});

Route::get('/test', function () {
	return response()->json('Server api is working', 200);
});

// authenticated apis
Route::middleware('auth:api')->group(function () {
	// Properties
	Route::get('/properties/likes', 'api\PropertiesController@likedProperties');
	Route::post('/properties/like', 'api\PropertiesController@likeProperty');

	// Profile
	Route::post('/profile/updateprofileimage', 'api\ProfileController@updateProfileImage');
	Route::get('/profile/userinfo', 'api\ProfileController@userInfo');
});

// login & register
Route::prefix('/auth')->group(function () {
	Route::post('/login', 'api\AuthController@login');
	Route::post('/register', 'api\AuthController@register');
});

// Dashboard
Route::get('/dashboard', 'api\DashboardController@get');

// Properties
Route::post('/properties/search', 'api\PropertiesController@searchProperties');
Route::get('/properties/search/constants', 'api\PropertiesController@searchConstants');

// App settings
Route::get('/appsettings', 'api\AppSettingsController@get');
Route::get('/appsettings/aboutus', 'api\AppSettingsController@aboutUs');
Route::get('/appsettings/userterms', 'api\AppSettingsController@userTerms');
Route::get('/appsettings/privacypolicy', 'api\AppSettingsController@privacyPolicy');

// News
Route::get('/news', 'api\NewsController@get');
