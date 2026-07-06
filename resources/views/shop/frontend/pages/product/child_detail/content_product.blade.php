<div class="col-6 text-center pb-2">
   <span class="product-tab-name">CHI TIẾT SẢN PHẨM</span>
</div>
<div class="col-6 text-center pb-2">
    <span class="product-tab-name"><a href="#new-reviews">ĐÁNH GIÁ</a></span>
</div>
<div class="short-infohr mb-3 w-100"></div>
<div class="col-12 col-lg-3 px-0">
    <div class="cat-content container-toc-list-product">
        <p class="font-weight-bold pt-3 pl-3" style="font-size: 22px;">TÓM TẮT NỘI DUNG</p>
        <ul class="list-content-product toc-list-product"></ul>
    </div>
</div>
<div class="col-12 col-lg-9">
    <div class="content-detail-product" id="toc-content-product">
        <h2 class="pt-3">1 Thành phần</h2>
        <p>{!!$item->elements ?? ''!!}</p>
        <h2 class="mt-2">2 Tác dụng - Chỉ định</h2>
        <p>{!!$item->benefit!!}</p>
        <h2 class="mt-2">3 Liều dùng - Cách dùng</h2>
        <p>{!!$item->dosage??''!!}</p>
        <h2>4 Lưu ý khi dùng</h2>
        <p>{!!$item->note!!}</p>
        <h2>5 Bảo quản</h2>
        <p>{!!$item->preserve ?? ''!!}</p>
        {!!$item->general_info ?? ''!!}
    </div>
</div>