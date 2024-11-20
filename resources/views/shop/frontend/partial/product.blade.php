@foreach($items as $val)
    @php
        if(!empty($val['percent_discount'])){
            $priceOld=$val['price']*(1+$val['percent_discount']/100);
        }
    @endphp
    <li class="position-relative">
        <a href="{{route('fe.product.detail',$val['slug'])}}" class="d-block">
            <div class="wp-img-thumb-product mb-2">
                <img class="lazy" data-src="{{asset($val['image'])}}" src='data:image/webp;base64,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' alt="{{$val['name']}}">
            </div>
            <div class="pl-1">
                <div class="d-flex align-items-center wp-name-product">
                    <p class="truncate3">{{$val['name']}}</p>
                </div>
                @if($val['show_price'] == 1)
                <span class="text-info">{{ number_format( $val['price'], 0, "" ,"." )}}đ / {{$val->unitProduct->name}}</span>
                <div class="price-old">
                    @if(!empty($val['percent_discount']))
                        {{ number_format( $priceOld, 0, "" ,"." )}}đ
                    @endif
                </div>
                @else
                <span class="text-info">...</span>
                <div class="price-old">...</div>
                @endif
            </div>
        </a>
        <div class="d-inline-block pl-2">
            <div class="unit-top">
                <p class="truncate1 pt-0">{{ empty($val['specification']) ? $val->unitProduct->name : $val['specification'] }}</p>
            </div>
        </div>
        @if(!empty($val['percent_discount']))
            <div class="wp-discount">-{{$val['percent_discount']}}%</div>
        @endif
    </li>
@endforeach