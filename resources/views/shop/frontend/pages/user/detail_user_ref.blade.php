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
        .body-ref p,a{
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div id="site">
        <div class="container-ref">
            <div class="content-ref rounded">
                <div class="body-ref d-flex align-items-center py-3 flex-column px-2">
                    <div class="img-avtar-ref">
                        <img src="{{$imageSrc}}" alt="">
                        <p class="font-weight-bold text-center mb-2">{{$infoUserRef['fullname']??''}}</p>
                    </div>
                    <hr>
                    <div class="flex flex-col items-center w-100">
                        <div class="font-weight-bold d-flex justify-content-between mb-2">
                            <p>Email</p>
                            <p>{{$infoUserRef['email']??''}}</p>
                        </div>
                        <hr>
                        <div class="font-weight-bold d-flex justify-content-between mb-2">
                            <p>Số điện thoại</p>
                            <p>{{$infoUserRef['phone']??''}}</p>
                        </div>
                        <hr>
                        <div class="font-weight-bold d-flex justify-content-between mb-2">
                            <p>Kinh nghiệm</p>
                            <p>1 năm</p>
                        </div>
                        <p class="text-center"><a href="{{$urlShare}}" class="btn btn-primary font-weight-bold">Chọn làm người hướng dẫn</a></p>
                        <p class="text-center mb-3"><a href="javascript:window.history.back()" class="font-weight-bold text-center">Quay lại</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>