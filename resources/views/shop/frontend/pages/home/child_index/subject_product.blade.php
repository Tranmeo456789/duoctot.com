<h1 class="d-flex justify-content-between mb-5 flex-wrap ">
    <div class="title_cathd mb-sm-2">
        <div class="d-flex align-items-center">
            <h1>Sản phẩm theo đối tượng</h1>
        </div>
        <img src="{{asset('images/shop/tp3.png')}}" alt="">
    </div>
    <div class="d-flex justify-content-between flex-wrap  slect-customer">
        <span>Lọc theo</span>
        <div class="d-flex justify-content-between flex-wrap">
            <div class="slect-item-customer active-slect">
                <a href="">Trẻ em</a>
            </div>
            <div class="slect-item-customer">
                <a href="">Người cao tuổi</a>
            </div>
            <div class="slect-item-customer">
                <a href="">Phụ nữ cho con bú</a>
            </div>
        </div>
    </div>
</h1>
<ul class="clearfix">
    @foreach($product_covids as $item)
    <li class="position-relative">
        <a href="{{route('fe.product.detail',$item['id'])}}">
            @php
            $img_product = explode(',', $item['image']);
            @endphp
            <div class="d-flex justify-content-center seth-img">
                    <div class="d-flex">
                        <img src="{{asset('public/shop/uploads/images/product/'.$img_product[0])}}">
                    </div>

            </div>
            <div class="pl-3">
                <p class="truncate2">{{$item['name']}}</p>
                <span class="text-info">{{$item['price']}}/{{$item['unit']}}</span></span>
            </div>
        </a>
        <div class="unit-top">{{$item['unit']}}</div>
    </li>
    @endforeach
</ul>