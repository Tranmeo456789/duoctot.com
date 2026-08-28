@php
use Illuminate\Support\Facades\Cache;
$feedbacks=[
['thumb'=>'phanhoi1.png','fullname'=>'Duy Nguyễn Nhất','content'=>'Rất tuyệt vời, đặc biệt trong mùa dịch đi lại khó khăn. Chúc Dược Tốt ngày càng phát triển và mở rộng phạm vi ra nhiều tỉnh hơn, nhất là vùng Đồng bằng sông Cửu Long.'],
['thumb'=>'phanhoi2.png','fullname'=>'Quốc Bình Vũ','content'=>'Ứng dụng rất hay. Giúp mọi người hạn chế bệnh gì cũng phải đến bệnh viện khám. Đỡ mất thời gian, công sức và tiền bạc vì nhiều khi vô gặp bs cũng chỉ cần hỏi vài câu và cho SP.'],
['thumb'=>'phanhoi3.png','fullname'=>'Nguyễn Ngọc Minh','content'=>'Em bị ung thư thấy bác sĩ tuyến trung ương trong hệ thống tdoctor, bác sĩ bên Dược Tốt rất nhiệt tình, rất tiện cho trường hợp mua sản phẩm dược và thực phẩm chức uy tín online.']
];
$imgCustomer=['1.jpg', '2.jpg'];
$keyCacheListImagePhanHoi = 'duoctot_cache_list_image_phan_hoi';
$dataListImagePhanHoiCache = Cache::get($keyCacheListImagePhanHoi);
if(!empty($dataListImagePhanHoiCache)){
    $listImagePhanHoi = $dataListImagePhanHoiCache['listImagePhanHoi'];
}else{
    $arrayIdPhanHois = [145,144,143,142,141,140,139,138,137];
    $listImagePhanHoi = CustomerFeedBackModel::whereIn('id', $arrayIdPhanHois)
    ->orderByRaw('FIELD(id, ' . implode(',', $arrayIdPhanHois) . ')')
    ->get();
    $cacheDataListImagePhanHoi = [
        'listImagePhanHoi' => $listImagePhanHoi,
    ];
    Cache::put($keyCacheListImagePhanHoi, $cacheDataListImagePhanHoi, 100000000);
}
@endphp
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
<style>.prev-btn-thumb-feedback,.next-btn-thumb-feedback{top:50%;transform:translateY(-50%);border:none;padding:10px;cursor:pointer;z-index:10;font-size:30px}</style>
<script>document.addEventListener("DOMContentLoaded",function(){var sliderListThumbFeedBack=tns({container:".list_thumb_feedback",items:1,slideBy:1,loop:!0,speed:600,autoplay:!0,autoplayTimeout:5e3,autoplayButtonOutput:!1,controls:!1,nav:!1,mouseDrag:!0,touch:!0,gutter:4,edgePadding:0,autoHeight:!1,onInit:function(){document.querySelector(".list_thumb_feedback").classList.remove("cS-hidden")}});document.querySelector(".prev-btn-thumb-feedback").addEventListener("click",function(){sliderListThumbFeedBack.goTo("prev")}),document.querySelector(".next-btn-thumb-feedback").addEventListener("click",function(){sliderListThumbFeedBack.goTo("next")})});</script>
<div class="row mx-0">
    <div class="col-12">
        <a href="{{route('fe.feedBackCustomer')}}">@include("$moduleName.templates.box_title_product",['title' => 'Phản hồi từ Bệnh Nhân, Dược Sỹ và Bác Sỹ','classBackground'=>'bg-danger'])</a>
    </div>
    <div class="col-xl-9 col-lg-12 pt-3">
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
        <div class="container-slider mt-0 mt-lg-2 position-relative px-md-5">
            <button class="prev-btn-thumb-feedback position-absolute" style="left: 0;">‹</button>
            <div class="list_thumb_feedback cS-hidden">
                @if(!empty($listImagePhanHoi) && count($listImagePhanHoi) > 0)
                    @foreach($listImagePhanHoi as $customerFeedBack)
                        @if(!empty($customerFeedBack['image']))
                            <div class="swiper-slide text-center">
                                <img src="{{ asset('public'.$customerFeedBack['image']) }}" class="img-thumbnail image-zoom-popup" loading="lazy" alt="phan hoi" />
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <button class="next-btn-thumb-feedback position-absolute" style="right: 0;">›</button>
        </div>
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