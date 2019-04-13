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

// ログインボタンからのリンク
Route::get('/login/{social}', 'Auth\LoginController@socialLogin')->where('social', 'github|facebook|twitter')->name('social_login');
// コールバック
Route::get('/login/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'github|facebook|twitter')->name('callback');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', 'HomeController@showLogout')->name('logout');
    Route::post('/logout', 'Auth\LoginController@logout');

    Route::get('/add', 'HomeController@showPostForm')->name('add');
    Route::post('/add', 'HomeController@create');

    Route::post('/', 'HomeController@destroy');

    Route::post('/likes/users/{post_id}', 'LikeController@createOrDestroyLike')->name('push_like');
});

Route::get('/', 'HomeController@index')->name('home');

Route::get('/login', 'HomeController@showLogin')->name('login');

Route::get('/profile/{user_id}', 'ProfileController@index')->name('profile');

Route::get('/likes/users/{post_id}', 'LikeController@index')->name('likes');
