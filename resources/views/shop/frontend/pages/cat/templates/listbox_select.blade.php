<ul class="list-box-select">
    <li>
        <h1 class="mb-2">Thương hiệu</h1>
        <div class="form-group mb-1 set_height_250">
            <!-- <div class="position-relative">
                    <input class="" type="text" name="" id="" autocomplete="off">
                    <div class="sfpro"><img src="{{asset('images/shop/icon-searchf.png')}}" alt=""></div>
                </div> -->
            <ul class="mt-2 list-check-items">
                <li>
                    <div class="d-flex">
                        <input type="checkbox" class="check-all" name="" value="" checked='check'>
                        <div>
                            <label for="">Tất cả</label>
                        </div>
                </li>
                @foreach($listTrademark as $key=>$val)
                <li>
                    <div class="d-flex">
                        <input class="sub-checkbox" type="checkbox" name="list_trademark[]" value="{{$key}}">
                        <label for="">{{$val}}</label>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </li>
    <li>
        <h1 class="mb-2">Xuất xứ</h1>
        <div class="form-group mb-1 set_height_250">
            <ul class="mt-2 list-check-items">
                <li>
                    <div class="d-flex">
                        <input type="checkbox" class="check-all" name="" value="" checked='check'>
                        <label for="">Tất cả</label>
                    </div>
                </li>
                @foreach($listCountry as $key=>$val)
                <li>
                    <div class="d-flex">
                        <input class="sub-checkbox" type="checkbox" name="list_country[]" value="{{$key}}">
                        <label for="">{{$val}}</label>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </li>
    <div class="mt-2 text-center">
        <span class="btn btn-primary btnFilterProductInCat" data-href="{{route('fe.cat.filterProduct')}}" data-type="product_cat" data-idcat="{{$itemCatCurent['id']??''}}" data-orderby="hang_moi">Áp dụng</span>
    </div>
    <!-- <li>
        <h1 class="mb-2">Giá bán</h1>
        <form action="">
            <div class="form-group mb-1">
                <ul class="mt-2 list-slect-price-product">
                    <li>
                        <div class="slect-price-product"><a href="">Dưới 100.000đ</a></div>
                    </li>
                    <li>
                        <div class="slect-price-product"><a href="">100.000đ đến 300.00đ</a></div>
                    </li>
                    <li>
                        <div class="slect-price-product"><a href="">300.000đ đến 500.00đ</a></div>
                    </li>
                    <li>
                        <div class="slect-price-product"><a href="">Trên 500.000đ</a></div>
                    </li>
                </ul>
            </div>
        </form>
    </li> -->
    <!-- <li>
        <h1 class="mb-2">Sản phẩm organic</h1>
        <label class="switch ml-0">
            <input type="checkbox">
            <span class="slider round"></span>
        </label>
    </li> -->
</ul>