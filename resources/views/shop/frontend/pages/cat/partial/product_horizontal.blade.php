@foreach($items as $item)
<li>
    <a href="{{route('fe.product.detail',$item['slug'])}}" class="d-flex">
        <div class="rimg-center1"><img loading="lazy" src="{{asset($item['image'])}}" alt=""></div>
        <div class="rightcnb">
            <p class="truncate2 nb-name-product">{{$item['name']}}</p>
            <h3 class="truncate1">{{ number_format( $item['price'], 0, "" ,"." )}}đ / {{$item->unitProduct->name}}</h3>
            <p class="noteheth truncate1">{{$item->catProduct->name}}</p>
            <div class="d-inline-block">
                <div class="unit-top">
                    <p class="truncate1 pt-0 mb-0">{{ empty($item['specification']) ? $item->unitProduct->name : $item['specification'] }}</p>
                </div>
            </div>
            <p class="truncate1 text-left fs-12">Dạng bào chế: {{$item['dosage_forms'] ?: '...'}}</p>
            <p class="truncate2 text-left fs-12">Thành phần: {{$item['elements'] ?: '...'}}</p>
        </div>
    </a>
</li>
@endforeach