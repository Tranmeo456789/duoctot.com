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

    Route::get('/danh-sach-danh-muc-san-pham', 'Cat_productController@index')->name('cat_product.list');
    Route::post('/luu-danh-muc-san-pham', 'Cat_productController@add')->name('cat_product.add');
    Route::get('/sua-danh-muc-san-pham/{slug}', 'Cat_productController@edit')->name('cat_product.edit');
    Route::post('/luu-danh-muc-san-pham/{slug}', 'Cat_productController@edit')->name('cat_product.update');
    Route::get('/xoa-danh-muc-san-pham/{id}', 'Cat_productController@delete')->name('cat_product.delete');


    Route::get('/danh-sach-san-pham', 'ProductController@list_product')->name('product.list');
    Route::get('/them-san-pham', 'ProductController@add_product')->name('product.add');
    Route::post('/luu-san-pham', 'ProductController@add_product')->name('product.store');
    Route::get('/sua-san-pham/{id}', 'ProductController@edit_product')->name('product.edit');
    Route::post('/cap-nhat-san-pham/{id}', 'ProductController@edit_product')->name('product.update');
    Route::get('/xoa-san-pham/{id}', 'ProductController@delete_product')->name('product.delete');

    Route::get('/anh-san-pham/{id}', 'ProductController@img_product')->name('product.img');
    Route::post('/them-anh-san-pham/{id}', 'ProductController@addimg_product')->name('product.img.add');
    Route::get('/xoa-anh-san-pham/{id}/{id_product}', 'ProductController@deleteimg_product')->name('product.img.delete');

    Route::get('/don-vi-tinh', 'ProductController@unit')->name('product.unit');
    Route::get('/xoa-don-vi-tinh/{id}', 'ProductController@unit_delete')->name('unit.delete');
    Route::post('/luu-don-vi-tinh', 'ProductController@unit_store')->name('unit.store');

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

    Route::get('/kho-hang', 'WarehouseController@index')->name('warehouse');
    Route::get('/them-kho-hang', 'WarehouseController@add')->name('warehouse.add');
    Route::post('/luu-kho-hang', 'WarehouseController@add')->name('warehouse.store');
    Route::get('/danh-sach-kho-hang', 'WarehouseController@list')->name('warehouse.list');
    Route::get('/xoa-kho-hang/{id}', 'WarehouseController@delete')->name('warehouse.delete');
    Route::get('/sua-kho-hang/{id}', 'WarehouseController@edit')->name('warehouse.edit');
    Route::post('/cap-nhat-kho-hang/{id}', 'WarehouseController@edit')->name('warehouse.update');

    Route::get('/danh-sach-khach-hang', 'CustomerController@list_customer')->name('customer.list');
    Route::get('/them-khach-hang', 'CustomerController@add_customer')->name('customer.add');

    Route::post('dropzone/upload', 'DropzoneController@upload')->name('dropzone.upload');
    Route::get('dropzone/fetch', 'DropzoneController@fetch')->name('dropzone.fetch');
    Route::post('dropzone/fupload', 'DropzoneController@fupload')->name('dropzone.fupload');
});
