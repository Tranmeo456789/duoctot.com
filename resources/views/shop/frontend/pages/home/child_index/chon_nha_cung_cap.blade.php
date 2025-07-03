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
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    tns({
        container: ".ls_chon_nha_cung_cap",
        items: 5,
        slideBy: 1, // trượt từng item (hoặc "page" nếu muốn theo cụm)
        loop: false, // không vòng lặp
        speed: 400, // tốc độ chuyển slide khi vuốt
        autoplay: false, // tắt autoplay
        autoplayTimeout: 5000,
        autoplayButtonOutput: false,
        controls: false,
        nav: false,
        mouseDrag: true, // cho phép kéo bằng chuột
        touch: true, // cho phép vuốt trên thiết bị cảm ứng
        gutter: 4,
        edgePadding: 0,
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
                            <p class="truncate3" style="font-size: 16px;">{{ $val['fullname'] }}</p>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </div>
    @endforeach
</div>