<?php


$prefixShopFrontend = '';
Route::group(['prefix' => $prefixShopFrontend,'namespace' => 'Shop\FrontEnd'], function () {
    Route::get('/','HomeController@index')->name('home');
    Route::get('/ajaxHoverCatLevel2','HomeController@ajaxHoverCatLevel2')->name('ajaxHoverCatLevel2');
    Route::get('/ajaxHoverCatLevel1','HomeController@ajaxHoverCatLevel1')->name('ajaxHoverCatLevel1');
    Route::get('/ajaxlocal-store','HomeController@ajaxlocal')->name('fe.ajaxlocal');
    Route::get('/chi-tiet-san-pham/{id}','ProductController@detail')->name('fe.product.detail');
    Route::get('/tim-kiem-san-pham-theo-ten','ProductController@searchProductAjax')->name('fe.product.searchProductAjax');
    Route::get('/ajax-filter-product-object','HomeController@ajax_filter')->name('fe.home.ajaxfilter');

    Route::post('/hoan-tat-dat-hang','OrderController@completed')->name('fe.order.completed');
    Route::get('/dat-hang/thanh-cong/{code}','OrderController@success')->name('fe.order.success');
    Route::get('/don-hang-cua-toi','OrderController@list')->name('fe.order.list');
    Route::get('/chi-tiet-don-hang-cua-toi','OrderController@detail')->name('fe.order.detail');
    Route::get('/loc-don-hang-cua-toi','OrderController@ajaxFliter')->name('fe.order.ajaxFliter');
    Route::get('/thu-test','OrderController@test');

    Route::get('/don-thuoc','PrescripController@index')->name('fe.prescrip.index');
    Route::post('/luu-don-thuoc-khach-hang','PrescripController@save')->name('fe.prescrip.save');
    Route::get('/don-thuoc-khach-hang/{id}','PrescripController@prescripCustomer')->name('fe.prescrip.prescripCustomer');

    Route::get('/gio-hang/{user_sell}','CartController@view')->name('fe.product.viewcart');
    Route::get('/gio-hang-full','CartController@cart_product')->name('fe.product.cart');
    Route::get('/gio-hang-trong','CartController@cart_null')->name('fe.product.cart_null');
    Route::post('/them-san-pham-gio-hang','CartController@addproduct')->name('fe.cart.addproduct');
    Route::post('/thay-doi-so-luong-san-pham/{user_sell}-{id}-{quantity}','CartController@changeQuatity')->name('fe.cart.change_quatity');

    Route::get('/danh-sach-kho-hang','WarehouseController@getList')->name('fe.warehouse.getList');

    Route::post('/luu-noi-dung-tim-kiem-trang-chu','SearchController@saveHome')->name('fe.search.saveHome');
    Route::get('/tim-kiem/{keyword}','SearchController@viewHome')->name('fe.search.viewHome');

    Route::get('/xoa-san-pham-gio-hang/{user_sell}-{id}','CartController@delete')->name('fe.cart.delete');
    
    Route::get('/{slug}','CatController@catLevel1')->name('fe.cat');
    Route::get('/{slug1}/{slug2}','CatController@catLevel2')->name('fe.cat2');
    Route::get('/{slug1}/{slug2}/{slug3}','CatController@catLevel3')->name('fe.cat3');
});