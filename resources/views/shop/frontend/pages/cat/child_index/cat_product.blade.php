<div class="title-product-out d-flex justify-content-between mb-3 flex-wrap">
    <div class="title_cathd">
        <div class="d-flex align-items-center">
            <div class="d-flex"><img src="{{asset('images/shop/banc1.png')}}" alt=""></div>
            <h1>Sản phẩm nổi bật</h1>
        </div>
    </div>
    <div>
        <div class="fitter-wp d-flex">
            <div class="selectpp align-self-center">
                <p>Lọc theo</p>
                <ul class="d-flex">
                    <li><a href="" class="active-btn">Bán chạy</a></li>
                    <li><a href="">Mới nhất</a></li>
                    <li><a href="">Giá thấp</a></li>
                    <li><a href="">Giá cao</a></li>
                </ul>
            </div>
            <div class="seclect_ol d-flex">
                <a class="ol1 activebtn"><img src="{{asset('images/shop/v4.png')}}" alt=""></a>
                <a class="ol2"><img src="{{asset('images/shop/3ngang.png')}}" alt=""></a>
            </div>
        </div>
    </div>

</div>
<div class="fitler-respon mb-2">
    <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hàng mới</button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Bán chạy</a>
            <a class="dropdown-item" href="#">Giá thấp</a>
            <a class="dropdown-item" href="#">Giá cao</a>
        </div>
    </div>
</div>
<div class="body-nb">
    <ul>
        @foreach($products as $item)
        <li>
            <a href="{{route('fe.product.detail',$item['id'])}}" class="d-flex">
                <div class="rimg-center1"><img src="{{asset($item['image'])}}" alt=""></div>
                <div class="rightcnb">
                    <p class="truncate2 nb-name-product">{{$item['name']}}</p>
                    <h3 class="truncate1">{{ number_format( $item['price'], 0, "" ,"." )}}đ / {{$item->unitProduct->name}}</h3>
                    <p class="noteheth truncate1">{{$item->catProduct->name}}</p>
                    <p class="truncate1">Dạng bào chế: {{$item['dosage_forms']}}</p>
                    <p class="truncate1">Thành phần: Tô điệp</p>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</div>
<div id="body-nbox">
    <ul class="clearfix">
        @foreach($products as $item)
        <li class="text-center">
            <a href="{{route('fe.product.detail',$item['id'])}}">
                <div class="rdimg"><img src="{{asset($item['image'])}}" alt=""></div>
                <div class="">
                    <p class="name-body-nbox truncate2">{{$item['name']}}</p>
                    <h3 class="my-1 truncate1">{{ number_format( $item['price'], 0, "" ,"." )}}đ / {{$item->unitProduct->name}}</h3>
                    <p class="name-body-nbox truncate1">{{$item->catProduct->name}}</p>
                    <p class="truncate1">Dạng bào chế: {{$item['dosage_forms']}}</p>
                    <p class="truncate1">Thành phần: Tô điệp</p>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</div>
<div class="view-addpr text-center mt-2"><a href="">Xem thêm 500 sản phẩm <i class="fas fa-angle-down"></i></a></div>