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

use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect('home');
});


Auth::routes();

Route::get('/home', 'HomeController@index');


Route::group(['middleware'=>'auth'], function(){
    Route::resource('users', 'UserController');
    Route::put('users.update_foto/{id}',  ['as'=>'users.update_foto', 'uses'=>'UserController@updateFoto']);
    Route::put('users.update_password/{id}',  ['as'=>'users.update_password', 'uses'=>'UserController@updatePassword']);

    Route::resource('products', 'ProductController');
    Route::get('product_list', 'ProductController@product_list');

    Route::resource('clients', 'ClientController', ['except'=>'show']);
    Route::get('clients_list/{nit}', 'ClientController@clients_list');

    Route::resource('sales', 'SaleController');

    Route::resource('details', 'DetailController');

});
