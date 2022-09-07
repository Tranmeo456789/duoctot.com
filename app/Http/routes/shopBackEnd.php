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
Route::group(['prefix' => $prefixShopBackEnd, 'namespace' => 'Shop\BackEnd'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('/thong-tin-nguoi-ban', 'SellerProfileController@index')->name('seller.info');
    Route::get('/thay-doi-mat-khau', 'SellerProfileController@change_password')->name('seller.password');
    Route::get('/thiet-lap-cai-dat-khac', 'SellerProfileController@setting')->name('seller.setting');

    Route::get('/danh-sach-danh-muc', 'Cat_productController@index')->name('cat_product');
    Route::get('/them-danh-muc', 'Cat_productController@form')->name('cat_product.add');
    Route::get('/sua-danh-muc/{id}', 'Cat_productController@form')->name('cat_product.edit');
    Route::post('/luu-danh-muc', 'Cat_productController@save')->name('cat_product.save');
    Route::get('/xoa-danh-muc/{id}', 'Cat_productController@delete')->name('cat_product.delete');

    Route::get('/danh-sach-san-pham', 'ProductController@index')->name('product');
    Route::get('/them-san-pham', 'ProductController@form')->name('product.add');
    Route::get('/sua-san-pham/{id}', 'ProductController@form')->name('product.edit');
    Route::post('/luu-san-pham', 'ProductController@save')->name('product.save');
    Route::get('/xoa-san-pham/{id}', 'ProductController@delete')->name('product.delete');

    Route::get('/anh-san-pham/{id}', 'ProductController@img_product')->name('product.img');
    Route::post('/them-anh-san-pham/{id}', 'ProductController@addimg_product')->name('product.img.add');
    Route::get('/xoa-anh-san-pham/{id}/{id_product}', 'ProductController@deleteimg_product')->name('product.img.delete');

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

    Route::get('/danh-sach-hoa-don', 'OrderController@list_invoice')->name('invoice.list');
    Route::get('/chi-tiet-hoa-don', 'OrderController@detail_invoice')->name('invoice.detail');
    Route::get('/chi-tiet-don-hang', 'OrderController@detail_order')->name('order.detail');
    Route::get('/danh-sach-don-hang', 'OrderController@list_order')->name('order.list');

    Route::get('/phieu-gui-hang', 'ConsignmentController@index')->name('consignment.list');
    Route::get('/tao-phieu-gui-hang', 'ConsignmentController@add')->name('consignment.add');
    Route::get('/chi-tiet-phieu-gui-hang', 'ConsignmentController@detail')->name('consignment.detail');

    Route::get('/kho-hang', 'WarehouseController@qlwarehouse')->name('qlwarehouse');
    Route::get('/danh-sach-kho-hang', 'WarehouseController@index')->name('warehouse');
    Route::get('/them-kho-hang', 'WarehouseController@form')->name('warehouse.add');
    Route::get('/sua-kho-hang/{id}', 'WarehouseController@form')->name('warehouse.edit');
    Route::post('/luu-kho-hang', 'WarehouseController@save')->name('warehouse.save');
    Route::get('/xoa-kho-hang/{id}', 'WarehouseController@delete')->name('warehouse.delete');

    Route::get('/danh-sach-khach-hang', 'CustomerController@list_customer')->name('customer.list');
    Route::get('/them-khach-hang', 'CustomerController@add_customer')->name('customer.add');

    Route::post('dropzone/upload', 'DropzoneController@upload')->name('dropzone.upload');
    Route::get('dropzone/fetch', 'DropzoneController@fetch')->name('dropzone.fetch');
    Route::post('dropzone/fupload', 'DropzoneController@fupload')->name('dropzone.fupload');
});
