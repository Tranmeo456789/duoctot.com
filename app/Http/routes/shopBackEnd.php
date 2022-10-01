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

    Route::get('/danh-sach-danh-muc-thuoc', 'CatProductController@index')->name('catProduct');
    Route::get('/them-danh-muc-thuoc', 'CatProductController@form')->name('catProduct.add');
    Route::get('/sua-danh-muc-thuoc/{id}', 'CatProductController@form')->name('catProduct.edit');
    Route::post('/luu-danh-muc-thuoc', 'CatProductController@save')->name('catProduct.save');
    Route::get('/xoa-danh-muc-thuoc/{id}', 'CatProductController@delete')->name('catProduct.delete');
    Route:: get('move-{type}/{id}',   'CatProductController@move')->name('catProduct.move');

    Route::get('/danh-sach-san-pham', 'ProductController@index')->name('product');
    Route::get('/them-san-pham', 'ProductController@form')->name('product.add');
    Route::get('/sua-san-pham/{id}', 'ProductController@form')->name('product.edit');
    Route::post('/luu-san-pham', 'ProductController@save')->name('product.save');
    Route::get('/xoa-san-pham/{id}', 'ProductController@delete')->name('product.delete');

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
    Route::get('/chi-tiet-don-hang/{code}', 'OrderController@detail_order')->name('order.detail');
    Route::get('/danh-sach-don-hang', 'OrderController@list_order')->name('order.list');
    Route::get('/cap-nhat-trang-thai-don-hang', 'OrderController@update_status')->name('order.update_status');

    Route::get('/phieu-gui-hang', 'ConsignmentController@index')->name('consignment.list');
    Route::get('/tao-phieu-gui-hang', 'ConsignmentController@add')->name('consignment.add');
    Route::get('/chi-tiet-phieu-gui-hang', 'ConsignmentController@detail')->name('consignment.detail');

    Route::get('/kho-hang', 'WarehouseController@qlwarehouse')->name('qlwarehouse');
    Route::get('/danh-sach-kho-hang', 'WarehouseController@index')->name('warehouse');
    Route::get('/them-kho-hang', 'WarehouseController@form')->name('warehouse.add');
    Route::get('/sua-kho-hang/{id}', 'WarehouseController@form')->name('warehouse.edit');
    Route::post('/luu-kho-hang', 'WarehouseController@save')->name('warehouse.save');
    Route::get('/xoa-kho-hang/{id}', 'WarehouseController@delete')->name('warehouse.delete');
    Route::post('/them-san-pham-kho-hang', 'WarehouseController@add_product')->name('warehouse.add_product');
    
    Route::get('/danh-sach-khach-hang', 'CustomerController@index')->name('customer');
    Route::get('/them-khach-hang', 'CustomerController@form')->name('customer.add');
    Route::get('/sua-khach-hang/{id}', 'CustomerController@form')->name('customer.edit');
    Route::post('/luu-khach-hang', 'CustomerController@save')->name('customer.save');
    Route::get('/xoa-khach-hang/{id}', 'CustomerController@delete')->name('customer.delete');
    Route::post('/dia-chi-khach-hang', 'CustomerController@locationAjax')->name('locationAjax');

    Route::post('dropzone/upload', 'DropzoneController@upload')->name('dropzone.upload');
    Route::get('dropzone/fetch', 'DropzoneController@fetch')->name('dropzone.fetch');
    Route::post('dropzone/fupload', 'DropzoneController@fupload')->name('dropzone.fupload');
    Route::get('anh-san-pham/{id}', 'DropzoneController@list_img')->name('dropzone.list_img');
    Route::post('/them-anh-san-pham/{id}', 'ProductController@addimg_product')->name('product.img.add');
    Route::get('/xoa-anh-san-pham/{id}/{id_product}', 'DropzoneController@deleteimg_product')->name('dropzone.img.delete');

    Route::get('district/get-list', 'DistrictController@getListByParentID')->name('district.getListByParentID');
    Route::get('ward/get-list', 'WardController@getListByParentID')->name('ward.getListByParentID');
});
