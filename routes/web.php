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




});
