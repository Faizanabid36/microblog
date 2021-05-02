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

Route::name('profile.')->prefix('profile')->middleware('auth')->group(function () {
    Route::post('/changeDP', 'profileController@changeDP')->name('changeDP');
    Route::get('/edit/{user_id}', 'profileController@editProfile')->name('editProfile');
    Route::post('/update', 'profileController@updateProfile')->name('updateProfile');
});

Route::get('timeline/{user_id}', 'HomeController@timeline')->middleware('auth')->name('timeline');
Route::middleware('auth')->group(function () {
    Route::name('post.')->prefix('post')->group(function () {
        Route::post('add', 'PostController@store')->name('add');
    });
});

Route::view('test','profile');

