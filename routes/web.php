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
    return view('pages.index');
});

Route::group(['prefix' => 'admin'],function (){


    Route::get('/','Admin\AdminController@index');

    Route::resource('categories','Admin\CategoryController');


});



Route::get('/catalog','CatalogController@index');
Route::get('/catalog/{full_url}','CatalogController@show')->where('full_url','(.+)');


Auth::routes();

Route::get('/home', 'HomeController@index');