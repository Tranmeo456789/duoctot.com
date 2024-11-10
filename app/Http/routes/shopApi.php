<?php
$prefixShopApi = '/api';
Route::group(['prefix' => $prefixShopApi,'namespace' => 'Shop\Api','middleware' => ['jwt.auth']], function () {
    
});

Route::group(['prefix' => $prefixShopApi,'namespace' => 'Shop\Api','middleware' => []], function () {
    Route::get('/get-list-cat-product-level-2', 'CatProductController@index')->name('catProduct.getList');
    Route::get('/get-list-cat-product-by-parent-id/{parent_id}', 'CatProductController@getListByParent')->name('catProduct.getListByParent')->where('parent_id', '[0-9]+');
    Route::get('/get-list-product/{cat_product_id?}', 'ProductController@index')->name('product.getList')->where('cat_product_id', '[0-9]+');
    Route::get('/detail-product/{id}', 'ProductController@detail')->name('product.detail')->where('cat_product_id', '[0-9]+');
    Route::get('/get-list-product-featurer', 'ProductController@getListFeaturer')->name('product.feather');
    Route::post('/dat-hang','OrderController@completed')->name('order.completed');
    Route::get('/order/get-list','OrderController@getList')->name('order.getList');
    Route::get('/get-list-warehouse','WarehouseController@getList')->name('warehouse.getList');

    Route::get('/cat/getListCatProductFrontEnd','CatProductController@getListByDepthFrontEnd');

    $prefix         = 'product';
    $controllerName = 'product';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('getListFeaturerFrontEnd', ['uses' => $controller . 'getListFeaturerFrontEnd']);
        Route::get('getListProductByProductID', ['uses' => $controller . 'getListProductByProductID']);
        Route::get('getListProductShowFrontEnd', ['uses' => $controller . 'getListProductShowFrontEnd']);
        Route::get('getListProduct', ['uses' => $controller . 'getListProduct']);
        Route::get('getListProductFeaturer', ['uses' => $controller . 'getListProductFeaturer']);
        Route::get('getListProductInObject', ['uses' => $controller . 'getListProductInObject']);
     });

    $prefix         = 'catProduct';
    $controllerName = 'catProduct';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('getListCatProductLevel1', ['uses' => $controller . 'getListCatProductLevel1']);
        Route::get('getListByParent', ['uses' => $controller . 'getListByParent']);
        Route::get('getListProductByCatId', ['uses' => $controller . 'getListProductByCatId']);
        Route::get('getListCatProductLevel1AndChild', ['uses' => $controller . 'getListCatProductLevel1AndChild']);
        Route::get('getListCatFeature', ['uses' => $controller . 'getListCatFeature']);
    });

    $prefix         = 'affiliate';
    $controllerName = 'affiliate';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('getItem', ['uses' => $controller . 'getItem']);
    });

    $prefix         = 'user';
    $controllerName = 'user';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('getListShop', ['uses' => $controller . 'getListShop']);
        Route::get('getListDrugstore', ['uses' => $controller . 'getListDrugstore']);
        Route::get('detailUser', ['uses' => $controller . 'detailUser']);
        Route::post('sendDeviceToken', ['uses' => $controller . 'sendDeviceToken']);
    });
    $prefix         = 'order';
    $controllerName = 'order';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::post('orderCompleted', ['uses' => $controller . 'orderCompleted']);
        Route::post('getListOrder', ['uses' => $controller . 'getListOrder']);
        Route::get('detailOrder', ['uses' => $controller . 'detailOrder']);
    });
    $prefix         = 'province';
    $controllerName = 'province';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('getList', ['uses' => $controller . 'getList']);
    });
    $prefix         = 'district';
    $controllerName = 'district';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('getList/{parentID}', ['uses' => $controller . 'getList']);
    });
    $prefix         = 'ward';
    $controllerName = 'ward';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('getList/{parentID}', ['uses' => $controller . 'getList']);
    });
    $prefix         = 'message';
    $controllerName = 'message';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::post('sendMessage', ['uses' => $controller . 'sendMessage']);
        Route::get('getListMessage', ['uses' => $controller . 'getListMessage']);
    });
});
