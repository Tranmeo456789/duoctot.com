<?php


$prefixShopFrontend = '';
Route::group(['prefix' => $prefixShopFrontend,'namespace' => 'Shop\FrontEnd'], function () {
    Route::get('/','HomeController@index')->name('home');
    Route::post('/ajaxcat3','HomeController@ajaxcat3')->name('ajaxcat3');
    Route::get('/ajaxcat1','HomeController@ajaxcat1')->name('ajaxcat1');
    Route::get('/chi-tiet-san-pham/{id}','ProductController@detail_product')->name('fe.product.detail');
    Route::get('/gio-hang','CartController@cart_product')->name('fe.product.cart');
    Route::get('/gio-hang-trong','CartController@cart_null')->name('fe.product.cart_null');
    Route::get('/thanh-toan-tai-nha','CartController@pay_home')->name('fe.product.pay_home');
    Route::get('/thanh-toan-tai-cua-hang','CartController@pay_shop')->name('fe.product.pay_shop');
    Route::get('/{slug}','CatController@index')->name('fe.cat');
    Route::get('/{slug1}/{slug2}','CatController@cat_level2')->name('fe.cat2');
    Route::get('/{slug1}/{slug2}/{slug3}','CatController@cat_level3')->name('fe.cat3');  
});