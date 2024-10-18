@php
    $title = $item['name'] ?? $item['title'] ?? 'Sàn thương mại điện tử trong y dược Tdoctor';
    $imageItem = $item['image'] ?? 'images/shop/ogimg_home.jpg';
    $description = $item['description'] ?? $item['meta_description'] ?? 'Tdoctor là một giải pháp cho các nhà thuốc, các doanh nghiệp, công ty dược phẩm tăng doanh thu một cách nhanh chóng.';
    $metaKeywords = $item['meta_keywords']?? 'Nhà thuốc trực tuyến, mua thuốc online, tư vấn dược phẩm, giao thuốc tận nhà, thuốc giảm đau, vitamin bổ sung';
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
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="google-site-verification" content="SF3DQyzJn3obwShXlf3gfh6NC1HX20ronORFCHD5y8g" />
    <title>{{$title}}</title>
    <link rel="icon" href="{{ asset('images/shop/favicon.jpg') }}" type="image/jpeg">
    @include('shop.frontend.block.head')
    @include('shop.frontend.block.script')
</head>

<body>
    <div id="site">
        <div id="container">
            @include('shop.frontend.block.menu.menu_no_search')
            <div id="main-content-wp" class="home-page clearfix">
                @yield('content')
            </div>
            <div id="footer-wp" class="pb-5">
                @include('shop.frontend.block.footer')
            </div>
        </div>
        <div id="box-search-fixed">
            @include('shop.frontend.block.box_responsive.box_search_responsive')
        </div>
        <div id="fixscreen-respon"></div>
        <div class="black-screen"></div>
        @include('shop.frontend.block.spinner_screen')
    </div>
</body>

</html>