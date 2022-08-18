<?php


$prefixShopFrontend = '';
Route::group(['prefix' => $prefixShopFrontend,'namespace' => 'Shop\FrontEnd'], function () {
    Route::get('/','HomeController@index')->name('home');
    Route::get('/danh-muc-san-pham','CatController@index')->name('fe.cat');
    Route::get('/danh-muc-san-pham-cap-3','CatController@cat_level3')->name('fe.cat3');
    Route::get('/danh-muc-san-pham-cap-4','CatController@cat_level4')->name('fe.cat4');
});