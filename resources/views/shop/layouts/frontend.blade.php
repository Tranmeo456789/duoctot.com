@php
    $title = $title ?? 'Sàn thương mại điện tử trong y dược';
    $imageItem = $item['image'] ?? 'images/shop/logo_topbar3.png';
    $benefit = $item['benefit'] ?? 'Sản phẩm được nhiều khách hàng tin dùng'
@endphp
<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
    <meta property="og:title" content="{{ $item['name'] ?? 'Tdoctor' }}">
    <meta property="og:image" content="{{ asset($imageItem) }}">
    <meta property="og:description" content="{{$benefit}}">

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