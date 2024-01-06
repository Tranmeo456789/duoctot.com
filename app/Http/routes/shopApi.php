<?php
$prefixShopApi = '/api';
Route::group(['prefix' => $prefixShopApi,'namespace' => 'Shop\Api','middleware' => ['jwt.auth']], function () {
    Route::get('/get-list-cat-product-level-2', 'CatProductController@index')->name('catProduct.getList');
    Route::get('/get-list-cat-product-by-parent-id/{parent_id}', 'CatProductController@getListByParent')->name('catProduct.getListByParent')->where('parent_id', '[0-9]+');
    Route::get('/get-list-product/{cat_product_id?}', 'ProductController@index')->name('product.getList')->where('cat_product_id', '[0-9]+');
    Route::get('/detail-product/{id}', 'ProductController@detail')->name('product.detail')->where('cat_product_id', '[0-9]+');
    Route::get('/get-list-product-featurer', 'ProductController@getListFeaturer')->name('product.feather');
    Route::post('/dat-hang','OrderController@completed')->name('order.completed');
    Route::get('/order/get-list','OrderController@getList')->name('order.getList');
    Route::get('/get-list-warehouse','WarehouseController@getList')->name('warehouse.getList');
});

Route::group(['prefix' => $prefixShopApi,'namespace' => 'Shop\Api','middleware' => []], function () {
    Route::get('/get-list-ward/{parentID}','WardController@getList')->name('ward.getList');
    Route::get('/cat/getListCatProductFrontEnd','CatProductController@getListByDepthFrontEnd');

    $prefix         = 'product';
    $controllerName = 'product';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
         Route::get('getListFeaturerFrontEnd', ['uses' => $controller . 'getListFeaturerFrontEnd']);
         Route::get('getListProductByProductID', ['uses' => $controller . 'getListProductByProductID']);
         Route::get('getListProductShowFrontEnd', ['uses' => $controller . 'getListProductShowFrontEnd']);
     });

     $prefix         = 'affiliate';
     $controllerName = 'affiliate';
     Route::group(['prefix' => $prefix], function () use($controllerName) {
         $controller = ucfirst($controllerName)  . 'Controller@';
          Route::get('getItem', ['uses' => $controller . 'getItem']);
    });

});
