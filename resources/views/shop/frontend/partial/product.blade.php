@foreach($items as $index => $val)
    @php
        if(!empty($val['percent_discount'])){
            $priceOld=$val['price']*(1+$val['percent_discount']/100);
        }
    @endphp
    <li class="position-relative">
        <a href="{{route('fe.product.detail',$val['slug'])}}" class="d-block">
            <div class="wp-img-thumb-product mb-2">
                 <img src="{{ asset('public'.$val['image']) }}"
                    width="180"
                    height="180"
                    alt="{{ $val['name'] ?? '' }}"
                    loading="{{ $index < 4 ? 'eager' : 'lazy' }}"
                    fetchpriority="{{ $index < 2 ? 'high' : 'auto' }}">
            </div>
            <div class="pl-1">
                <div class="d-flex align-items-center wp-name-product">
                    <p class="truncate3">{{$val['name']}}</p>
                </div>
                @if($val['show_price'] == 1)
                <span class="text-info" style="font-size: 15px;font-weight:700">{{ number_format( $val['price'], 0, "" ,"." )}}đ / {{$val->unitProduct->name}}</span>
                <div class="price-old">
                    @if(!empty($val['percent_discount']))
                        {{ number_format( $priceOld, 0, "" ,"." )}}đ
                    @endif
                </div>
                @elseif($val['prescription_drug'] == 1)
                <span class="text-info">Thuốc kê đơn</span>
                <div class="price-old"></div>
                @else
                <span class="text-info">Giá liên hệ</span>
                <div class="price-old"></div>
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