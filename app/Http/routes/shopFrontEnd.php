<?php


$prefixShopFrontend = '';
Route::group(['prefix' => $prefixShopFrontend,'namespace' => 'Shop\FrontEnd'], function () {
    Route::get('/','HomeController@index')->name('home');
    Route::get('/ajaxHoverCatLevel2','HomeController@ajaxHoverCatLevel2')->name('ajaxHoverCatLevel2');
    Route::get('/ajaxHoverCatLevel1','HomeController@ajaxHoverCatLevel1')->name('ajaxHoverCatLevel1');
    Route::get('/ajaxlocal-store','HomeController@ajaxlocal')->name('fe.ajaxlocal');
    Route::get('tai-lieu/dao-tao-viet-content-voi-ai.html','HomeController@writeContentAi')->name('fe.home.writeContentAi');
    Route::get('chinh-sach-kiem-hang-doi-tra.html','HomeController@pageChinhSachDoiTra')->name('fe.home.pageChinhSachDoiTra');
    Route::get('ve-chung-toi.html','HomeController@pageAboutUs')->name('fe.home.pageAboutUs');
    Route::get('ve-chung-toi-web-view.html','HomeController@pageAboutUsWebView')->name('fe.home.pageAboutUsWebView');
    Route::get('lien-he.html','HomeController@pageContactWebView')->name('fe.home.pageContactWebView');
    Route::get('lien-he-chung-toi.html','HomeController@pageContact')->name('fe.home.pageContact');
    Route::get('quy-trinh-tranh-chap-giai-quyet.html','HomeController@pageQuytrinhGiaiquyetTranhchap')->name('fe.home.pageQuytrinhGiaiquyetTranhchap');
    Route::get('chinh-sach-bao-mat.html','HomeController@pageChinhsachBaomatThongtin')->name('fe.home.pageChinhsachBaomatThongtin');
    Route::get('chinh-sach-giao-nhan.html','HomeController@pageChinhsachGiaoNhan')->name('fe.home.pageChinhsachGiaoNhan');
    Route::get('chinh-sach-thanh-toan.html','HomeController@pageChinhsachThanhToan')->name('fe.home.pageChinhsachThanhToan');
    Route::get('dieu-khoan-su-dung.html','HomeController@pageDieukhoanSudung')->name('fe.home.pageDieukhoanSudung');
    Route::get('web-view','HomeController@pageHomeWebView')->name('fe.home.pageHomeWebView');
    Route::get('download-app-tdoctor','HomeController@downloadAppTdoctor')->name('fe.home.downloadAppTdoctor');
    Route::get('khuyen-mai.html','HomeController@pageKhuyenMai')->name('fe.home.pageKhuyenMai');
    Route::get('diem-tich-luy.html','HomeController@pageDiemTichLuy')->name('fe.home.pageDiemTichLuy');
    Route::get('rieng-cho-ban.html','HomeController@pageRiengChoBan')->name('fe.home.pageRiengChoBan');
    Route::get('danh-sach-don-mua.html','HomeController@pageDanhSachDonMua')->name('fe.home.pageDanhSachDonMua');

    Route::get('/chi-tiet-san-pham/{slug}.html','ProductController@detail')->name('fe.product.detail');
    Route::get('/tim-kiem-san-pham-theo-ten','ProductController@searchProductAjax')->name('fe.product.searchProductAjax');
    Route::get('/tim-kiem-san-pham-danh-sach-ngan','ProductController@searchListProductShort')->name('fe.product.searchListProductShort');
    Route::get('/load-more-products','ProductController@loadMoreProducts')->name('fe.product.loadMoreProducts');
    Route::post('/them-comment-product','ProductController@addCommentProduct')->name('fe.product.addCommentProduct');
   // Route::post('/loc-drugstore-trong-danh-sach','ProductController@filterDrugstore')->name('fe.product.filterDrugstore');
    
    Route::get('/ajax-filter-product-object','HomeController@ajax_filter')->name('fe.home.ajaxfilter');
    Route::get('/ajax-show-product-ncc-in-khuyen-mai','HomeController@ajaxShowProductNccInKhuyenmai')->name('fe.home.ajaxShowProductNccInKhuyenmai');
    
    Route::get('/tin-tuc','PostController@index')->name('fe.post');
    Route::get('/cat-lieu-thuoc-tay','PostController@lieuThuocTay')->name('fe.lieuThuocTay');
    Route::get('/phan-hoi-tu-benh-nhan-duoc-sy-bac-sy','PostController@feedBackCustomer')->name('fe.feedBackCustomer');
    Route::get('/tin-tuc-web-view','PostController@indexWebView')->name('fe.post.indexWebView');
    Route::get('/danh-muc-tin-tuc/{slug}','PostController@listPostOfCat')->name('fe.post.listPostOfCat');
    Route::get('/tin-tuc/{slug}.html','PostController@detail')->name('fe.post.detail');
    Route::get('/tin-tuc/webview/{slug}.html','PostController@detail_webview')->name('fe.post.detail.webview');

    Route::post('/hoan-tat-dat-hang','OrderController@completed')->name('fe.order.completed');
    Route::get('/dat-hang/thanh-cong/{code}','OrderController@success')->name('fe.order.success');
    Route::get('/don-hang-cua-toi','OrderController@list')->name('fe.order.list');
    Route::get('/chi-tiet-don-hang-cua-toi','OrderController@detail')->name('fe.order.detail');
    Route::get('/trang-chi-tiet-don-hang-cua-toi/{code}','OrderController@detailPage')->name('fe.order.detailPage');
    Route::get('/loc-don-hang-cua-toi','OrderController@ajaxFliter')->name('fe.order.ajaxFliter');
    Route::get('/tra-cuu-don-hang','OrderController@formSearch')->name('fe.order.formSearch');
    Route::post('/tra-cuu-don-hang-theo-so-dien-thoai','OrderController@searchInPhone')->name('fe.order.searchInPhone');

    Route::get('/don-thuoc','PrescripController@index')->name('fe.prescrip.index');
    Route::post('/luu-don-thuoc-khach-hang','PrescripController@save')->name('fe.prescrip.save');
    Route::get('/don-thuoc-khach-hang/{id}','PrescripController@prescripCustomer')->name('fe.prescrip.prescripCustomer');
    Route::get('/gio-hang/{user_sell}','CartController@view')->name('fe.product.viewcart');
    Route::get('/gio-hang-full','CartController@cartFull')->name('fe.product.cartFull');
    Route::post('/them-san-pham-gio-hang','CartController@addproduct')->name('fe.cart.addproduct');
    Route::post('/thay-doi-so-luong-san-pham/{user_sell}-{id}-{quantity}','CartController@changeQuatity')->name('fe.cart.change_quatity');
    
    Route::get('/referral/{codeRef}','UserController@invitationFromUser')->name('fe.user.invitationFromUser');
    Route::get('/consultant/{codeRef}','UserController@infoUserRef')->name('fe.user.infoUserRef');
    
    Route::group(['middleware' => ['check.login']], function () {
        
    });

    Route::get('/danh-sach-kho-hang','WarehouseController@getList')->name('fe.warehouse.getList');

    Route::get('/tim-kiem','SearchController@search')->name('fe.search.saveHome');
    Route::get('/tim-kiem-san-pham/{keyword}','SearchController@viewHome')->name('fe.search.viewHome');
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

    Route::get('danh-muc/{slug}','CatController@catLevel1')->name('fe.cat');
    Route::get('danh-muc/{slug1}/{slug2}','CatController@catLevel2')->name('fe.cat2');
    Route::get('danh-muc/{slug1}/{slug2}/{slug3}','CatController@catLevel3')->name('fe.cat3');
    Route::get('loc-san-pham-trong-danh-muc','CatController@filterProduct')->name('fe.cat.filterProduct');
    
    Route::get('danh-sach-shop','ProductController@listShop')->name('fe.product.listShop');
    Route::get('danh-sach-shop-me-va-be','ProductController@listShopMomBaby')->name('fe.product.listShopMomBaby');
    Route::get('danh-sach-shop-trinh-duoc-vien','ProductController@listTrinhDuocVien')->name('fe.product.listTrinhDuocVien');
    Route::get('danh-sach-nha-thuoc','ProductController@listDrugstore')->name('fe.product.listDrugstore');
    Route::get('danh-sach-nha-cung-cap','ProductController@listNhaCungCap')->name('fe.product.listNhaCungCap');
    Route::get('danh-sach-phong-kham','ProductController@listPhongKham')->name('fe.product.listPhongKham');
    Route::get('danh-sach-benh-vien','ProductController@listBenhVien')->name('fe.product.listBenhVien');
    Route::get('danh-sach-tham-my-vien','ProductController@listThamMyVien')->name('fe.product.listThamMyVien');
    Route::get('danh-sach-bac-si','ProductController@listBacSi')->name('fe.product.listBacSi');
    Route::get('danh-sach-duoc-si','ProductController@listDuocSi')->name('fe.product.listDuocSi');
    Route::get('nhathuoconline.html','ProductController@contentIntroduce')->name('fe.product.contentIntroduce');

    Route::get('chat-test','MessagesController@chatTest')->name('fe.messages.chatTest');
    Route::post('send-messages','MessagesController@sendMessages')->name('fe.messages.sendMessages');
    Route::get('notice-device-token','MessagesController@noticeDeviceToken')->name('fe.messages.noticeDeviceToken');
    Route::get('page-client-chat','MessagesController@pageClientChat')->name('fe.messages.pageClientChat');
    Route::get('page-admin-chat','MessagesController@pageAdminChat')->name('fe.messages.pageAdminChat');

    Route::get('sitemap.xml','HomeController@indexSitemap');
    Route::get('post-sitemap.xml','HomeController@sitemapPost');
    Route::get('page-sitemap.xml','HomeController@sitemapPage');
    Route::get('cat_product-sitemap.xml','HomeController@siteCatProduct');
    Route::get('category-sitemap.xml','HomeController@siteCategory');
    Route::get('product-sitemap.xml','HomeController@siteProduct');
    Route::get('product1-sitemap.xml','HomeController@siteProduct1');
    Route::get('product2-sitemap.xml','HomeController@siteProduct2');
    Route::get('product3-sitemap.xml','HomeController@siteProduct3');
    Route::get('product4-sitemap.xml','HomeController@siteProduct4');
    Route::get('product5-sitemap.xml','HomeController@siteProduct5');
    Route::get('product6-sitemap.xml','HomeController@siteProduct6');
    Route::get('product7-sitemap.xml','HomeController@siteProduct7');
    Route::get('product8-sitemap.xml','HomeController@siteProduct8');
    Route::get('user_benhvien-sitemap.xml','HomeController@siteUserBenhVien');

    Route::get('{slug}.html','ProductController@drugstore')->name('fe.product.drugstore');
    
    Route::get('trang-chu-dong-du-lieu-tu-tdoctor','SyncTdoctorController@indexPage')->name('fe.SyncTdoctor.indexPage');
    Route::get('dong-du-lieu-bang-user','SyncTdoctorController@transferUsers')->name('fe.SyncTdoctor.transferUsers');
    Route::get('dong-du-lieu-bang-user_token','SyncTdoctorController@transferUserToken')->name('fe.SyncTdoctor.transferUserToken');
    Route::get('dong-du-lieu-bang-user_values','SyncTdoctorController@transferUserValues')->name('fe.SyncTdoctor.transferUserValues');
    Route::get('dong-du-lieu-bang-warehouses','SyncTdoctorController@transferWarehouses')->name('fe.SyncTdoctor.transferWarehouses');
    Route::get('dong-du-lieu-bang-producers','SyncTdoctorController@transferProducers')->name('fe.SyncTdoctor.transferProducers');
    Route::get('dong-du-lieu-bang-units','SyncTdoctorController@transferUnits')->name('fe.SyncTdoctor.transferUnits');
    Route::get('dong-du-lieu-bang-trademarks','SyncTdoctorController@transferTrademarks')->name('fe.SyncTdoctor.transferTrademarks');
    Route::get('dong-du-lieu-bang-products','SyncTdoctorController@transferProducts')->name('fe.SyncTdoctor.transferProducts');
    Route::get('dong-du-lieu-bang-product_warehouse','SyncTdoctorController@productWarehouse')->name('fe.SyncTdoctor.productWarehouse');
    Route::get('dong-du-lieu-bang-import_coupon','SyncTdoctorController@transferImportCoupon')->name('fe.SyncTdoctor.transferImportCoupon');
    Route::get('dong-du-lieu-bang-shop_product_add','SyncTdoctorController@transferShopProductAdd')->name('fe.SyncTdoctor.transferShopProductAdd');
    Route::get('cap-nhat-du-lieu-bang-products','SyncTdoctorController@updateProductsBySlug')->name('fe.SyncTdoctor.updateProductsBySlug');
    Route::get('xoa-cache-tat-ca-cac-san-pham','SyncTdoctorController@deleteAllCacheproduct')->name('fe.SyncTdoctor.deleteAllCacheproduct');
    Route::get('xoa-cache-search-keyword','SyncTdoctorController@clearSearchCache')->name('fe.SyncTdoctor.clearSearchCache');
    Route::get('xoa-cache-danh-sach-bac-si-keyword','SyncTdoctorController@clearListBacSiCache')->name('fe.SyncTdoctor.clearListBacSiCache');
    Route::get('xoa-cache-danh-sach-duoc-si-keyword','SyncTdoctorController@clearListDuocSiCache')->name('fe.SyncTdoctor.clearListDuocSiCache');
    Route::get('xoa-cache-danh-sach-nha-thuoc-keyword','SyncTdoctorController@clearListNhaThuocCache')->name('fe.SyncTdoctor.clearListNhaThuocCache');
    Route::get('xoa-cache-user-front-end','SyncTdoctorController@clearUserCache')->name('fe.SyncTdoctor.clearUserCache');
    Route::get('xoa-cache-danh-sach-benh-vien','SyncTdoctorController@clearListBenhVienCache')->name('fe.SyncTdoctor.clearListBenhVienCache');
    Route::get('xoa-cache-danh-sach-phong-kham','SyncTdoctorController@clearListPhongKhamCache')->name('fe.SyncTdoctor.clearListPhongKhamCache');
    Route::get('xoa-cache-danh-sach-shop-chung','SyncTdoctorController@clearListShopChungCache')->name('fe.SyncTdoctor.clearListShopChungCache');
    Route::get('xoa-cache-danh-sach-trinh-duoc-vien','SyncTdoctorController@clearListTrinhDuocVienCache')->name('fe.SyncTdoctor.clearListTrinhDuocVienCache');
    Route::get('xoa-cache-danh-sach-me-va-be','SyncTdoctorController@clearListMeVaBeCache')->name('fe.SyncTdoctor.clearListMeVaBeCache');
    Route::get('xoa-cache-danh-sach-tham-my-vien','SyncTdoctorController@clearListThamMyVien')->name('fe.SyncTdoctor.clearListThamMyVien');
    });