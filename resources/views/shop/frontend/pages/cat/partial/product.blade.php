@foreach($items as $item)
<li class="text-center">
    <a href="{{route('fe.product.detail',$item['slug'])}}">
        <div class="rdimg"><img loading="lazy" src="{{asset($item['image'])}}" alt=""></div>
        <div class="">
            <p class="name-body-nbox truncate2">{{$item['name']}}</p>
            @if(Session::has('user'))
            <h3 class="my-1 truncate1">{{ number_format( $item['price'], 0, "" ,"." )}}đ / {{$item->unitProduct->name}}</h3>
            @endif
            <p class="name-body-nbox truncate1">{{$item->catProduct->name}}</p>
            <div class="d-inline-block">
                <div class="unit-top">
                    <p class="truncate1 pt-0">{{ empty($item['specification']) ? $item->unitProduct->name : $item['specification'] }}</p>
                </div>
            </div>
            <p class="truncate1 text-left fs-12">Dạng bào chế: {{$item['dosage_forms'] ?: '...'}}</p>
            <div class="elements-product text-left">
                <p class="truncate1 fs-12">Thành phần: ...</p>
            </div>
        </div>
    </a>
</li>
@endforeach