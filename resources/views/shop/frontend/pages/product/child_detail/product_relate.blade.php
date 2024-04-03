@php
    use App\Helpers\MyFunction;
@endphp
<div id="feature-product-wp">
    @if(count($items) > 0)
    <div class="viewnproduct">
        @include("$moduleName.templates.box_title_product",['title' => 'Sản phẩm liên quan','classBackground'=>'bg-danger'])
        <ul class="clearfix list-unstyled ls_product">
            @foreach($items as $key=>$val)
            <li class="position-relative">
                <a href="{{route('fe.product.detail',$val['slug']??'')}}">
                    <div class="d-flex justify-content-center wp-img-thumb-product"><img src="{{asset($val['image'])}}" alt=""></div>
                    <div class="mt-3 px-2">
                        <div class="wp-name-product">
                            <p class="truncate3">{{$val['name']}}</p>
                        </div>
                        @if(Session::has('user'))
                        <span class="text-info">{{ MyFunction::formatNumber($val['price'])}}đ / {{$val->unitProduct->name??''}}</span>
                        @endif
                    </div>
                </a>
                <div class="text-center slbuy"><a href="">Chọn mua</a></div>
            </li>
            @endforeach
        </ul>
    </div>
@endif
</div>