<?php

//todo: Перенести в контроллер
Route::get('/', function () {
    return view('pages.index');
});

Route::get('/product','ProductController@show');


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

    Route::post('/order','OrderController@store')->middleware('cart');

});

Route::group(['prefix' => 'catalog'], function () {

    Route::get('/', 'CatalogController@index');

    Route::get('/{full_url}', 'CatalogController@show')->where('full_url', '(.+)');

});


Auth::routes();

Route::get('/home', 'HomeController@index');