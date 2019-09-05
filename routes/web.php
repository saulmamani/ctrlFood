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

Route::resource('users', 'UserController');
Route::put('users.update_foto/{id}',  ['as'=>'users.update_foto', 'uses'=>'UserController@updateFoto']);
Route::put('users.update_password/{id}',  ['as'=>'users.update_password', 'uses'=>'UserController@updatePassword']);

Route::resource('products', 'ProductController');

Route::resource('clients', 'ClientController', ['except'=>'show']);


Route::resource('sales', 'SaleController');

Route::resource('details', 'DetailController');