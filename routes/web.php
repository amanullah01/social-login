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

Auth::routes();

Route::get('/home', 'HomeController@index');

/*Social login*/
/*Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider')->name('facebook');
Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');*/

/*End social login*/
Route::group(['prefix' => 'auth','namespace' => 'Auth'], function() {
  Route::get('facebook', [
      'as' => 'facebook', 'uses' => 'RegisterController@redirectToProvider'
  ]);

  Route::get('facebook/callback', [
      'as' => 'facebook/callback', 'uses' => 'RegisterController@handleProviderCallback'
  ]);
});
