<?php
$prefixShopApi = '/api';
Route::group(['prefix' => $prefixShopApi,'namespace' => 'Shop\Api','middleware' => ['jwt.auth']], function () {
    Route::get('/get-list-cat-product-level-2', 'CatProductController@index')->name('catProduct.getList');
    Route::get('/get-list-cat-product-by-parent-id/{parent_id}', 'CatProductController@getListByParent')->name('catProduct.getListByParent')->where('parent_id', '[0-9]+');
    Route::get('/get-list-product/{cat_product_id?}', 'ProductController@index')->name('product.getList')->where('cat_product_id', '[0-9]+');
    Route::get('/detail-product/{id}', 'ProductController@detail')->name('product.detail')->where('cat_product_id', '[0-9]+');
    Route::get('/get-list-product-featurer', 'ProductController@getListFeaturer')->name('product.feather');
    Route::post('/dat-hang','OrderController@completed')->name('order.completed');
    Route::get('/get-list-warehouse','WarehouseController@getList')->name('warehouse.getList');
});

Route::group(['prefix' => $prefixShopApi,'namespace' => 'Shop\Api','middleware' => []], function () {
    Route::get('/get-list-ward/{parentID}','WardController@getList')->name('ward.getList');
    Route::get('/get-list-product-featurer-frontend', 'ProductController@getListFeaturerFrontEnd')->name('product.featurer.frontend');
    Route::get('/get-list-product-suggest-frontend', 'ProductController@getListSuggestFrontEnd')->name('product.suggets.frontend');
    Route::get('/get-list-product-sidebar-right-frontend', 'ProductController@getListProductSidebarRightFrontEnd')->name('product.sidebar.right.frontend');
    Route::get('/get-list-product-sidebar-left-frontend', 'ProductController@getListProductSidebarLeftFrontEnd')->name('product.sidebar.right.frontend');
});
