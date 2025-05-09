@php
    $title = $item['name'] ?? $item['title'] ?? 'Tdoctor';
    $imageItem = $item['image'] ?? 'images/shop/favicon.png';
    $description = $item['description'] ?? $item['meta_description'] ?? 'Tdoctor là một giải pháp cho các nhà thuốc, các doanh nghiệp, công ty dược phẩm tăng doanh thu một cách nhanh chóng.';
    $metaKeywords = $item['meta_keywords']?? 'Shop trực tuyến, mua hàng online, tư vấn dược phẩm, giao hàng tận nhà, giảm đau, vitamin bổ sung';
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$description}}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:image" content="{{ asset($imageItem) }}">
    <meta property="og:description" content="{{$description}}">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $title }}" />
    <meta name="twitter:description" content="{{$description}}" />
    <meta name="twitter:image" content="{{ asset($imageItem) }}" />
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="google-site-verification" content="SF3DQyzJn3obwShXlf3gfh6NC1HX20ronORFCHD5y8g" />
    <title>{{$title}}</title>
    <link rel="icon" href="{{ asset('images/shop/logo-favicon.png') }}" type="image/png">
    @include('shop.frontend.block.head')
</head>
<body>
    <div id="site">
        <div id="container">
            <div id="main-content-wp" class="home-page clearfix">
                @yield('content')
            </div>
        </div>
        <div id="box-search-fixed">
            @include('shop.frontend.block.box_responsive.box_search_responsive')
        </div>
        <div id="fixscreen-respon"></div>
        <div class="black-screen"></div>
        @include('shop.frontend.block.spinner_screen')
    </div>
    @include('shop.frontend.block.script')
    @yield('scriptadd')
</body>
</html>