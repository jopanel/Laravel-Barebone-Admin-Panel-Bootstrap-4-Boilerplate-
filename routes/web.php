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

Route::group(['middleware' => ['web']], function () {
	// login and home page
	Route::get('/', 'App\Http\Controllers\Start@login');
	Route::post('/', 'App\Http\Controllers\Start@login');
	Route::get('/login', 'App\Http\Controllers\Start@login');
	Route::post('/login', 'App\Http\Controllers\Start@login');
	// settings -> admins
	Route::get('/settings/admins/{page}/{adminid}', 'App\Http\Controllers\Main@admins');
	Route::get('/settings/admins/{page}', 'App\Http\Controllers\Main@admins');
	Route::get('/settings/admins', 'App\Http\Controllers\Main@admins');
	Route::post('/settings/admins', 'App\Http\Controllers\Main@admins');
	Route::post('/settings/admins/{page}/{adminid}', 'App\Http\Controllers\Main@admins');
	// settings -> groups
	Route::get('/settings/groups/{page}/{groupid}', 'App\Http\Controllers\Main@groups');
	Route::get('/settings/groups/{page}', 'App\Http\Controllers\Main@groups');
	Route::get('/settings/groups', 'App\Http\Controllers\Main@groups');
	Route::post('/settings/groups', 'App\Http\Controllers\Main@groups');
	Route::post('/settings/groups/{page}/{groupid}', 'App\Http\Controllers\Main@groups');
});

