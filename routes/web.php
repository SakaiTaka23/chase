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

Route::resource('index', 'UsersController')->only(['index', 'edit', 'update', 'destroy']);
Route::resource('search', 'UsersSearchController')->only(['index']);
Route::resource('place', 'PlaceController')->only(['index']);
