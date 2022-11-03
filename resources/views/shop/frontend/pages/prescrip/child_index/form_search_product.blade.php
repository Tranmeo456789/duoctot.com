<div class="header d-flex justify-content-between">
    <div class="tshorder">Nhập theo tên thuốc</div>
    <button class="btn-closenk rimg-center"><img src="{{asset('images/shop/dn4.png')}}" alt=""></button>
</div>
<div class="d-flex justify-content-center">
    <div class="wp-content">
        <div action="" class="wp-content-shorder">
            <div class="input-search-prescrip">
                @include("$moduleName.pages.$controllerName.child_index.input_search_ls_product")
            </div>
            <div class="tshorder">
                <p class="title-list-select"></p>
            </div>
            <div>
                <ul class="ls-product-select"></ul>
            </div>
            <div class="text-center"><input type="submit" name="btn btn-searchorder" value="Hoàn tất" id="btn-searchorder"></div>
        </div>
    </div>
</div>