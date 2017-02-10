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

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', 'Admin\AdminController@index');

    Route::post('/upload', 'Admin\UploadController@upload');

    Route::post('/categories/sort/save', 'Admin\CategoryController@saveSortCategory');

    Route::get('/categories/sort/gets', 'Admin\CategoryController@getCategory');

    Route::resource('/categories', 'Admin\CategoryController');

});

Route::group(['prefix' => 'cart'], function () {

    Route::post('/change','CartController@change');

    Route::post('/clear','CartController@clear');

    Route::get('/show','CartController@show');

});

Route::group(['prefix' => 'account'], function (){

    Route::post('/order','OrderController@store');

});

Route::group(['prefix' => 'catalog'], function () {

    Route::get('/', 'CatalogController@index');

    Route::get('/{full_url}', 'CatalogController@show')->where('full_url', '(.+)');

});


Auth::routes();

Route::get('/home', 'HomeController@index');