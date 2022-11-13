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
                    @if(Session::has('cart'))
                    @if(count(Session::get('cart')) > 0 )
                    <span class="number_cartmenu">{{count(Session::get('cart'))}}</span>
                    @endif
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
    <div class="ipsp">
        <input type="text" placeholder="Nhập tìm thuốc, TPCN, bệnh lý ...">
        <div class="rimg-center"></div><img src="{{asset('images/shop/icsp.png')}}" alt="">
    </div>
</div>