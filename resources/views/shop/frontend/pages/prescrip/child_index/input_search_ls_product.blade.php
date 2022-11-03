<div class="content text-center">
    <div class="content-top-2">
        <div class=" position-relative">
            <input class="input-prescrip pd-left-40 search-product-keyup" data-href="{{route('fe.product.searchProductAjax')}}" type="search" value="{{$keyword??''}}" placeholder="Vui lòng nhập tên thuốc cần tìm">
            <div class="img-person img-search-product"><img src="{{asset('images/shop/searchp.png')}}" alt=""></div>
        </div>
    </div>
    <div class="ls-product-search">
        @include("$moduleName.pages.$controllerName.child_index.ls_product_search")
    </div>
</div>