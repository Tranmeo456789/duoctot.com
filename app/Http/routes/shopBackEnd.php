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
Route::group(['prefix' => $prefixShopBackEnd, 'namespace' => 'Shop\BackEnd', 'middleware' => ['check.login']], function () { 
    Route::get('/thong-tin-nguoi-dung', 'ProfileController@info')->name('profile.info');
    Route::post('/luu-thong-tin-nguoi-dung', 'ProfileController@save')->name('profile.save');
    Route::get('/thay-doi-mat-khau', 'ProfileController@change_password')->name('profile.password');
    Route::post('/luu-thay-doi-mat-khau', 'ProfileController@saveChangePassword')->name('profile.saveChangePassword');
    Route::get('/thiet-lap-cai-dat-khac', 'ProfileController@setting')->name('profile.setting');
    Route::group(['middleware' => ['permission.shop']], function () {

        Route::get('/danh-sach-san-pham', 'ProductController@index')->name('product');
        Route::get('/them-san-pham', 'ProductController@form')->name('product.add');
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

        Route::get('/don-thuoc-theo-toa', 'PrescripController@index')->name('prescrip');
        Route::get('/chi-tiet-don-thuoc-theo-toa/{id}', 'PrescripController@detail')->name('prescrip.detail');
    });

    Route::group(['middleware' => ['permission.dashboard']], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
    });
    Route::group(['middleware' => ['permission.affiliate']], function () {
        Route::get('/thong-ke-hoa-hong-theo-san-pham-dai-ly', 'AffiliateController@refAffiliate')->name('affiliate.refAffiliate');
        Route::get('/trang-tong-quan-tai-khoan-affiliate', 'AffiliateController@dashboardRef')->name('affiliate.dashboardRef');
        Route::get('/thong-tin-tai-khoan-ngan-hang-affiliate', 'AffiliateController@infoBank')->name('affiliate.infoBank');
        Route::post('/luu-thong-tin-tai-khoan-ngan-hang-affiliate', 'AffiliateController@saveInfoBank')->name('affiliate.saveInfoBank');
    });
    Route::group(['middleware' => ['permission.editProduct']], function () {
        Route::get('/sua-san-pham/{id}', 'ProductController@form')->name('product.edit');
        Route::post('/luu-san-pham', 'ProductController@save')->name('product.save');

        Route::get('/danh-sach-don-hang', 'OrderController@index')->name('order');
        Route::get('/chi-tiet-don-hang/{id}', 'OrderController@detail')->name('order.detail');
        Route::get('/cap-nhat-trang-thai-don-hang-{value}/{id}', 'OrderController@changeStatusOrder')->name('order.changeStatusOrder');
        Route::post('/luu-don-hang', 'OrderController@save')->name('order.save');
    });

    Route::group(['middleware' => ['permission.editorOrAdmin']], function () {
        Route::get('/danh-sach-danh-muc-thuoc', 'CatProductController@index')->name('catProduct');
        Route::get('/them-danh-muc-thuoc', 'CatProductController@form')->name('catProduct.add');
        Route::get('/sua-danh-muc-thuoc/{id}', 'CatProductController@form')->name('catProduct.edit');
        Route::post('/luu-danh-muc-thuoc', 'CatProductController@save')->name('catProduct.save');
        Route::get('/xoa-danh-muc-thuoc/{id}', 'CatProductController@delete')->name('catProduct.delete');
        Route::get('move-{type}/{id}',   'CatProductController@move')->name('catProduct.move');

        Route::get('/danh-sach-tin-tuc', 'PostController@index')->name('post');
        Route::get('/them-tin-tuc', 'PostController@form')->name('post.add');
        Route::get('/sua-tin-tuc/{id}', 'PostController@form')->name('post.edit');
        Route::post('/luu-tin-tuc', 'PostController@save')->name('post.save');
        Route::get('/xoa-tin-tuc/{id}', 'PostController@delete')->name('post.delete');

        Route::get('/danh-sach-danh-muc-tin-tuc', 'CatalogController@index')->name('catalog');
        Route::get('/them-danh-muc-tin-tuc', 'CatalogController@form')->name('catalog.add');
        Route::get('/sua-danh-muc-tin-tuc/{id}', 'CatalogController@form')->name('catalog.edit');
        Route::post('/luu-danh-muc-tin-tuc', 'CatalogController@save')->name('catalog.save');
        Route::get('/xoa-danh-muc-tin-tuc/{id}', 'CatalogController@delete')->name('catalog.delete');

        Route::get('/danh-sach-thuoc-admin', 'ProductController@listProductAdmin')->name('admin.product.list');
        Route::get('/thay-doi-trang-thai-thuoc-admin/{id}/{status}', 'ProductController@changeProductInAdmin')->name('admin.product.change.status');
        Route::post('/upload-image', 'PostController@upload');
    });
    Route::group(['middleware' => ['permission.admin']], function () {
        Route::get('/danh-sach-nguoi-dung', 'UserController@index')->name('user');
        Route::get('/sua-nguoi-dung/{id}', 'UserController@form')->name('user.edit');
        Route::post('/luu-nguoi-dung', 'UserController@save')->name('user.save');
        
        Route::get('/quan-ly-editor', 'EditorController@index')->name('editor');
        Route::get('/them-editor', 'EditorController@form')->name('editor.add');
        Route::get('/sua-editor/{id}', 'EditorController@form')->name('editor.edit');
        Route::post('/luu-editor', 'EditorController@save')->name('editor.save');
        Route::get('/xoa-editor/{id}', 'EditorController@delete')->name('editor.delete');

        Route::get('/quan-ly-thuoc-admin', 'ProductController@index_admin')->name('admin.product');
        
        Route::get('/quan-ly-don-hang-admin', 'OrderController@index_admin')->name('admin.order');
        Route::get('/danh-sach-don-hang-admin', 'OrderController@listOrderAdmin')->name('admin.order.list');

        Route::get('/quan-ly-kho-hang-admin', 'WarehouseController@index_admin')->name('admin.warehouse');
        Route::get('/quan-ly-khách-hàng-admin', 'CustomerController@index_admin')->name('admin.customer');
        Route::get('/quan-ly-doanh-thu-admin', 'RevenueController@index_admin')->name('admin.revenue');
        Route::get('/loc-user-theo-thoi-gian', 'UserController@filterInDay')->name('user.filterInDay');

        Route::get('/danh-sach-affiliate', 'AffiliateController@index')->name('affiliate');
        Route::get('/them-affiliate', 'AffiliateController@form')->name('affiliate.add');
        Route::get('/sua-affiliate/{id}', 'AffiliateController@form')->name('affiliate.edit');
        Route::get('/chi-tiet-affiliate/{id}', 'AffiliateController@detail')->name('affiliate.detail');
        Route::post('/luu-affiliate', 'AffiliateController@save')->name('affiliate.save');
        Route::get('/xoa-affiliate/{id}', 'AffiliateController@delete')->name('affiliate.delete');

        Route::get('/danh-sach-phieu-thanh-toan', 'CouponPaymentController@index')->name('couponPayment');
        Route::get('/them-phieu-thanh-toan', 'CouponPaymentController@form')->name('couponPayment.add');
        Route::get('/sua-phieu-thanh-toan/{id}', 'CouponPaymentController@form')->name('couponPayment.edit');
        Route::get('/chi-tiet-phieu-thanh-toan/{id}', 'CouponPaymentController@detail')->name('couponPayment.detail');
        Route::post('/luu-phieu-thanh-toan', 'CouponPaymentController@save')->name('couponPayment.save');
        Route::get('/xoa-phieu-thanh-toan/{id}', 'CouponPaymentController@delete')->name('couponPayment.delete');

        // Route::get('/them-nguoi-dung', 'UserController@form')->name('user.add');
        // Route::get('/sua-nguoi-dung/{id}', 'UserController@form')->name('user.edit');
        // Route::post('/luu-nguoi-dung', 'UserController@save')->name('user.save');
        // Route::get('/xoa-nguoi-dung/{id}', 'UserController@delete')->name('user.delete');
        // Route::get('/chi-tiet-nguoi-dung/{id}', 'UserController@getItem')->name('user.getItem');
    });
    Route::get('/loc-doanh-thu-theo-thoi-gian', 'DashboardController@filterInDay')->name('dashboard.filterInDay');
});
