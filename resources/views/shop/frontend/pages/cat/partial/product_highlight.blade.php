@php
$objectProducts=[
    ['name'=>'Hàng mới','slug'=>'hang_moi'],
    ['name'=>'Bán chạy','slug'=>'ban_chay'],
    ['name'=>'Giá cao','slug'=>'gia_cao'],
    ['name'=>'Giá thấp','slug'=>'gia_thap']
]
@endphp
<div class="title-product-out d-flex justify-content-between flex-wrap">
    @include("$moduleName.templates.box_title_product",['title' => 'Sản phẩm nổi bật'])
    <div>
        <div class="fitter-wp d-flex">
            <div class="seclect_ol d-flex">
                <a class="ol1 activebtn"><img src="{{asset('images/shop/v4.png')}}" alt=""></a>
                <a class="ol2"><img src="{{asset('images/shop/3ngang.png')}}" alt=""></a>
            </div>
        </div>
    </div>
</div>
<div class="mb-2">
    @include("$moduleName.templates.select_filter_product",['items'=>$objectProducts])
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
                    <p class="truncate1">Dạng bào chế: {{$item['dosage_forms'] ?: '...'}}</p>
                    <p class="truncate1">Thành phần: {{$item['elements'] ?: '...'}}</p>
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
                    <p class="truncate1">Dạng bào chế: {{$item['dosage_forms'] ?: '...'}}</p>
                    <p class="truncate1">Thành phần: {{$item['elements'] ?: '...'}}</p>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</div>
<div class="view-addpr text-center mt-2"><a href="">Xem thêm 500 sản phẩm <i class="fas fa-angle-down"></i></a></div>