<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//shop tdoctor
$prefixShopBackEnd = '/backend';
Route::group(['prefix' => $prefixShopBackEnd, 'namespace' => 'Shop\BackEnd','middleware' => ['check.login']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/thong-tin-nguoi-dung', 'ProfileController@info')->name('profile.info');
    Route::post('/luu-thong-tin-nguoi-dung', 'ProfileController@save')->name('profile.save');
    Route::get('/thay-doi-mat-khau', 'ProfileController@change_password')->name('profile.password');
    Route::post('/thay-doi-mat-khau', 'ProfileController@change_password')->name('profile.password');
    Route::get('/thiet-lap-cai-dat-khac', 'ProfileController@setting')->name('profile.setting');
    Route::group(['middleware' => ['permission.shop']], function () {
        Route::get('/danh-sach-danh-muc-thuoc', 'CatProductController@index')->name('catProduct');
        Route::get('/them-danh-muc-thuoc', 'CatProductController@form')->name('catProduct.add');
        Route::get('/sua-danh-muc-thuoc/{id}', 'CatProductController@form')->name('catProduct.edit');
        Route::post('/luu-danh-muc-thuoc', 'CatProductController@save')->name('catProduct.save');
        Route::get('/xoa-danh-muc-thuoc/{id}', 'CatProductController@delete')->name('catProduct.delete');
        Route::get('move-{type}/{id}',   'CatProductController@move')->name('catProduct.move');

        Route::get('/danh-sach-san-pham', 'ProductController@index')->name('product');
        Route::get('/them-san-pham', 'ProductController@form')->name('product.add');
        Route::get('/sua-san-pham/{id}', 'ProductController@form')->name('product.edit');
        Route::post('/luu-san-pham', 'ProductController@save')->name('product.save');
        Route::get('/xoa-san-pham/{id}', 'ProductController@delete')->name('product.delete');
        Route::get('/chi-tiet-san-pham/{id}', 'ProductController@getItem')->name('product.getItem');

        Route::get('/danh-sach-don-vi-tinh', 'UnitController@index')->name('unit');
        Route::get('/them-don-vi-tinh', 'UnitController@form')->name('unit.add');
        Route::get('/sua-don-vi-tinh/{id}', 'UnitController@form')->name('unit.edit');
        Route::post('/luu-don-vi-tinh', 'UnitController@save')->name('unit.save');
        Route::get('/xoa-don-vi-tinh/{id}', 'UnitController@delete')->name('unit.delete');

        Route::get('/danh-sach-nha-san-xuat', 'ProducerController@index')->name('producer');
        Route::get('/them-nha-san-xuat', 'ProducerController@form')->name('producer.add');
        Route::get('/sua-nha-san-xuat/{id}', 'ProducerController@form')->name('producer.edit');
        Route::post('/luu-nha-san-xuat', 'ProducerController@save')->name('producer.save');
        Route::get('/xoa-nha-san-xuat/{id}', 'ProducerController@delete')->name('producer.delete');

        Route::get('/danh-sach-thuong-hieu', 'TrademarkController@index')->name('trademark');
        Route::get('/them-thuong-hieu', 'TrademarkController@form')->name('trademark.add');
        Route::get('/sua-thuong-hieu/{id}', 'TrademarkController@form')->name('trademark.edit');
        Route::post('/luu-thuong-hieu', 'TrademarkController@save')->name('trademark.save');
        Route::get('/xoa-thuong-hieu/{id}', 'TrademarkController@delete')->name('trademark.delete');

        Route::get('/danh-sach-hoa-don', 'OrderController@list_invoice')->name('invoice.list');
        Route::get('/chi-tiet-hoa-don', 'OrderController@detail_invoice')->name('invoice.detail');

        Route::get('/danh-sach-don-hang', 'OrderController@index')->name('order');
        Route::get('/chi-tiet-don-hang/{id}', 'OrderController@detail')->name('order.detail');
        Route::get('/cap-nhat-trang-thai-don-hang-{value}/{id}', 'OrderController@changeStatusOrder')->name('order.changeStatusOrder'); Route::get('/cap-nhat-trang-thai-don-hang-{value}/{id}', 'OrderController@changeStatusOrder')->name('order.changeStatusOrder');
        Route::post('/luu-don-hang', 'OrderController@save')->name('order.save');


        Route::get('/phieu-gui-hang', 'ConsignmentController@index')->name('consignment.list');
        Route::get('/tao-phieu-gui-hang', 'ConsignmentController@add')->name('consignment.add');
        Route::get('/chi-tiet-phieu-gui-hang', 'ConsignmentController@detail')->name('consignment.detail');

        Route::get('/danh-sach-kho-hang', 'WarehouseController@index')->name('warehouse');
        Route::get('/them-kho-hang', 'WarehouseController@form')->name('warehouse.add');
        Route::get('/sua-kho-hang/{id}', 'WarehouseController@form')->name('warehouse.edit');
        Route::post('/luu-kho-hang', 'WarehouseController@save')->name('warehouse.save');
        Route::get('/xoa-kho-hang/{id}', 'WarehouseController@delete')->name('warehouse.delete');
        Route::get('/thong-tin-kho-hang', 'WarehouseController@info')->name('warehouse.info');

        Route::get('/danh-sach-phieu-nhap-hang', 'ImportCouponController@index')->name('importCoupon');
        Route::get('/them-phieu-nhap-hang', 'ImportCouponController@form')->name('importCoupon.add');
        Route::get('/sua-phieu-nhap-hang/{id}', 'ImportCouponController@form')->name('importCoupon.edit');
        Route::post('/luu-phieu-nhap-hang', 'ImportCouponController@save')->name('importCoupon.save');
        Route::get('/xoa-phieu-nhap-hang/{id}', 'ImportCouponController@delete')->name('importCoupon.delete');

        Route::get('/danh-sach-khach-hang', 'CustomerController@index')->name('customer');
        Route::get('/them-khach-hang', 'CustomerController@form')->name('customer.add');
        Route::get('/sua-khach-hang/{id}', 'CustomerController@form')->name('customer.edit');
        Route::post('/luu-khach-hang', 'CustomerController@save')->name('customer.save');
        Route::get('/xoa-khach-hang/{id}', 'CustomerController@delete')->name('customer.delete');
        Route::post('/dia-chi-khach-hang', 'CustomerController@locationAjax')->name('locationAjax');
    });
   

    Route::group(['middleware' => ['permission.admin']], function () {
        Route::get('/danh-sach-nguoi-dung', 'UserController@index')->name('user');
        Route::get('/quan-ly-thuoc-admin', 'ProductController@index_admin')->name('admin.product');
        Route::get('/quan-ly-don-hang-admin', 'OrderController@index_admin')->name('admin.order');
        Route::get('/loc-user-theo-thoi-gian', 'UserController@filterInDay')->name('user.filterInDay');
        
        // Route::get('/them-nguoi-dung', 'UserController@form')->name('user.add');
        // Route::get('/sua-nguoi-dung/{id}', 'UserController@form')->name('user.edit');
        // Route::post('/luu-nguoi-dung', 'UserController@save')->name('user.save');
        // Route::get('/xoa-nguoi-dung/{id}', 'UserController@delete')->name('user.delete');
        // Route::get('/chi-tiet-nguoi-dung/{id}', 'UserController@getItem')->name('user.getItem');
    });
    Route::get('/loc-doanh-thu-theo-thoi-gian', 'DashboardController@filterInDay')->name('dashboard.filterInDay');
});
