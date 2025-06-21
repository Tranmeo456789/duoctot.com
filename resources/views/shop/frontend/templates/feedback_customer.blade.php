@php
$feedbacks=[
['thumb'=>'phanhoi1.png','fullname'=>'Duy Nguyễn Nhất','content'=>'Rất tuyệt vời, đặc biệt trong mùa dịch đi lại khó khăn. Chúc tdoctor ngày càng phát triển và mở rộng phạm vi ra nhiều tỉnh hơn, nhất là vùng Đồng bằng sông Cửu Long.'],
['thumb'=>'phanhoi2.png','fullname'=>'Quốc Bình Vũ','content'=>'Ứng dụng rất hay. Giúp mọi người hạn chế bệnh gì cũng phải đến bệnh viện khám. Đỡ mất thời gian, công sức và tiền bạc vì nhiều khi vô gặp bs cũng chỉ cần hỏi vài câu và cho SP.'],
['thumb'=>'phanhoi3.png','fullname'=>'Nguyễn Ngọc Minh','content'=>'Em bị ung thư thấy bác sĩ tuyến trung ương trong hệ thống tdoctor, bác sĩ bên tdoctor rất nhiệt tình, rất tiện cho trường hợp mua sản phẩm dược và thực phẩm chức uy tín online.']
];
$imgCustomer=['1.jpg', '2.jpg'];
@endphp
<div class="row mx-0">
    <div class="col-xl-3 col-lg-12 dlapp pb-3 mb-3">
        <div class="dlapp1">
            <div class="mb-4">
                <div class="row">
                    <div class="col-6 col-lg-12">
                        <div class="font-weight-bold">TẢI ỨNG DỤNG TDOCTOR</div>
                        <div class="my-2">Mua thuốc trực tuyến, giao hàng tận nơi dễ dàng và nhanh chóng</div>
                        <div class="align-self-center d-md-none">
                            <div class="btn btn-primary btn-sm rounded m-0 p-1">
                                <a href="{{route('fe.home.downloadAppTdoctor')}}" style="font-size: 14px;line-height: 10px;" class="text-light font-weight-bold">↓ TẢI NGAY</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-12 text-center">
                        <img src="{{asset('images/shop/qr-app-tdoctor.jpg')}}" alt="Tdoctor" width="181" height="161" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-12">
        <ul>
            @foreach($feedbacks as $val)
            @php
            $thumb = asset('images/shop/') . '/' . $val['thumb'];
            @endphp
            <li class="d-flex mb-3">
                <div class="rimg-start"><img src="{{$thumb}}" alt="tdoctor"></div>
                <div class="ml-3">
                    <p class="font-weight-bold">{{$val['fullname']}}</p>
                    <span>
                        <img src="{{asset('images/shop/star.png')}}" alt="tdoctor" loading="lazy" width="20" height="20" decoding="async">
                        <img src="{{asset('images/shop/star.png')}}" alt="tdoctor" loading="lazy" width="20" height="20" decoding="async">
                        <img src="{{asset('images/shop/star.png')}}" alt="tdoctor" loading="lazy" width="20" height="20" decoding="async">
                        <img src="{{asset('images/shop/star.png')}}" alt="tdoctor" loading="lazy" width="20" height="20" decoding="async">
                        <img src="{{asset('images/shop/star.png')}}" alt="tdoctor" loading="lazy" width="20" height="20" decoding="async">
                    </span>
                    <p>{{$val['content']}}</p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="col-xl-3 col-lg-12">
        <ul class="list-unstyled text-center">
            <li class="text-center">
                <img src="{{asset('images/shop/1.jpg')}}" alt="tdoctor" class="img-fluid" width="233" height="488" loading="lazy" decoding="async">
            </li>
            <!-- <li class="text-center">
                <img src="{{asset('images/shop/2.jpg')}}" alt="tdoctor" class="img-fluid">
            </li> -->
        </ul>
    </div>
    <!-- <div class="col-xl-3 col-lg-12 dlapp pb-0">
        <div class="dlapp1">
            <div class="mb-4">
                <h6>App Tdoctor dành cho bệnh nhân</h6>
                <div class="my-2"><a href="https://apps.apple.com/us/app/tdoctor/id1443310734"><img class="lazy" src="{{asset('images/shop/app1.png')}}" alt="Tdoctor"></a></div>
                <div><a href="https://play.google.com/store/apps/details?id=com.app.khambenh.bacsiviet"><img class="lazy" src="{{asset('images/shop/app2.png')}}" alt="Tdoctor"></a></div>
            </div>
            <div class="pb-4">
                <h6>App Tdoctor dành cho Bác sĩ</h6>
                <div class="my-2"><a href="https://apps.apple.com/vn/app/tdoctor-for-doctor/id1555758280"><img class="lazy" src="{{asset('images/shop/app1.png')}}" alt="Tdoctor"></a></div>
                <div><a href="https://play.google.com/store/apps/details?id=com.app.khambenh.doctor"><img class="lazy" src="{{asset('images/shop/app2.png')}}" alt="Tdoctor"></a></div>
            </div>
        </div>
    </div> -->
</div>