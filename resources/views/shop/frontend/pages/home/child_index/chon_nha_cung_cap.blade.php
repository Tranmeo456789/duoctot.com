<style>
    .ls_chon_nha_cung_cap li {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
    }
    .ls_chon_nha_cung_cap li .wp-img-thumb-product {
        height: 180px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .ls_chon_nha_cung_cap li p {
        color: #1E1E1E;
        line-height: 18px;
        padding-top: 4px;
    }
    .slider-wrapper {
        position: relative;
    }
    .prev-btn,
    .next-btn {
        top: 50%;
        transform: translateY(-50%);
        border: none;
        padding: 10px;
        cursor: pointer;
        z-index: 10;
        font-size: 30px;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var slider = tns({
            container: ".ls_chon_nha_cung_cap",
            items: 3,
            slideBy: 1,
            loop: true,
            speed: 400,
            autoplay: false,
            autoplayTimeout: 5000,
            autoplayButtonOutput: false,
            controls: false, // bỏ mặc định
            nav: false,
            mouseDrag: true,
            touch: true,
            gutter: 4,
            edgePadding: 0,
            responsive: {
                0: {
                    items: 2
                },
                768: {
                    items: 3
                }
            },
        });
        document.querySelector('.prev-btn').addEventListener('click', function() {
            slider.goTo('prev');
        });
        document.querySelector('.next-btn').addEventListener('click', function() {
            slider.goTo('next');
        });
    });
</script>
<div class="slider-wrapper position-relative">
    <button class="prev-btn position-absolute" style="left: 0;">‹</button>
    <div class="clearfix list-unstyled ls_chon_nha_cung_cap ls_product-view-add">
        @foreach(array_chunk($items->toArray(), 2) as $group)
        <div class="swiper-slide p-1">
            @foreach($group as $val)
            @php
            $imgThumb = isset($val['details']['image']) && $val['details']['image'] != ''
            ? route('home') . $val['details']['image']
            : route('home') . '/laravel-filemanager/fileUpload/nhathuoc/nhathuocmau10.jpg';

            $slug = $val['slug'];
            $linkShop = route('fe.product.drugstore', $slug);
            @endphp
            <li class="position-relative">
                <a href="{{$linkShop}}" class="d-block">
                    <div class="wp-img-thumb-product mb-2">
                        <img loading="lazy" src="{{ $imgThumb }}" alt="{{ $val['fullname'] }}" width="180" height="180" decoding="async">
                    </div>
                    <div class="pl-1">
                        <div class="text-center wp-name-product">
                            <p class="truncate3" style="font-size: 18px;">{{ $val['fullname'] }}</p>
                        </div>
                    </div>
                </a>
            </li>
            @endforeach
        </div>
        @endforeach
    </div>
    <button class="next-btn position-absolute" style="right: 0;">›</button>
</div>
<div class="text-center mt-2 mb-4" style="font-size: 18px"><a href="{{route('fe.product.listNhaCungCap')}}">Xem tất cả</a></div>