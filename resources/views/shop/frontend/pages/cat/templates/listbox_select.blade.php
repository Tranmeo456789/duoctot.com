@php
    use App\Model\Shop\TrademarkModel;
    use App\Model\Shop\CountryModel;

    $listTrademark = (new TrademarkModel)->listItems(null, ['task'=>'admin-list-items-in-selectbox']);
    $listCountry = (new CountryModel)->listItems(null, ['task'=>'admin-list-items-in-selectbox']);
@endphp
<ul class="list-box-select">
    <li>
        <h1 class="mb-2">Thương hiệu</h1>
        <div class="form-group mb-1 set_height_250">
            <!-- <div class="position-relative">
                    <input class="" type="text" name="" id="" autocomplete="off">
                    <div class="sfpro"><img src="{{asset('images/shop/icon-searchf.png')}}" alt=""></div>
                </div> -->
            <ul class="mt-2">
                <li>
                    <div class="d-flex"><input type="checkbox" checked='check'>
                        <div><label for="">Tất cả</label></div>
                </li>
                @foreach($listTrademark as $key=>$val)
                <li>
                    <div class="d-flex">
                        <input type="checkbox" name="list_trademark[]" value="{{$key}}">
                        <label for="">{{$val}}</label>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <!-- <div class="show_list_select"><a href="">Thu gọn</a></div> -->
    </li>
    <li>
        <h1 class="mb-2">Xuất xứ</h1>
        <div class="form-group mb-1 set_height_250">
            <ul class="mt-2">
                <li>
                    <div class="d-flex">
                        <input type="checkbox" name="" checked='check'>
                        <label for="">Tất cả</label>
                    </div>
                </li>
                @foreach($listCountry as $key=>$val)
                <li>
                    <div class="d-flex">
                        <input type="checkbox" name="list_country[]" value="{{$key}}">
                        <label for="">{{$val}}</label>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </li>
    <li>
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
    </li>
    <!-- <li>
        <h1 class="mb-2">Hỗ trợ điều trị</h1>
        <form action="">
            <div class="form-group mb-1">
                <div class="position-relative">
                    <input class="" type="text" name="" id="" autocomplete="off">
                    <div class="sfpro"><img src="{{asset('images/shop/icon-searchf.png')}}" alt=""></div>
                </div>
                <ul class="mt-2">
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id="">
                            <div><label for="">Tất cả</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Suy giảm hệ miễn dịch</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Suy nhược cơ thể</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Suy dinh dưỡng</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Lão hóa da</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Mệt mỏi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Suy nhược thần kinh</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Suy giảm tuần hoàn máu</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Thiếu vitamin nhóm B</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Chán ăn</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Bệnh tim mạch</label></div>
                    </li>
                </ul>
            </div>
        </form>
        <div class="show_list_select"><a href="">Thu gọn</a></div>
    </li>
    <li>
        <h1 class="mb-2">Sản phẩm organic</h1>
        <label class="switch ml-0">
            <input type="checkbox">
            <span class="slider round"></span>
        </label>
    </li>
    <li>
        <h1 class="mb-2">Thành phần</h1>
        <form action="">
            <div class="form-group mb-1">
                <div class="position-relative">
                    <input class="" type="text" name="" id="" autocomplete="off">
                    <div class="sfpro"><img src="{{asset('images/shop/icon-searchf.png')}}" alt=""></div>
                </div>
                <ul class="mt-2">
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id="">
                            <div><label for="">Tất cả</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Đông trùng hạ thảo</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Mẫu đơn bì(Vỏ rễ)</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Hoài Sơn</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Sinh Địa</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Dây thìa canh</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Cao sầu đâu</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Bạch chi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Cây phi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Diếp cá</label></div>
                    </li>
                </ul>
            </div>
        </form>
        <div class="show_list_select"><a href="">Thu gọn</a></div>
    </li>
    <li>
        <h1 class="mb-2">Đối tượng</h1>
        <form action="">
            <div class="form-group mb-1">
                <div class="position-relative">
                    <input class="" type="text" name="" id="" autocomplete="off">
                    <div class="sfpro"><img src="{{asset('images/shop/icon-searchf.png')}}" alt=""></div>
                </div>
                <ul class="mt-2">
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id="">
                            <div><label for="">Tất cả</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Trẻ em</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Người cao tuổi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Phụ nữ cho con bú</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Phụ nữ có thai</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Phụ nữ sau sinh</label></div>
                    </li>
                </ul>
            </div>
        </form>
        <div class="show_list_select"><a href="">Thu gọn</a></div>
    </li>
    <li>
        <h1 class="mb-2">Độ tuổi</h1>
        <form action="">
            <div class="form-group mb-1">
                <div class="position-relative">
                    <input class="" type="text" name="" id="" autocomplete="off">
                    <div class="sfpro"><img src="{{asset('images/shop/icon-searchf.png')}}" alt=""></div>
                </div>
                <ul class="mt-2">
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id="">
                            <div><label for="">Tất cả</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Trên 18 tuổi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Trên 1 tuổi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Trên 2 tuổi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Trên 12 tuổi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Trên 15 tuổi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Trên 15 tuổi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Trên 6 tuổi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Trên 10 tuổi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Trên 6 tháng tuổi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Trên 1 tháng tuổi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Trên 8 tuổi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Trên 16 tuổi</label></div>
                    </li>
                    <li>
                        <div class="d-flex"><input type="checkbox" name="" id=""><label for="">Trên 2 tuổi</label></div>
                    </li>
                </ul>
            </div>
        </form>
        <div class="show_list_select"><a href="">Thu gọn</a></div>
    </li> -->

</ul>