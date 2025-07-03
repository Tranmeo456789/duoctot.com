<style>
    .ls_chon_thuong_hieu li {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
    }
    .ls_chon_thuong_hieu li .wp-img-thumb-product {
        height: 180px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .ls_chon_thuong_hieu li p {
        color: #1E1E1E;
        line-height: 18px;
        padding-top: 4px;
    }
    .ls_chon_thuong_hieu .wp-name-product{
        font-size: 16px;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    tns({
        container: ".ls_chon_thuong_hieu",
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
<div class="clearfix list-unstyled ls_chon_thuong_hieu ls_product-view-add">
    <div class="swiper-slide p-1">
        <li class="position-relative">
            <a href="{{route('fe.search.viewHome', ['keyword' => 'hanibody'])}}" class="d-block">
                <div class="wp-img-thumb-product mb-2">
                    <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/hanibody_mobi1.webp')}}" alt="hanibody" width="180" height="180" decoding="async">
                </div>
                <div class="pl-1">
                    <div class="text-center wp-name-product">
                        <p class="truncate3">Hanibody</p>
                    </div>
                </div>
            </a>
        </li>
        <li class="position-relative">
            <a href="https://tdoctor.net/cong-ty-tnhh-nohtus-vietnam.html" class="d-block">
                <div class="wp-img-thumb-product mb-2">
                    <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/banner16_mobi.webp')}}" alt="nohtus" width="180" height="180" decoding="async">
                </div>
                <div class="pl-1">
                    <div class="text-center wp-name-product">
                        <p class="truncate3">Nohtus</p>
                    </div>
                </div>
            </a>
        </li>
    </div>
    <div class="swiper-slide p-1">
        <li class="position-relative">
            <a href="https://tdoctor.net/cong-ty-duoc-pham-dongsung-bio-pharm.html" class="d-block">
                <div class="wp-img-thumb-product mb-2">
                    <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/banner17_mobi.webp')}}" alt="dong sung" width="180" height="180" decoding="async">
                </div>
                <div class="pl-1">
                    <div class="text-center wp-name-product">
                        <p class="truncate3">Dược phẩm Đông Sung</p>
                    </div>
                </div>
            </a>
        </li>
        <li class="position-relative">
            <a href="https://tdoctor.net/cong-ty-tnhh-duoc-pham-pegasus.html" class="d-block">
                <div class="wp-img-thumb-product mb-2">
                    <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/banner_pegasus_mobi.webp')}}" alt="pegasus" width="180" height="180" decoding="async">
                </div>
                <div class="pl-1">
                    <div class="text-center wp-name-product">
                        <p class="truncate3">Pegasus</p>
                    </div>
                </div>
            </a>
        </li>
    </div>
    <div class="swiper-slide p-1">
        <li class="position-relative">
            <a href="{{route('fe.search.viewHome', ['keyword' => 'abbvie'])}}" class="d-block">
                <div class="wp-img-thumb-product mb-2">
                    <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/banner_abbvie_mobi.webp')}}" alt="abbvie" width="180" height="180" decoding="async">
                </div>
                <div class="pl-1">
                    <div class="text-center wp-name-product">
                        <p class="truncate3">Abbvie</p>
                    </div>
                </div>
            </a>
        </li>
        <li class="position-relative">
            <a href="https://tdoctor.net/trungson-healthcare.html" class="d-block">
                <div class="wp-img-thumb-product mb-2">
                    <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/banner21.webp')}}" alt="trungson healthcare" width="180" height="180" decoding="async">
                </div>
                <div class="pl-1">
                    <div class="text-center wp-name-product">
                        <p class="truncate3">Trung Sơn HealthCare</p>
                    </div>
                </div>
            </a>
        </li>
    </div>
    <div class="swiper-slide p-1">
        <li class="position-relative">
            <a href="{{route('fe.search.viewHome', ['keyword' => 'astrazeneca'])}}" class="d-block">
                <div class="wp-img-thumb-product mb-2">
                    <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/banner_astrazeneca_mobi.webp')}}" alt="astrazeneca" width="180" height="180" decoding="async">
                </div>
                <div class="pl-1">
                    <div class="text-center wp-name-product">
                        <p class="truncate3">Astrazeneca</p>
                    </div>
                </div>
            </a>
        </li>
        <li class="position-relative">
            <a href="{{route('fe.search.viewHome', ['keyword' => 'merck'])}}" class="d-block">
                <div class="wp-img-thumb-product mb-2">
                    <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/banner_merck_mobi.webp')}}" alt="merck" width="180" height="180" decoding="async">
                </div>
                <div class="pl-1">
                    <div class="text-center wp-name-product">
                        <p class="truncate3">Merck</p>
                    </div>
                </div>
            </a>
        </li>
    </div>
    <div class="swiper-slide p-1">
        <li class="position-relative">
            <a href="{{route('fe.search.viewHome', ['keyword' => 'roche'])}}" class="d-block">
                <div class="wp-img-thumb-product mb-2">
                    <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/banner_roche_mobi.webp')}}" alt="roche" width="180" height="180" decoding="async">
                </div>
                <div class="pl-1">
                    <div class="text-center wp-name-product">
                        <p class="truncate3">Roche</p>
                    </div>
                </div>
            </a>
        </li>
        <li class="position-relative">
            <a href="{{route('fe.search.viewHome', ['keyword' => 'pfizer'])}}" class="d-block">
                <div class="wp-img-thumb-product mb-2">
                    <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/banner_pfizer_mobi.webp')}}" alt="merck" width="180" height="180" decoding="async">
                </div>
                <div class="pl-1">
                    <div class="text-center wp-name-product">
                        <p class="truncate3">Pfizer</p>
                    </div>
                </div>
            </a>
        </li>
    </div>
</div>