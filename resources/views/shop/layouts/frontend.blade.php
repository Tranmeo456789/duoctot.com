@php
    $title = $item['name'] ?? $item['title'] ?? 'Sàn thương mại điện tử trong y dược Tdoctor';
    $imageItem = $item['image'] ?? 'images/shop/logo_topbar3.png';
    $benefit = $item['benefit'] ?? $item['description'] ?? 'Sàn thương mại điện tử trong y dược Tdoctor chuyên cung cấp các TPCN, thuốc và thiết bị y tế';
    $metaKeywords = $item['meta_keywords']?? 'Nhà thuốc trực tuyến, mua thuốc online, tư vấn dược phẩm, giao thuốc tận nhà, thuốc giảm đau, vitamin bổ sung';
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:image" content="{{ asset($imageItem) }}">
    <meta property="og:description" content="{{$benefit}}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <title>{{$title}}</title>
    <link rel="icon" href="{{ asset('images/shop/favicon.jpg') }}" type="image/jpeg">
    @include('shop.frontend.block.head')
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
@include('shop.frontend.block.script')

</html>