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

    .ls_chon_thuong_hieu .wp-name-product {
        font-size: 16px;
    }

    .slider-wrapper {
        position: relative;
    }

    .prev-btn-th,
    .next-btn-th {
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
        var sliderTh = tns({
            container: ".ls_chon_thuong_hieu",
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
            }
        });
        document.querySelector('.prev-btn-th').addEventListener('click', function() {
            sliderTh.goTo('prev');
        });
        document.querySelector('.next-btn-th').addEventListener('click', function() {
            sliderTh.goTo('next');
        });
    });
</script>
<div class="slider-wrapper position-relative">
    <button class="prev-btn-th position-absolute" style="left: 0;">‹</button>
    <div class="clearfix list-unstyled ls_chon_thuong_hieu ls_product-view-add">
        <div class="swiper-slide p-1">
            <li class="position-relative">
                <a href="{{route('fe.search.viewHome', ['keyword' => 'abbott'])}}" class="d-block">
                    <div class="wp-img-thumb-product mb-2">
                        <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/th_abbott.jpg')}}" alt="th_abbott" decoding="async">
                    </div>
                </a>
            </li>
            <li class="position-relative">
                <a href="{{route('fe.search.viewHome', ['keyword' => 'boehringer'])}}" class="d-block">
                    <div class="wp-img-thumb-product mb-2">
                        <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/th_boehringer_ingelheim.jpg')}}" alt="th_boehringer_ingelheim" decoding="async">
                    </div>
                </a>
            </li>
        </div>
        <div class="swiper-slide p-1">
            <li class="position-relative">
                <a href="{{route('fe.search.viewHome', ['keyword' => 'servier'])}}" class="d-block">
                    <div class="wp-img-thumb-product mb-2">
                        <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/th_servier.jpg')}}" alt="servier" decoding="async">
                    </div>
                </a>
            </li>
            <li class="position-relative">
                <a href="{{route('fe.search.viewHome', ['keyword' => 'uip'])}}" class="d-block">
                    <div class="wp-img-thumb-product mb-2">
                        <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/th_uip.jpg')}}" alt="uip" decoding="async">
                    </div>
                </a>
            </li>
        </div>
        <div class="swiper-slide p-1">
            <li class="position-relative">
                <a href="{{route('fe.search.viewHome', ['keyword' => 'nordisk'])}}" class="d-block">
                    <div class="wp-img-thumb-product mb-2">
                        <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/th_novo_nordisk.jpg')}}" alt="nordisk" decoding="async">
                    </div>
                </a>
            </li>
            <li class="position-relative">
                <a href="{{route('fe.search.viewHome', ['keyword' => 'santen'])}}" class="d-block">
                    <div class="wp-img-thumb-product mb-2">
                        <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/th_santen.jpg')}}" alt="santen" decoding="async">
                    </div>
                </a>
            </li>
        </div>
        <div class="swiper-slide p-1">
            <li class="position-relative">
                <a href="{{route('fe.search.viewHome', ['keyword' => 'pfizer'])}}" class="d-block">
                    <div class="wp-img-thumb-product mb-2">
                        <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/pfizer.jpg')}}" alt="nordisk" decoding="async">
                    </div>
                </a>
            </li>
            <li class="position-relative">
                <a href="{{route('fe.search.viewHome', ['keyword' => 'sanofi'])}}" class="d-block">
                    <div class="wp-img-thumb-product mb-2">
                        <img loading="lazy" src="{{asset('laravel-filemanager/fileUpload/banner/sanofi.jpg')}}" alt="santen" decoding="async">
                    </div>
                </a>
            </li>
        </div>
    </div>
    <button class="next-btn-th position-absolute" style="right: 0;">›</button>
</div>