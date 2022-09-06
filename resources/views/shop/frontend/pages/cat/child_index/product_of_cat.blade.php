<div class="title-cat d-flex">
    <div class="icon-cat-product">
        <img src="{{asset('images/shop/vuongwin.png')}}" alt="">
    </div>
    <h1>{{$catc['name']}}</h1>
</div>
<div class="body-cat-product">
    <ul class="clearfix">
        @foreach($_SESSION['cat_product'] as $catp1)
        @if($catc['id']==$catp1['parent_id'])
        <li class="">
            <div class="d-flex">
                <div class="item-cat-left text-center">
                    <a href="">
                        <div><img src="{{asset('public/shop/uploads/images/product/'.$catp1['image'])}}" alt="" style="width:70%"></div>
                        <h3>{{$catp1['name']}}</h3>
                        <span>44 sản phẩm</span>
                    </a>
                </div>
                @php
                    $temp=0;
                @endphp
                @foreach($_SESSION['cat_product'] as $catp2)
                @if($catp1['id'] == $catp2['parent_id'])
                @php
                    $temp++;
                @endphp
                @endif
                @endforeach
                <div class="item-cat-right">
                    @if($temp < 6 )
                    <ul>
                        @foreach($_SESSION['cat_product'] as $catp2)
                        @if($catp1['id'] == $catp2['parent_id'])
                        <li><a href="">{{$catp2['name']}}</a></li>
                        @endif
                        @endforeach
                    </ul>
                    @else
                    <ul class="d-flex flex-wrap">
                        @foreach($_SESSION['cat_product'] as $catp2)
                        @if($catp1['id'] == $catp2['parent_id'])
                        <li style="width:48%"><a href="">{{$catp2['name']}}</a></li>
                        @endif
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </li>
        @endif
        @endforeach

    </ul>
</div>
<div class="bodycat-productrespon">
    @php
    $item_sub_menu1s = [
    [ 'name' => 'Sinh lý - Nội tiết tố', 'id' => 6,'parent_id'=>1 ,'image'=>'sm1.png','quanty'=>44],
    [ 'name' => 'Sức khỏe tim mạch', 'id' => 7,'parent_id'=>1,'image'=>'sm2.png','quanty'=>44],
    [ 'name' => 'Hỗ trợ tiêu hóa', 'id' => 8,'parent_id'=>1,'image'=>'sm3.png','quanty'=>49],
    [ 'name' => 'Thần kinh não', 'id' => 9,'parent_id'=>1,'image'=>'sm4.png','quanty'=>44],
    [ 'name' => 'Hỗ trợ điều trị', 'id' => 10,'parent_id'=>1,'image'=>'sm5.png','quanty'=>46],
    [ 'name' => 'Cải thiện tăng cường chức năng', 'id' => 11,'parent_id'=>6,'image'=>'sm6.png','quanty'=>50],
    [ 'name' => 'Thảo dược và thực phẩm tự nhiên', 'id' => 12,'parent_id'=>7,'image'=>'sm7.png','quanty'=>17],
    [ 'name' => 'Hỗ trợ làm đẹp', 'id' => 13,'parent_id'=>1,'image'=>'sm8.png','quanty'=>44],
    [ 'name' => 'Vitamin và khoáng chất', 'id' => 14,'parent_id'=>1,'image'=>'sm9.png','quanty'=>68],
    [ 'name' => 'Dinh dưỡng', 'id' => 15,'parent_id'=>1,'image'=>'sm10.png','quanty'=>99],
    ];

    $item_submenu2s = [
    [ 'name' => 'Sinh lý nam', 'id' => 40,'parent_id'=>6,'image'=>'sl1.png'],
    [ 'name' => 'Sinh lý nữ', 'id' => 41,'parent_id'=>6,'image'=>'sl2.png'],
    [ 'name' => 'Hỗ trợ mãn kinh', 'id' => 42,'parent_id'=>6,'image'=>'sl3.png'],
    [ 'name' => 'Cân bằng nội tiết tố', 'id' => 43,'parent_id'=>6,'image'=>'sl4.png'],
    [ 'name' => 'Sức khỏe tình dục', 'id' => 44,'parent_id'=>6,'image'=>'sl5.png'],

    [ 'name' => 'Huyết áp', 'id' => 45,'parent_id'=>7,'image'=>'sktm1.png'],
    [ 'name' => 'Cholesterol', 'id' => 46,'parent_id'=>7,'image'=>'sktm2.png'],
    [ 'name' => 'Suy giãn tim mạch', 'id' => 47,'parent_id'=>7,'image'=>'sktm3.png'],

    [ 'name' => 'Dạ dày, tá tràng', 'id' => 48,'parent_id'=>8,'image'=>'htth1.png'],
    [ 'name' => 'Nhuận tràng', 'id' => 49,'parent_id'=>8,'image'=>'htth2.png'],
    [ 'name' => 'Khó tiêu', 'id' => 50,'parent_id'=>8,'image'=>'htth3.png'],
    [ 'name' => 'Táo bón', 'id' => 51,'parent_id'=>8,'image'=>'htth4.png'],
    [ 'name' => 'Đại tràng', 'id' => 52,'parent_id'=>8,'image'=>'htth5.png'],

    [ 'name' => 'Bổ não, cải thiện chí nhớ', 'id' => 53,'parent_id'=>9,'image'=>'tkn1.png'],
    [ 'name' => 'Kiểm soát căng thẳng', 'id' => 54,'parent_id'=>9,'image'=>'tkn2.png'],
    [ 'name' => 'Hỗ trợ giấc ngủ', 'id' => 55,'parent_id'=>9,'image'=>'tkn3.png'],

    [ 'name' => 'Trĩ', 'id' => 56,'parent_id'=>10,'image'=>'htdt1.png'],
    [ 'name' => 'Hô hấp xoang', 'id' => 57,'parent_id'=>10,'image'=>'htdt2.png'],
    [ 'name' => 'Cơ xương khớp', 'id' => 58,'parent_id'=>10,'image'=>'htdt3.png'],
    [ 'name' => 'Gout', 'id' => 59,'parent_id'=>10,'image'=>'htdt4.png'],
    [ 'name' => 'Tiểu đường', 'id' => 60,'parent_id'=>10,'image'=>'htdt5.png'],
    [ 'name' => 'Gan - mật', 'id' => 61,'parent_id'=>10,'image'=>'htdt6.png'],
    [ 'name' => 'Thận tiền liệt tuyến', 'id' => 62,'parent_id'=>10,'image'=>'htdt7.png'],
    [ 'name' => 'Xem tất cả', 'id' => 63,'parent_id'=>10,'image'=>'htdt8.png'],

    [ 'name' => 'Bảo vệ mắt', 'id' => 64,'parent_id'=>11,'image'=>'cttccn1.png'],
    [ 'name' => 'Tăng sức đề kháng', 'id' => 65,'parent_id'=>11,'image'=>'cttccn2.png'],
    [ 'name' => 'Hỗ trợ trao đổi chất', 'id' => 66,'parent_id'=>11,'image'=>'cttccn3.png'],

    [ 'name' => 'Nghệ & Curcumin', 'id' => 67,'parent_id'=>12,'image'=>'tdtp1.png'],
    [ 'name' => 'Nhân sâm', 'id' => 68,'parent_id'=>12,'image'=>'tdtp2.png'],
    [ 'name' => 'Đông trùng hạ thảo', 'id' => 69,'parent_id'=>12,'image'=>'tdtp3.png'],
    [ 'name' => 'Trinh nữ hoàng cung', 'id' => 70,'parent_id'=>12,'image'=>'tdtp4.png'],
    [ 'name' => 'Mật ong', 'id' => 71,'parent_id'=>12,'image'=>'tdtp5.png'],
    [ 'name' => 'Tỏi', 'id' => 72,'parent_id'=>12,'image'=>'tdtp6.png'],
    [ 'name' => 'Hà thủ ô', 'id' => 73,'parent_id'=>12,'image'=>'tdtp7.png'],
    [ 'name' => 'Xem tất cả', 'id' => 74,'parent_id'=>12,'image'=>'tdtp8.png'],

    [ 'name' => 'Da', 'id' => 75,'parent_id'=>13,'image'=>'htld1.png'],
    [ 'name' => 'Tóc', 'id' => 76,'parent_id'=>13,'image'=>'htld2.png'],
    [ 'name' => 'Kích cỡ ngực', 'id' => 77,'parent_id'=>13,'image'=>'htld3.png'],
    [ 'name' => 'Hỗ trợ giảm cân', 'id' => 78,'parent_id'=>13,'image'=>'htld4.png'],
    [ 'name' => 'Thực phẩm giảm cân', 'id' => 79,'parent_id'=>13,'image'=>'htld5.png'],

    [ 'name' => 'VitaminC', 'id' => 80,'parent_id'=>14,'image'=>'vtmkc1.png'],
    [ 'name' => 'VitaminA', 'id' => 81,'parent_id'=>14,'image'=>'vtmkc2.png'],
    [ 'name' => 'VitaminE', 'id' => 82,'parent_id'=>14,'image'=>'vtmkc3.png'],
    [ 'name' => 'Canxi', 'id' => 83,'parent_id'=>14,'image'=>'vtmkc4.png'],
    [ 'name' => 'Sắt', 'id' => 84,'parent_id'=>14,'image'=>'vtmkc5.png'],
    [ 'name' => 'Kẽm', 'id' => 85,'parent_id'=>14,'image'=>'vtmkc6.png'],
    [ 'name' => 'DHA', 'id' => 86,'parent_id'=>14,'image'=>'vtmkc7.png'],
    [ 'name' => 'Xem tất cả', 'id' => 87,'parent_id'=>14,'image'=>'vtmkc8.png'],

    [ 'name' => 'Sữa', 'id' => 88,'parent_id'=>15,'image'=>'sua1.png'],
    [ 'name' => 'Thực phẩm ăn kiêng', 'id' => 89,'parent_id'=>15,'image'=>'sua2.png'],
    ];
    @endphp
    <ul>
        @foreach ($item_sub_menu1s as $item_sub_menu1)
        <li>
            <div class=" position-relative catparentc">
                <div class="d-flex titlet">
                    <div class="rimg-center4"><img src="{{asset('images/shop/' .  $item_sub_menu1['image'] )}}" alt=""></div>
                    <div>
                        <h1>{{$item_sub_menu1['name']}}</h1>
                        <p>{{$item_sub_menu1['quanty']}} sản phẩm</p>
                    </div>
                </div>
                <div class="vissubmenu"><img src="{{asset('images/shop/arrow.png')}}" alt=""></div>
                <div class="submenua1">
                    <ul>
                        @foreach ($item_submenu2s as $item_submenu2)
                        @if ($item_submenu2['parent_id'] == $item_sub_menu1['id'] )
                        <li><a href="">{{$item_submenu2['name']}}</a></li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>