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

// Controllerを経由してView(welcome表示)に進むようにする
Route::get('/', 'MicropostsController@index');    // 上書き

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// 認証付きのルーティング(authを使う)
Route::group(['middleware' => ['auth']], function () {
    // onlyで作成するルートを絞り込む
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    // Micropostsのルーティング
    Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
});
