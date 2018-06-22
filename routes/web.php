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

Route::get('/', function () {
    return view('welcome');
});


// 「/」というURLにアクセスしたとき、welcomecontroller@indexへ飛べ
Route::get('/', 'WelcomeController@index');


//user登録機能をつかさどるルータ
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');


// ログイン認証をつかさどるルータ
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');


//検索結果を表示するページのcreate
Route::group(['middleware' => ['auth']], function () {
    Route::resource('items', 'ItemsController', ['only' => ['create']]);
});



//want機能の実装→のちに、追加でhave機能を実装
Route::group(['middleware' => ['auth']], function () {
    Route::resource('items', 'ItemsController', ['only' => ['create', 'show']]);
    Route::post('want', 'ItemUserController@want')->name('item_user.want');
    Route::delete('want', 'ItemUserController@dont_want')->name('item_user.dont_want');
    Route::post('have', 'ItemUserController@have')->name('item_user.have');
    Route::delete('have', 'ItemUserController@dont_have')->name('item_user.dont_have');
    Route::resource('users', 'UsersController', ['only' => ['show']]);
});



