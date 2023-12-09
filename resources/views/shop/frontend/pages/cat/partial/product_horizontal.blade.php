@foreach($items as $item)
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