@php
    $number_product = '';
    if (!isset($itemsCart)){
        $itemsCart = [];
        if (isset($_COOKIE['cart'])){
            $itemsCart = json_decode($_COOKIE['cart'],true);
            $number_product = array_sum(array_column($itemsCart, 'total_product'));
        }
    }else{
        $number_product = array_sum(array_column($itemsCart, 'total_product'));
    }
    $classNumberCartMenu = ($number_product != '')?'d-block':'d-none';
@endphp
<div class="wp-inner presp">
    <div class="wp-iconmn">
        <div class="d-flex justify-content-between">
            <div id="btnmenu-resp" class="rimg-center"><img src="{{asset('images/shop/nb3.png')}}" alt=""></div>
            <div class="logotop"><a href="{{route('home')}}">
                    <div class="rimg-center"><img src="{{asset('images/shop/logo_topbar2.png')}}" alt=""></div>
                </a></div>
            <ul class="d-flex align-items-center">
                <li class="hrcart">
                    <a href="{{route('fe.product.cartFull')}}">
                        <div class="rimg-center">
                            <img src="{{asset('images/shop/cart.png')}}">
                        </div>
                    </a>
                    @if($number_product > 0)
                    <span class="number_cartmenu">{{$number_product}}</span>
                    @endif
                </li>
                <li class="hruse"><a href="">
                        <div class="rimg-center"><img src="{{asset('images/shop/mr1.png')}}" alt=""></div>
                    </a></li>
                <li class="hrflag">
                    <div class="rimg-center">
                        <img src="{{asset('images/shop/corp.png')}}" alt="" srcset="">
                    </div>
                </li>
            </ul>
        </div>
    </div>
    @if(!isset($viewNoSearchHeader))
        <div class="search-header-mobi">
            @include("$moduleName.block.input_search")
        </div>
    @endif
</div>