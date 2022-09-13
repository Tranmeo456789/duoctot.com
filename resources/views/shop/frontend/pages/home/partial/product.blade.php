<a href="{{route('fe.product.detail',$item->id)}}">
    @php
    $img_product = explode(',', $item['image']);
    @endphp
    <div class="d-flex justify-content-center" style="height: 180px;padding: 5px;">
        <img src="{{asset('public/shop/uploads/images/product/'.$img_product[0])}}">
    </div>
    <div class="px-2">
        <p class="truncate2">{{$item['name']}}</p>
        <span class="text-info">{{$item['price']}}/{{$item['unit']}}</span></span>
    </div>
</a>