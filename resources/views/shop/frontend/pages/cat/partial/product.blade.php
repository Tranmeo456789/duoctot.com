@foreach($items as $item)
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