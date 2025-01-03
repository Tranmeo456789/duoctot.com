@php
$title = 'Người hướng dẫn tại Tdoctor';
$imageItem = 'images/shop/ogimg_home.jpg';
$description = 'Tdoctor là một giải pháp cho các nhà thuốc, các doanh nghiệp, công ty dược phẩm tăng doanh thu một cách nhanh chóng.';
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$description}}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:image" content="{{ asset($imageItem) }}?v=1">
    <meta property="og:description" content="{{$description}}">
    <title>{{$title}}</title>
    <link rel="icon" href="{{ asset('images/shop/favicon.jpg') }}" type="image/jpeg">
    @include('shop.frontend.block.head')
    <style>
        .container-ref {
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
            padding: 30px 15px;
            background: #aeaee9;
            min-height: 100vh;
        }
        .content-ref {
            overflow: hidden;
            background: white;
        }
        .header-ref {
            background: rgb(254 243 230);
            padding: 5px 10px;
            font-size: 20px;
        }
        .img-avtar-ref img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
        }
        .body-ref p{
            font-size: 20px;
        }
        .body-ref a{
            font-size: 22px;
        }
        .footer-ref  p,a{
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div id="site">
        <div class="container-ref">
            <div class="content-ref rounded">
                <div class="header-ref d-flex justify-content-between">
                    <p class="align-self-center font-weight-bold">Bạn nhận được lời mời từ</p>
                    <div><img style="width: 50px" src="{{asset('public/shop/frontend/images/shop/email-referral-mall.jpg')}}" alt="ref-tdoctor"></div>
                </div>
                <div class="body-ref d-flex align-items-center py-3 flex-column px-2">
                    <div class="img-avtar-ref"><img src="{{$imageSrc}}" alt=""></div>
                    <div class="flex flex-col items-center">
                        <p class="font-weight-bold text-center mb-2">{{$infoUserRef['fullname']??''}}</p>
                        <p class="font-weight-bold text-center mb-2">Người hướng dẫn tại Tdoctor</p>
                        <p class="text-center mb-3">Hân hạnh được đồng hành, hỗ trợ bạn suốt quá trình trải nghiệm dịch vụ mua sắm và sử dụng sản phẩm tại Tdoctor.</p>
                        <p class="text-center mb-3"><a href="{{ route('fe.product.drugstore', ['slug' => $slugRef,'codeRef' => $codeRef]) }}" class="font-weight-bold text-center">Xem hồ sơ cá nhân</a></p>
                        <p class="text-center"><a href="{{$urlShare}}" class="btn btn-primary font-weight-bold">Chọn làm người hướng dẫn</a></p>
                    </div>
                </div>
                <div class="footer-ref text-center px-2 pb-3 pt-2">
                    <p class="font-weight-bold">TDOCTOR</p>
                    <p>Đồng hành trong mọi trải nghiệm của bạn. TDOCTOR tự tin đáp ứng toàn bộ nhu cầu mua sắm của bạn</p>
                    <div><img src="{{asset('public/shop/frontend/images/shop/ref1.webp')}}" alt="Tdoctor"></div>
                    <div><img src="{{asset('public/shop/frontend/images/shop/ref2.webp')}}" alt="Tdoctor"></div>
                    <div class="pt-3">
                        <p>Mua an toàn - Hoàn trả yên tâm</p>
                        <p>Với những tính năng vượt trội</p>
                        <p class="font-weight-bold py-2">CHÍNH SÁCH TRẢI NGHIỆM TIÊU DÙNG</p>
                        <p class="bg-primary text-light mb-1 p-1">Luôn lấy chất lượng sản phẩm và sự hài lòng của khách hàng về dịch vụ là ưu tiên hàng đầu. Qua quá trình tuyển chọn nghiêm ngặt, chúng tôi đảm bảo mọi sản phẩm đều đảm bảo chất lượng, đầy đủ giấy tờ hợp pháp.</p>
                        <p class="bg-primary text-light mb-1 p-1">Người Hướng Dẫn trên TDOCTOR là đội ngũ đối tác kinh doanh của Tdoctor được training bài bản về sản phẩm, giúp các khách hàng tìm kiếm sản phẩm phù hợp với nhu cầu, là người bạn đồng hành giúp trải nghiệm mua sắm của bạn thêm trọn vẹn.</p>
                        <p class="bg-primary text-light mb-1 p-1">Tdoctor cam kết đảm bảo 100% sự hài lòng của khách hàng trên mỗi sản phẩm và hoàn lại giá mua hàng khi có lý do chính đáng.</p>
                        <p>CHẦN CHỜ GÌ NỮA!</p>
                        <p>SẴN SÀNG TRẢI NGHIỆM MUA SẮM TUYỆT VỜI CỦA BẠN NGAY HÔM NAY!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>