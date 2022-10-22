@php
    $number_product = '';
    $message = '';
    if (!isset($itemsCart)){
        $itemsCart = [];
        if (isset($_COOKIE['cart'])){
            $itemsCart = json_decode($_COOKIE['cart'],true);
            $number_product = array_sum(array_column($itemsCart, 'total_product'));
        }
    }else{
        $number_product = array_sum(array_column($itemsCart, 'total_product'));
        $message = "Thêm thành công sản phẩm vào giỏ hàng";
    }
    $classMessage = ($message != '')?'d-block':'d-none';
    $classNumberCartMenu = ($number_product != '')?'d-block':'d-none';
@endphp
<span class="number_cartmenu {{$classNumberCartMenu}}">{{$number_product}}</span>
<div class="dropdown-cart">
<div class="close-cart"><img src="{{asset('images/shop/dn4.png')}}" alt=""></div>
    <span class="arrow-up"><i class="fas fa-sort-up"></i></span>
    <p class="text-success noti-cart {{$classMessage}}">{{$message}}</p>
    <ul class="list-cart-mini">
        @foreach ($itemsCart as $keyCart =>$valCart)
        <li class="user-seller user-seller-{{$keyCart}}" data-id={{$keyCart}}>
            <p class="name_seller">{!! $valCart['name'] !!}</p>
            <ul class="list-product-in-cart">
                @foreach ($valCart['product'] as $product)
                    @include ("$moduleName.pages.cart.partial.item_product_in_cart_mini",['item' => $product,'user_sell' => $keyCart])
                @endforeach
            </ul>
            <div class="text-right"><a href="{{route('fe.product.viewcart',['user_sell' => $keyCart])}}" class="btn btn-sm btn-success btn-view-cart">Mua hàng</a></div>
        </li>
        @endforeach
    </ul>
    <div class="text-center"><a href="{{route('fe.product.cart')}}" class="viewcartmini">Xem giỏ hàng</a></div>
    <div class="cbh2"><a href="{{route('home')}}">Tiếp tục mua hàng</a></div>
</div>