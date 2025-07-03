<style>
    .ls_product_gia_soc li {
        padding: 20px 3px;
        background: #fff;
        border: 1px solid #787878;
        border-radius: 10px;
        overflow: hidden;
    }
    .ls_product_gia_soc li .wp-img-thumb-product {
        height: 180px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .ls_product_gia_soc li p {
        color: #1E1E1E;
        line-height: 18px;
        padding-top: 4px;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        tns({
            container: ".ls_product_gia_soc",
            items: 5,
            slideBy: "page",
            loop: true,
            speed: 3000,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayButtonOutput: false,
            controls: false,
            nav: false,
            mouseDrag: true,
            gutter: 4, // Khoảng cách giữa các item (ví dụ 20px)
            edgePadding: 0, // Không thêm khoảng cách ở mép ngoài
            responsive: {
                0: {
                    items: 2
                },
                768: {
                    items: 5
                }
            },
            onInit: function() {
                document.querySelector(".banner_doitac").classList.remove("cS-hidden");
            }
        });
    });
</script>
<div class="clearfix list-unstyled ls_product_gia_soc ls_product-view-add">
    @foreach($items as $val)
    @php
    if(!empty($val['percent_discount'])){
    $priceOld=$val['price']*(1+$val['percent_discount']/100);
    }
    @endphp
    <div class="swiper-slide p-1">
        <li class="position-relative">
            <a href="{{route('fe.product.detail',$val['slug'])}}" class="d-block">
                <div class="wp-img-thumb-product mb-2">
                    <img loading="lazy" src="{{asset($val['image'])}}" alt="{{$val['name']}}" width="180" height="180" decoding="async">
                </div>
                <div class="pl-1">
                    <div class="d-flex align-items-center wp-name-product">
                        <p class="truncate3">{{$val['name']}}</p>
                    </div>
                    @if($val['show_price'] == 1)
                    <span class="text-info" style="font-size: 16px;font-weight:700">{{ number_format( $val['price'], 0, "" ,"." )}}đ / {{$val->unitProduct->name}}</span>
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
    </div>
    @endforeach
</div>