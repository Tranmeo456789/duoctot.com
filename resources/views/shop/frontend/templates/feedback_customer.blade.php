@php
    $feedbacks=[
        ['thumb'=>'phanhoi1.png','fullname'=>'Duy Nguyễn Nhất','content'=>'Rất tuyệt vời, đặc biệt trong mùa dịch đi lại khó khăn. Chúc doctor ngày càng phát triển và mở rộng phạm vi ra nhiều tỉnh hơn, nhất là vùng Đồng bằng sông Cửu Long.'],
        ['thumb'=>'phanhoi2.png','fullname'=>'Quốc Bình Vũ','content'=>'Ứng dụng rất hay. Giúp mọi người hạn chế bệnh gì cũng phải đến bệnh viện khám. Đỡ mất thời gian, công sức và tiền bạc vì nhiều khi vô gặp bs cũng chỉ cần hỏi vài câu và cho thuốc.'],
        ['thumb'=>'phanhoi3.png','fullname'=>'Nguyễn Ngọc Minh','content'=>'Em bị ung thư thấy bác sĩ tuyến trung ương trong hệ thống tdoctor, bác sĩ bên tdoctor rất nhiệt tình. rất tiện cho trường hợp khám online và tư vấn thêm.']
        ];
        $imgCustomer=['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg'];
@endphp
<div class="row mx-0">
    <div class="col-xl-6 col-lg-12">
        <ul>
            @foreach($feedbacks as $val)
                @php
                $thumb = asset('images/shop/') . '/' . $val['thumb'];
                @endphp
            <li class="d-flex mb-3">
                <div class="rimg-start"><img src="{{$thumb}}" alt="tdoctor"></div>
                <div class="ml-3">
                    <h2>{{$val['fullname']}}</h2>
                    <span>
                        <img src="{{asset('images/shop/star.png')}}" alt="tdoctor">
                        <img src="{{asset('images/shop/star.png')}}" alt="tdoctor">
                        <img src="{{asset('images/shop/star.png')}}" alt="tdoctor">
                        <img src="{{asset('images/shop/star.png')}}" alt="tdoctor">
                        <img src="{{asset('images/shop/star.png')}}" alt="tdoctor">
                    </span>
                    <p>{{$val['content']}}</p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="col-xl-3 img-customer" id="img-customer">
        @foreach($imgCustomer as $val)
            @php
            $img = asset('images/shop/') . '/' .$val;
            @endphp
            <div><img src="{{$img}}" alt="tdoctor"></div>
        @endforeach
    </div>
    <div class="col-xl-3 col-lg-12 dlapp pb-0">
        <div class="dlapp1">
            <p>Mua thuốc trực tuyến, giao hàng tận nơi dễ dàng & nhanh chóng</p>
            <div class="dlapp2">
                <div class="mb-2 mt-3 mr-xl-0 mr-lg-2 app-store"><a href="https://apps.apple.com/us/app/tdoctor/id1443310734"><img src="{{asset('images/shop/app1.png')}}" alt=""></a></div>
                <div class="mb-4 mt-3"><a href="https://play.google.com/store/apps/details?id=com.app.khambenh.bacsiviet"><img src="{{asset('images/shop/app2.png')}}" alt=""></a></div>
            </div>        
        </div>     
        <div><img src="{{asset('images/shop/app4.png')}}" alt="tdoctor"></div>
    </div>
</div>