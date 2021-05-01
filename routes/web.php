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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/timeline', 'HomeController@timeline')->middleware('auth')->name('timeline');
Route::name('post.')->prefix('post')->group(function () {
    Route::post('/add', 'PostController@store')->name('add');
});
Route::name('profile.')->prefix('profile')->group(function () {
    Route::post('/changeDP', 'profileController@changeDP')->name('changeDP');
});

