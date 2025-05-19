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
                    <div class="d-flex justify-content-center wp-img-thumb-product"><img class="lazy" src="{{asset($val['image'])}}" alt=""></div>
                    <div class="mt-3 px-2">
                        <div class="wp-name-product">
                            <p class="truncate3">{{$val['name']}}</p>
                        </div>
                        <span class="text-info">...</span>
                    </div>
                </a>
                <div class="text-center slbuy"><a>Chọn mua</a></div>
            </li>
            @endforeach
        </ul>
    </div>
@endif
</div>