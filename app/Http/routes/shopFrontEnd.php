<?php


$prefixShopFrontend = '';
Route::group(['prefix' => $prefixShopFrontend,'namespace' => 'Shop\FrontEnd'], function () {
    Route::get('/','HomeController@index')->name('home');
    Route::get('/ajaxHoverCatLevel2','HomeController@ajaxHoverCatLevel2')->name('ajaxHoverCatLevel2');
    Route::get('/ajaxHoverCatLevel1','HomeController@ajaxHoverCatLevel1')->name('ajaxHoverCatLevel1');
    Route::get('/ajaxlocal-store','HomeController@ajaxlocal')->name('fe.ajaxlocal');
    Route::get('tai-lieu/dao-tao-viet-content-voi-ai.html','HomeController@writeContentAi')->name('fe.home.writeContentAi');
    Route::get('chinh-sach-doi-tra.html','HomeController@pageChinhSachDoiTra')->name('fe.home.pageChinhSachDoiTra');
    Route::get('ve-chung-toi.html','HomeController@pageAboutUs')->name('fe.home.pageAboutUs');
    Route::get('lien-he.html','HomeController@pageContact')->name('fe.home.pageContact');
    Route::get('quy-trinh-tranh-chap-giai-quyet.html','HomeController@pageQuytrinhGiaiquyetTranhchap')->name('fe.home.pageQuytrinhGiaiquyetTranhchap');
    Route::get('chinh-sach-bao-mat-thong-tin.html','HomeController@pageChinhsachBaomatThongtin')->name('fe.home.pageChinhsachBaomatThongtin');

    Route::get('/chi-tiet-san-pham/{slug}.html','ProductController@detail')->name('fe.product.detail');
    Route::get('/tim-kiem-san-pham-theo-ten','ProductController@searchProductAjax')->name('fe.product.searchProductAjax');
    Route::get('/tim-kiem-san-pham-danh-sach-ngan','ProductController@searchListProductShort')->name('fe.product.searchListProductShort');
    Route::get('/load-more-products','ProductController@loadMoreProducts')->name('fe.product.loadMoreProducts');
    Route::get('/them-comment-product','ProductController@addCommentProduct')->name('fe.product.addCommentProduct');
   // Route::post('/loc-drugstore-trong-danh-sach','ProductController@filterDrugstore')->name('fe.product.filterDrugstore');
    
    Route::get('/ajax-filter-product-object','HomeController@ajax_filter')->name('fe.home.ajaxfilter');
    
    Route::get('/tin-tuc','PostController@index')->name('fe.post');
    Route::get('/danh-muc-tin-tuc/{slug}','PostController@listPostOfCat')->name('fe.post.listPostOfCat');
    Route::get('/tin-tuc/{slug}.html','PostController@detail')->name('fe.post.detail');

    Route::post('/hoan-tat-dat-hang','OrderController@completed')->name('fe.order.completed');
    Route::get('/dat-hang/thanh-cong/{code}','OrderController@success')->name('fe.order.success');
    Route::get('/don-hang-cua-toi','OrderController@list')->name('fe.order.list');
    Route::get('/chi-tiet-don-hang-cua-toi','OrderController@detail')->name('fe.order.detail');
    Route::get('/loc-don-hang-cua-toi','OrderController@ajaxFliter')->name('fe.order.ajaxFliter');
    Route::get('/tra-cuu-don-hang','OrderController@formSearch')->name('fe.order.formSearch');
    Route::post('/tra-cuu-don-hang-theo-so-dien-thoai','OrderController@searchInPhone')->name('fe.order.searchInPhone');

    Route::get('/don-thuoc','PrescripController@index')->name('fe.prescrip.index');
    Route::post('/luu-don-thuoc-khach-hang','PrescripController@save')->name('fe.prescrip.save');
    Route::get('/don-thuoc-khach-hang/{id}','PrescripController@prescripCustomer')->name('fe.prescrip.prescripCustomer');

    Route::group(['middleware' => ['check.login']], function () {
        Route::get('/gio-hang/{user_sell}','CartController@view')->name('fe.product.viewcart');
        Route::get('/gio-hang-full','CartController@cartFull')->name('fe.product.cartFull');
        Route::post('/them-san-pham-gio-hang','CartController@addproduct')->name('fe.cart.addproduct');
        Route::post('/thay-doi-so-luong-san-pham/{user_sell}-{id}-{quantity}','CartController@changeQuatity')->name('fe.cart.change_quatity');
    });

    Route::get('/danh-sach-kho-hang','WarehouseController@getList')->name('fe.warehouse.getList');

    Route::post('/luu-noi-dung-tim-kiem-trang-chu','SearchController@saveHome')->name('fe.search.saveHome');
    Route::get('/tim-kiem/{keyword}','SearchController@viewHome')->name('fe.search.viewHome');
    Route::get('/xoa-lich-su-tim-kiem-tu-khoa','SearchController@deleteHistory')->name('fe.deleteHistory');
    Route::get('/update-keyword-search-product','SearchController@updateFieldSearchKeyword');

    Route::get('/xoa-san-pham-gio-hang/{user_sell}-{id}','CartController@delete')->name('fe.cart.delete');

    Route::get('lang/{locale}',function($locale){
        if(! in_array($locale,['en','vi','zh','ko'])){
            abort(404);
        }
        session()->put('locale',$locale);
        return redirect()->back();
    });

    Route::get('booking-online', 'BookingController@index')->name('fe.booking_online');

    Route::get('danh-muc-thuoc/{slug}','CatController@catLevel1')->name('fe.cat');
    Route::get('danh-muc-thuoc/{slug1}/{slug2}','CatController@catLevel2')->name('fe.cat2');
    Route::get('danh-muc-thuoc/{slug1}/{slug2}/{slug3}','CatController@catLevel3')->name('fe.cat3');
    Route::get('loc-san-pham-trong-danh-muc','CatController@filterProduct')->name('fe.cat.filterProduct');
    
    Route::get('/sitemap.xml', 'SiteMapController@sitemapPage');
    Route::get('danh-sach-shop','ProductController@listShop')->name('fe.product.listShop');
    Route::get('danh-sach-nha-thuoc','ProductController@listDrugstore')->name('fe.product.listDrugstore');
    Route::get('{slug}.html','ProductController@drugstore')->name('fe.product.drugstore');

});