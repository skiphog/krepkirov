<?php

//todo: Перенести в контроллер
Route::get('/', function () {
    return view('pages.index');
});

Route::get('/certificates', function () {
    return view('pages.certificates');
});

Route::get('/contacts', function () {
    return view('pages.contacts');
});

Route::get('/prices', 'PriceController@index');

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', 'Admin\AdminController@index');

    Route::post('/upload', 'Admin\UploadController@upload');

    Route::post('/upload/product', 'Admin\UploadController@uploadProductImg');

    Route::post('/categories/sort/save', 'Admin\CategoryController@saveSortCategory');

    Route::get('/categories/sort/gets', 'Admin\CategoryController@getCategory');

    Route::resource('/categories', 'Admin\CategoryController');

    Route::get('/products', 'Admin\ProductController@index');

    Route::get('/products/search', 'Admin\ProductController@search');

    Route::get('/products/get', 'Admin\ProductController@getProductOnCategory');

    Route::post('/products/sort', 'Admin\ProductController@saveSortProduct');

    Route::post('/products/destroy', 'Admin\ProductController@destroy');

    Route::get('/products/{product}/edit', 'Admin\ProductController@edit');

    Route::put('/products/{product}', 'Admin\ProductController@update');

    Route::get('/price', 'Admin\PriceController@index');

    Route::post('/price/upload', 'Admin\PriceController@upload');

});

Route::group(['prefix' => 'cart'], function () {

    Route::post('/change', 'CartController@change');

    Route::post('/clear', 'CartController@clear');

    Route::get('/show', 'CartController@show');

});

Route::group(['prefix' => 'account'], function () {

    Route::post('/order', 'OrderController@store')->middleware('cart');

});

Route::group(['prefix' => 'catalog'], function () {

    Route::get('/', 'CatalogController@index');

    Route::get('/{full_url}', 'CatalogController@show')->where('full_url', '(.+)');

});


Auth::routes();

Route::get('/home', 'HomeController@index');