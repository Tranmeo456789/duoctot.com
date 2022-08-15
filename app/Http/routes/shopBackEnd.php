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
Route::group(['prefix' => $prefixShopBackEnd,'namespace' => 'Shop\BackEnd'], function () {
    Route::get('/','DashboardController@index')->name('dashboard');

    Route::get('/thong-tin-nguoi-ban','SellerProfileController@index')->name('seller.info');
    Route::get('/thay-doi-mat-khau','SellerProfileController@change_password')->name('seller.password');
    Route::get('/thiet-lap-cai-dat-khac','SellerProfileController@setting')->name('seller.setting');

    Route::get('/danh-sach-san-pham','ProductController@list_product')->name('product.list');
    Route::get('/them-san-pham','ProductController@add_product')->name('product.add');
    Route::get('/sua-san-pham','ProductController@add_product')->name('product.edit');
    Route::get('/don-vi-tinh','ProductController@unit')->name('product.unit');
    Route::get('/xoa-don-vi-tinh/{id}','ProductController@unit_delete')->name('unit.delete');
    Route::post('/luu-don-vi-tinh','ProductController@unit_store')->name('unit.store');

    Route::get('/danh-sach-nha-san-xuat','ProducerController@list_producer')->name('producer.list');
    Route::get('/them-nha-san-xuat','ProducerController@add_producer')->name('producer.add');
    Route::post('/luu-nha-san-xuat','ProducerController@store_producer')->name('producer.store');
    Route::get('/sua-nha-san-xuat/{id}','ProducerController@edit_producer')->name('producer.edit');
    Route::post('/cap-nhat-nha-san-xuat/{id}','ProducerController@update_producer')->name('producer.update');
    Route::get('/xoa-nha-san-xuat/{id}','ProducerController@delete_producer')->name('producer.delete');
    
    Route::get('/danh-sach-hoa-don','OrderController@list_invoice')->name('invoice.list');
    Route::get('/chi-tiet-hoa-don','OrderController@detail_invoice')->name('invoice.detail');
    Route::get('/chi-tiet-don-hang','OrderController@detail_order')->name('order.detail');
    Route::get('/danh-sach-don-hang','OrderController@list_order')->name('order.list');

    Route::get('/phieu-gui-hang','ConsignmentController@index')->name('consignment.list');
    Route::get('/tao-phieu-gui-hang','ConsignmentController@add')->name('consignment.add');
    Route::get('/chi-tiet-phieu-gui-hang','ConsignmentController@detail')->name('consignment.detail');

    Route::get('/kho-hang','WarehouseController@index')->name('warehouse');

    Route::get('/danh-sach-khach-hang','CustomerController@list_customer')->name('customer.list');
    Route::get('/them-khach-hang','CustomerController@add_customer')->name('customer.add');

});