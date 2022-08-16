<?php


$prefixShopFrontend = '';
Route::group(['prefix' => $prefixShopFrontend,'namespace' => 'Shop\FrontEnd'], function () {
    Route::get('/','HomeController@index')->name('home');
    Route::get('/danh-muc-san-pham','CatController@index')->name('fe.category_level2');
    Route::get('/danh-muc-san-pham-chi-tiet','CatController@view_full')->name('fe.category_level2_full');
});