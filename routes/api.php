<?php

Route::post('/search', 'SearchController@search')->name('search');

Route::match(['get', 'post'], '/exchange', 'Admin\ExchangeController@run');