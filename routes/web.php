<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::resource('index', 'UsersController')->only(['index', 'edit', 'update', 'destroy']);
// Route::resource('search', 'UsersSearchController')->only(['index']);
// Route::resource('place', 'PlaceController')->only(['index', 'edit', 'update']);

Route::group(['middleware' => 'auth:user'], function () {
    Route::resource('index', 'UsersController')->only(['index', 'edit', 'update', 'destroy']);
    Route::resource('search', 'UsersSearchController')->only(['index']);
    Route::resource('place', 'PlaceController')->only(['index', 'edit', 'update']);
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/',         function () {
        return redirect('/admin/index');
    });
    Route::get('login',     'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login',    'Admin\LoginController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::resource('index', 'Admin\UsersController')->only(['index', 'edit', 'update', 'create', 'destroy']);
    Route::get('appoint/{id}', 'Admin\UsersController@appoint')->name('admin.appoint');
    Route::get('search', 'Admin\UsersController@search')->name('admin.search');
    Route::get('percent', 'Admin\UsersController@percent')->name('admin.percent');
    Route::post('logout',   'Admin\LoginController@logout')->name('admin.logout');
    //Route::get('home',      'Admin\HomeController@index')->name('admin.home');
});
