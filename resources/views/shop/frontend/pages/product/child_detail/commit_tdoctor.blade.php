@php
    $contact=$item['contact']??'0349.444.164';
@endphp
<div class="mt-3">
    <span class="contact-buy">Nếu mua số lượng lớn thì vui lòng liên hệ hotline <span class="phone">{{$contact}}</span></span>
</div>
<div class="pnote-view d-flex">
    <div>
        <div class="roud25y-img"><img src="{{asset('images/shop/star2.png')}}" alt=""></div>
    </div>
    <div>
        <span class="position-relative text-orange">Sản phẩm đang được chú ý</span>
        <span>, có 7 người thêm vào giỏ hàng & 16 người đang xem</span>
    </div>
</div>
<div class="commit-tdoctor-child">
    <div class="title-commit-tdoctor text-center">
        Tdoctor cam kết
    </div>
    <div class="content-commit-tdoctor">
        <ul class="d-flex justify-content-between flex-wrap">
            <li class="d-flex justify-content-center">
                <div>
                    <div class="text-center"><img src="{{asset('images/shop/cm1.png')}}" alt=""></div>
                    <h3>Đổi trả trong 30 ngày</h3>
                    <p>kể từ ngày mua hàng</p>
                </div>
            </li>
            <li class="d-flex justify-content-center">
                <div>
                    <div class="text-center"><img src="{{asset('images/shop/cm2.png')}}" alt=""></div>
                    <h3>Đổi trả trong 30 ngày</h3>
                    <p>kể từ ngày mua hàng</p>
                </div>
            </li>
            <div>
                <li class="d-flex justify-content-center">
                    <div>
                        <div class="text-center"><img src="{{asset('images/shop/cm3.png')}}" alt=""></div>
                        <h3>Đổi trả trong 30 ngày</h3>
                        <p>kể từ ngày mua hàng</p>
                    </div>
                </li>
            </div>
        </ul>
    </div>
    <div class="content-commit-tdoctorrespon">
        <ul class="">
            <li class="pl-3 mb-2 pt-2">
                <div class="d-flex">
                    <div class="roud1-img1 mr-1"><i class="fas fa-exchange-alt"></i></div>
                    <div class=" align-items-start">
                        <h3>Đổi trả trong 30 ngày</h3>
                        <p>kể từ ngày mua hàng</p>
                    </div>
                </div>
            </li>
            <li class="pl-3 mb-2">
                <div class="d-flex">
                    <div class="roud1-img1 mr-1"><i class="fas fa-thumbs-up"></i></div>
                    <div class=" align-items-start">
                        <h3>Miễn phí 100%</h3>
                        <p>đổi thuốc</p>
                    </div>
                </div>
            </li>
            <li class="pl-3">
                <div class="d-flex">
                    <div class="roud1-img1 mr-1"><i class="fas fa-truck"></i></div>
                    <div class=" align-items-start">
                        <h3>Miễn phí vận chuyển</h3>
                        <p>theo chính sách giao hàng</p>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</div>
<div class="mess_free bg-orange" data-contact="{{$contact}}"><span class="text-light">Nhận tư vấn miễn phí</span><img src="{{asset('images/shop/mess.png')}}" alt=""></div>