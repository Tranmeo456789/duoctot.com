<?php


$prefixShopFrontend = '';
Route::group(['prefix' => $prefixShopFrontend,'namespace' => 'Shop\FrontEnd'], function () {
    Route::get('/','HomeController@index')->name('home');
    Route::get('/ajaxcat3','HomeController@ajaxcat3')->name('ajaxcat3');
    Route::get('/ajaxcat1','HomeController@ajaxcat1')->name('ajaxcat1');
    Route::get('/ajaxlocal-store','HomeController@ajaxlocal')->name('fe.ajaxlocal');
    Route::get('/chi-tiet-san-pham/{id}','ProductController@detail')->name('fe.product.detail');

    Route::post('/hoan-tat-dat-hang','OrderController@completed')->name('fe.order.completed');
    Route::get('/dat-hang/thanh-cong/{code}','OrderController@success')->name('fe.order.success');
    Route::get('/thu-test','OrderController@test');

    Route::get('/don-thuoc','PrescripController@index')->name('fe.prescrip.index');

    Route::get('/gio-hang/{user_sell}','CartController@view')->name('fe.product.viewcart');

    Route::get('/gio-hang-full','CartController@cart_product')->name('fe.product.cart');
    Route::get('/gio-hang-trong','CartController@cart_null')->name('fe.product.cart_null');
    Route::post('/them-san-pham-gio-hang','CartController@addproduct')->name('fe.cart.addproduct');
    Route::post('/thay-doi-so-luong-san-pham/{user_sell}-{id}-{quantity}','CartController@changeQuatity')->name('fe.cart.change_quatity');

    Route::get('/danh-sach-kho-hang','WarehouseController@getList')->name('fe.warehouse.getList');

    Route::get('/xoa-san-pham-gio-hang/{user_sell}-{id}','CartController@delete')->name('fe.cart.delete');
    Route::get('/{slug}','CatController@index')->name('fe.cat');
    Route::get('/{slug1}/{slug2}','CatController@cat_level2')->name('fe.cat2');
    Route::get('/{slug1}/{slug2}/{slug3}','CatController@cat_level3')->name('fe.cat3');
});